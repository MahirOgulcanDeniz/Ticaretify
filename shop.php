<?php

include('server/connection.php');
session_start();

// Default pagination değerleri
$page_no = 1;
$total_records_per_page = 8;

// sayfa sayısı doğru mu kontrol et
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
}

// pagination offsetini ayarla
$offset = ($page_no - 1) * $total_records_per_page;

$category = '';
$price = '';

// search form kullanıldı mı
if (isset($_POST['search'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];

    // total recordu kontrol et
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
    $stmt1->bind_param('si', $category, $price);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // toplam sayfa sayısını hesapla
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    // search kriterlerine göre ürünleri getir
    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT ?,?");
    $stmt2->bind_param('siii', $category, $price, $offset, $total_records_per_page);
    $stmt2->execute();
    $products = $stmt2->get_result();
} elseif (isset($_GET['product_name'])) {
    // ürün adına göre ara
    $product_name = '%' . $_GET['product_name'] . '%';

    // ürün adına göre yapılan aramada total recordu hesapla
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_name LIKE ?");
    $stmt1->bind_param('s', $product_name);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // toplam sayfa sayısını hesapla
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    // ürün adına göre aramayla istenen ürünleri getir
    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ? LIMIT ?,?");
    $stmt2->bind_param('sii', $product_name, $offset, $total_records_per_page);
    $stmt2->execute();
    $products = $stmt2->get_result();
} else {
    // kriter yok tüm ürünleri getir
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    // toplam sayfa sayısını hesapla
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?,?");
    $stmt2->bind_param('ii', $offset, $total_records_per_page);
    $stmt2->execute();
    $products = $stmt2->get_result();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticaretify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cbfbaecab8.js" crossorigin="anonymous"></script>
    <script src="/gotohome.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
      .product img{
        width: 300px;
        height: 300px;
        box-sizing: border-box;
        object-fit: cover;
      }
      h3{
        color: coral;
      }
      .pagination{
        justify-content: center;
      }
      .pagination a{
        color: coral;
      }
      .pagination li:hover a{
        color: white;
        background-color: coral ;
      }
      input[type="radio"]:checked + label::before {
      border-color: coral;
      background-color: coral;
      }
      input[type="radio"].form-check-input:checked {
      background-color: coral;
      border-color: coral;
      }
      input[type="range"]::-webkit-slider-thumb {
      background: coral;
      }

      input[type="range"]::-moz-range-thumb {
      background: coral;
      }

      input[type="range"]::-ms-thumb {
      background: coral;
      }
      .btn-primary {
      background-color: coral;
      border-color: coral;
      }

      .btn-primary:hover {
      background-color: coral;
      border-color: coral;
      }
      
      .pagination .page-item.active .page-link {
      background-color: coral;
      border-color: coral;
      color: white;
      }
      .pagination .page-item.active .page-link:hover {
      background-color: coral;
      color: white;
  }
    </style>
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
<!--Search-->
<section id="search" class="my-5 py-5 ms-2">
   <div class="container mt-5 py-5">
     <p style="color: #fb774b;">Ürün Arama</p>
     <hr class="my-4">
     <form action="shop.php" method="GET" class="row mx-auto container">
      <input type="text" style="width: 60%;" class="form-control" placeholder="Ürün Adı" name="product_name" value="<?php echo isset($_GET['product_name']) ? $_GET['product_name']:''; ?>">
      <button type="submit" id="ser-btn"  class="btn btn-primary">Ara</button>
     </form>
     <br>
     <form action="shop.php" method="POST">
       <div class="row mx-auto container">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Kategoriler</p>
          <div class="form-check">
            <input class="form-check-input" value="shoes" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='shoes'){echo 'checked';} ?> >
            <label class="form-check-label" for="flexRadioDefault1">
              Ayakkabılar
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input"  value="coats" type="radio" name="category" id="category_two" <?php if(isset($category)&& $category=='coats'){echo 'checked';} ?> >
            <label class="form-check-label" for="flexRadioDefault2">
              Ceketler
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="watches" type="radio" name="category" id="category_two" <?php if(isset($category)&& $category=='watches'){echo 'checked';} ?> >
            <label class="form-check-label" for="flexRadioDefault2">
              Saatler
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="bags" type="radio" name="category" id="category_two" <?php if(isset($category)&& $category=='bags'){echo 'checked';} ?> >
            <label class="form-check-label" for="flexRadioDefault2">
              Çantalar
            </label>
          </div>
        </div>
       </div>
       <div class="row mx-auto container mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Fiyat</p>
          <input type="range" class="form-range w50" name="price" value="<?php if(isset($price)){echo $price;}else{echo "100";} ?>" min="1" max="1000" id="customRange2">
            <span style="float: left;">1</span>
            <span style="float: right;">1000</span>
        </div>
       </div>
       <div class="form-group my-3 mx-3">
        <input type="submit" name="search" value="Ara" class="btn btn-primary">
       </div>
     </form>
 </section>
 <!--Shop-->
 <section id="shop" class="my-5 py-5">
  <div class="container mt-5 py-5">
    <h3>Ürünlerimiz</h3>
    <hr class="mx-auto">
    <p>Burada ürünlerimize bakabilirsiniz.</p>
  </div>
  <div class="row mx-auto container">
  <?php while($row = $products->fetch_assoc()) { ?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <img class="img-fluid mb-3" src="/assets/img/<?php echo $row['product_image']; ?>" alt="">
    <div class="star">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price"><?php echo $row['product_price']; ?> TL</h4>
    <a class="btn shop-buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">Satın Al</a>
  </div>
  <?php } ?>
  <nav aria-label="Page navigation example">
    <ul class="pagination mt-5">

      <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?> ">
        <a class="page-link" href="<?php if($page_no<=1){echo '#';} else{echo "?page_no=".($page_no-1) ;} ?>">Previous</a>
      </li>

      <?php for ($i = 1; $i <= $total_no_of_pages; $i++) { ?>
        <li class="page-item <?php if($page_no == $i) {echo 'active';} ?>">
          <a class="page-link" href="?page_no=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
      <?php } ?>

      <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled' ;} ?> ">
        <a class="page-link" href="<?php if($page_no>=$total_no_of_pages){echo '#';}else{echo "?page_no=".($page_no+1);} ?>">Next</a>
      </li>
    </ul>
  </nav>
  </div>
 </section>
 <?php include('layouts/footer.php');?>
