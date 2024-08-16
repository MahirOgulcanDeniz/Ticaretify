<?php

session_start();

include('server/connection.php');

//kullanıcı coktan kayıt olduysa account sayfasına at
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

if(isset($_POST['register'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  // sifreler uyusmuyorsa
  if($password !== $confirmPassword){
    header('location: register.php?error=Sifreler Uyusmuyor');
  

  //6 karakter
    }else if(strlen($password)< 6){
    header('location: register.php?error=Sifreniz En Az 6 Karakter Olmali');
  

  //error yoksa
  }else{
     //bu email kullanılmıs mı kontrol et
     $stmt1= $conn->prepare("SELECT count(*) FROM users where user_email=?");
     $stmt1->bind_param('s',$email);
     $stmt1->execute();
     $stmt1->bind_result($num_rows);
     $stmt1->store_result();
     $stmt1->fetch();


     //kullanıldıysa
     if($num_rows != 0){
     header('location: register.php?error=Bu Email Coktan Kullanilmis');

     //kullanılmadıysa
     }else{

  
  
        //yeni user aç
        $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
                VALUES (?,?,?)");
  
        $stmt->bind_param('sss',$name,$email,md5($password));
        //yeni user açma basarılıylsa
        if ($stmt->execute()){
          $user_id = $stmt->insert_id;
          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_email'] = $email;
          $_SESSION['user_name'] = $name;
          $_SESSION['logged_in'] = true;
          header('location: account.php?register_success=Basari İle Kayit Olundu');
     }else{

      header('location: register.php?error=could not create an account at the moment');

     }

   }
  }
}

?>
<?php include('layouts/header.php'); ?>


 <!--Register-->
 <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Kayıt Bilgileri</h2>
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="register.php">
          <p style="color: red"><?php if(isset($_GET['error'])) {echo $_GET['error']; }?></p>
            <div class="form-group">
                <label>İsim</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="İsim" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Sifre" required>
            </div>
            <div class="form-group">
                <label>Şifrenizi Doğrulayın </label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Sifre" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name="register" value="Kayit Olun">
            </div>
            <div class="form-group">
                <a id="login-url" href="login.php" class="btn">Hesabınız var mı ? Giriş yapın</a>
            </div>
        </form>
    </div>
 </section>


 <?php include('layouts/footer.php');?>