<?php 

session_start();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticaretify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cbfbaecab8.js" crossorigin="anonymous"></script>
    <script src="../gotohome.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
 <!--navbar-->
 <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
      <a onclick="GoToHomePage()"><img  class="header-img" src="../assets/img/Ticaretify Logo - Original - 5000x5000.png" alt=""></a>
      <a onclick="GoToHomePage()"><h2 class="brand">Ticaretify</h2></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://www.inthefrow.com/blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">İletişim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="fav-kalp" href="../favorites.php"><i class="fa-solid fa-heart"></i></a>
          </li>
          <li class="nav-item">
            <a href="cart.php"><i class="fas fa-shopping-bag">
              <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) {?>
                 <span class="cart-quantity" > <?php echo $_SESSION['quantity']; ?> </span>
                <?php } ?>
              </i>
              </a>
          </li>
          <li class="nav-item">
            <a href="account.php"><i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
 </nav>