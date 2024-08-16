<?php

session_start();


if (!empty($_SESSION['cart'])){

}else{

  header('location: index.php');
}



?>

<?php include('layouts/header.php'); ?>

 <!--Checkout-->
 <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Ödeme Bilgileri</h2>
    </div>
    <div class="mx-auto container">
        <form id="checkout-form" method="POST" action="server/place_order.php">
            <p class="text text-center" style="color:red;">
                 <?php if(isset($_GET['message'])) {echo $_GET['message'];} ?>
                 <?php if(isset($_GET['message'])){ ?>
                  
                    <a href="login.php" class="btn btn-primary" style="color: white;background-color: #fb774b;border:none;" >Giriş</a>

                 <?php } ?>
            </p>
            <div class="form-group checkout-small-element">
                <label>İsim</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="İsim" required>
            </div>
            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group checkout-small-element">
                <label>Telefon</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Telefon" required>
            </div>
            <div class="form-group checkout-small-element">
                <label>Şehir</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Sehir" required>
            </div>
            <div class="form-group checkout-large-element">
                <label>Adress</label>
                <input type="text" class="form-control" id="checkout-adress" name="adress" placeholder="Adress" required>
            </div>
            <div class="form-group checkout-btn-container">
                <p>Toplam Ücret: <?php echo $_SESSION['total'];?> TL</p>
                <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Siparis Verin">
            </div>
        </form>
    </div>
 </section>



 <?php include('layouts/footer.php');?>