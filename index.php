<?php include('layouts/header.php'); ?>

 <!--Home-->
 <section id="home">
    <div class="container">
    <h5>Yeni Ürünler</h5>
    <h1><span>Bu Sezonun</span> En İyi Fiyatları</h1> 
    <p>Ticaretify size en uygun fiyatta en kaliteli ürünleri sunar.</p>
    <a href="shop.php"><button>Şimdi Göz Atın</button></a>
    </div>
 </section>

 <!--Brand-->
 <section id="brand" class="container" >
    <div class="row">
     <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/assets/img/zara.png">
     <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/assets/img/Cartier-logo.png">
     <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/assets/img/adidas.png">
     <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/assets/img/hm.png">
    </div>
 </section>

 <!--New-->
 <section id="new" class="w-100">
  <div class="row p-0 m-0">
    <!--One-->
   <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class="img-fluid" src="assets/img/1.webp" alt="">
    <div class="details">
      <h2>Muhteşem Ayakkabılar</h2>
      <a href="shop.php"><button class="text-uppercase">Şimdi Göz Atın</button></a>
    </div>
   </div>
   <!--Two-->
   <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class="img-fluid" src="assets/img/2.jpg" alt="">
    <div class="details">
      <h2>Harika Ceketler</h2>
      <a href="shop.php"><button class="text-uppercase">Şimdi Göz Atın</button></a>
    </div>
   </div>
   <!--Three-->
   <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
    <img class="img-fluid" src="assets/img/3.jpg" alt="">
    <div class="details">
      <h2>İndirimlerimizi Kaçırmayın</h2>
      <a href="shop.php"><button class="text-uppercase">Şimdi Göz Atın</button></a>
    </div>
   </div>
  </div>
 </section>

 <!--Featured-->
 <section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Öne Çıkan Ürünlerimiz</h3>
    <hr class="mx-auto">
    <p>İlginizi Çekebilicek Ürünlerimiz Burada Bulunmaktadır.</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_featured_products.php') ?>

  <?php while($row= $featured_products->fetch_assoc()){   ?>

  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <img class="img-fluid mb-3" src="/assets/img/<?php echo $row ['product_image'];?>" alt="">
    <div class="star">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row ['product_name'];?></h5>
    <h4 class="p-price"><?php echo $row ['product_price'];?>TL</h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']?>"><button class="buy-btn">Satın Al</button></a>
  </div>

  <?php } ?>

  </div>
 </section>

 <!--Banner-->
 <section id="banner" class="my-5 py-5" >
  <div class="container">
    <h4>SEZON ORTASI İNDİRİMLERİ</h4>
    <h1>Bir Çok Koleksiyonda <br> %30'a Varan İndirimler</h1>
    <a href="shop.php"><button class="text-uppercase">Göz Atın</button></a>
  </div>
 </section>

 <!--Clothes-->
 <section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Ceketlerimiz</h3>
    <hr class="mx-auto">
    <p>Burada Ceketlerimize Göz Atabilirsiniz.</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_coats.php') ?>
  <?php while($row=$coats_products->fetch_assoc()) { ?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <img class="img-fluid mb-3" src="/assets/img/<?php echo $row ['product_image'];?>" alt="">
    <div class="star">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row ['product_name'];?></h5>
    <h4 class="p-price"><?php echo $row ['product_price'];?>TL</h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']?>"><button class="buy-btn">Satın Al</button></a>
  </div>
  <?php } ?>
  </div>
 </section>

 <!--Watches-->
 <section id="watches" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Saatler</h3>
    <hr class="mx-auto">
    <p>Burada Saatlerimize Göz Atabilirsiniz.</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_watches.php') ?>
  <?php while($row=$watches_products->fetch_assoc()) { ?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="/assets/img/<?php echo $row ['product_image'];?>" alt="">
    <div class="star">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row ['product_name'];?></h5>
    <h4 class="p-price"><?php echo $row ['product_price'];?>TL</h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']?>"><button class="buy-btn">Satın Al</button></a>
  </div>
  <?php } ?>
  </div>
 </section>

 <!--Shoes-->
 <section id="shoes" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Ayakkabılar</h3>
    <hr class="mx-auto">
    <p>Burada Ayakkabılarımıza Göz Atabilirsiniz.</p>
  </div>
  <div class="row mx-auto container-fluid">
  <?php include('server/get_shoes.php') ?>
  <?php while($row=$shoes_products->fetch_assoc()) { ?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
   <img class="img-fluid mb-3" src="/assets/img/<?php echo $row ['product_image'];?>" alt="">
    <div class="star">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row ['product_name'];?></h5>
    <h4 class="p-price"><?php echo $row ['product_price'];?>TL</h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']?>"><button class="buy-btn">Satın Al</button></a>
  </div>
  <?php } ?>
  </div>
 </section>

 <?php include('layouts/footer.php');?>