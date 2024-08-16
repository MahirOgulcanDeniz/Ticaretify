<?php 

include('server/connection.php');

if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i",$product_id);
  $stmt->execute();

  $product = $stmt->get_result();

}else{
  header('location: index.php');
}

?>
<?php include('layouts/header.php'); ?>
 <!--SingleProduct-->
 <section class="container single-product my-5 pt-5">
   <div class="row mt-5">

    <?php while($row = $product->fetch_assoc()){ ?>
    <div class="col-lg-5 col-md-6 col-sm-12">
        <img class="img-fluid w-100 pb-1" src="/assets/img/<?php echo $row ['product_image'];?>" id="mainImg" alt="">
        <div class="small-img-group">
            <div class="small-img-col">
                <img src="/assets/img/<?php echo $row ['product_image'];?>" width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src="/assets/img/<?php echo $row ['product_image2'];?>" width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src="/assets/img/<?php echo $row ['product_image3'];?>" width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src="/assets/img/<?php echo $row ['product_image4'];?>" width="100%" class="small-img" alt="">
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <h6><?php echo $row ['product_category'];?></h6>
        <h3 class="py-4"><?php echo $row ['product_name'];?></h3>
        <h2><?php echo $row ['product_price'];?>TL</h2>

        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
            <form method="POST" action="cart.php" class="d-flex">
                <input type="hidden" name="product_id" value="<?php echo $row ['product_id'];?>"/>
                <input type="hidden" name="product_image" value="<?php echo $row ['product_image'];?>"/>
                <input type="hidden" name="product_name" value="<?php echo $row ['product_name'];?>"/>
                <input type="hidden" name="product_price" value="<?php echo $row ['product_price'];?>"/>
                <input type="number" name="product_quantity" value="1"/>
                <button class="buy-btn" type="submit" name="add_to_cart">Sepete Ekleyin</button>
            </form>

            <form method="POST" action="server/add_to_favorites.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <button type="submit" class="buy-btn ml-3" style="margin-right: 337px;" ><i class="fa-solid fa-heart"></i></button>
            </form>
        </div>

        <h4 class="mt-5 mb-5">Ürün Detayları</h4>
        <span><?php echo $row ['product_description'];?></span>
    </div>
    <?php } ?>
   </div>
  </section>

  <!-- RelatedProducts -->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>İlgili Ürünler</h3>
        <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">

        <?php
        // Tıklanan ürünün kategorisini al
        $product_id = $_GET['product_id'];
        $stmt = $conn->prepare("SELECT product_category FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $product_category = $product['product_category'];

        // Rastgele 4 ürün
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_id != ? ORDER BY RAND() LIMIT 4");
        $stmt->bind_param("si", $product_category, $product_id);
        $stmt->execute();
        $related_products = $stmt->get_result();

        while ($row = $related_products->fetch_assoc()) {
        ?>
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
                <h4 class="p-price"><?php echo $row['product_price']; ?>TL</h4>
                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Satın Al</button></a>
            </div>
        <?php } ?>

    </div>
</section>

<!--Footer-->
<footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img class="footer-img" src="/assets/img/Ticaretify Logo - Original - 5000x5000.png" alt="">
        <p class="pt-3">Alışverişte Güven ve Kalite</p>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Hızlı Bağlantılar</h5>
        <ul class="text-uppercase">
          <li><a href="../index.php">Anasayfa</a></li>
          <li><a href="../shop.php">Shop</a></li>
          <li><a href="https://www.inthefrow.com/blog" target="_blank">Blog</a></li>
          <li><a href="../contact.php">İletişim</a></li>
          <li><a href="../account.php">Hesap Bilgileri</a></li>
        </ul>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">İletişim</h5>
        <div>
          <h6 class="text-uppercase">Adres</h6>
          <p>Lorem ipsum dolor sit amet.</p>
        </div>
        <div>
          <h6 class="text-uppercase">Telefon</h6>
          <p>123456789</p>
        </div>
        <div>
          <h6 class="text-uppercase">Email</h6>
          <p>info@email.com</p>
        </div>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Instagram</h5>
        <div class="row">
          <img src="assets/img/footer1.jpg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/img/footer2.jpg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/img/footer3.jpg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/img/footer4.jpg" class="img-fluid w-25 h-100 m-2" alt="">
          <img src="assets/img/footer5.jpg" class="img-fluid w-25 h-100 m-2" alt="">
        </div>
      </div>
    </div>
    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
          <img src="assets/img/visa-mastercard-logo.png" alt="">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap">
          <p>Ticaretify @2024 Tüm Hakları Saklıdır.</p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for(let i=0;i<4;i++){
        smallImg[i].onclick = function(){
        mainImg.src = smallImg[i].src;
    }
    }
</script>
</body>
</html>
