<?php

session_start();


if(isset($_POST['add_to_cart'])){

    //ürün zaten varsa
    if(isset($_SESSION['cart'])){
        
        $products_array_ids = array_column($_SESSION['cart'], "product_id");

        if(!in_array($_POST['product_id'], $products_array_ids)){

          $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity'],
            );

            
            $_SESSION['cart'][$_POST['product_id']] = $product_array;
        } else {
            echo '<script>alert("Product was already added to cart")</script>';
        }

    } else {

        //ilk kez 
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity'],
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    }
   calculateTotalCart();
    
} else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    
    // sepette ürün coktan var mı ?
    if (isset($_SESSION['cart'][$product_id])) {
        // Loop 
        foreach ($_SESSION['cart'] as $key => $value) {
            // kaldırıcak ürünlerin id'sine bak
            if ($value['product_id'] === $product_id) {
                // ürünü sepetten cıkar
                unset($_SESSION['cart'][$key]);
                calculateTotalCart();
                // loop cıkıs
                break;
            }
        }
    } else {
        echo '<script>alert("Product not found in cart")</script>';
    }

} elseif (isset($_POST['edit_quantity'])) {
    // quantity mantık
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity']; 
    $product_array = $_SESSION['cart'][$product_id];
    $product_array['product_quantity'] = $product_quantity;
    $_SESSION['cart'][$product_id] = $product_array; 
    calculateTotalCart();
} else {
    //header('location: index.php');
}

function calculateTotalCart(){
   $total_price = 0;
   $total_quantity = 0;

   foreach($_SESSION['cart'] as $key => $value){
     $product = $_SESSION['cart'][$key];
     $price = $product['product_price'];
     $quantity = $product['product_quantity'];
     $total_price = $total_price + ($price * $quantity);
     $total_quantity = $total_quantity + $quantity; 
   }
   $_SESSION['total'] = $total_price;
   $_SESSION['quantity'] = $total_quantity;
   
}

?>

<?php include('layouts/header.php'); ?>

 
 <!--Cart-->
 <section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Sepetiniz</h2>
        <hr>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Ürün</th>
            <th>Adet</th>
            <th>Ücret</th>
        </tr>


        <?php  
            // sepet bos mu kontrol et
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $key => $value) { 
        ?>


        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/img/<?php echo $value['product_image']; ?>" alt="">
                    <div>
                        <p><?php echo $value['product_name'];?></p>
                        <small><span>TL</span><?php echo $value['product_price']; ?></small>
                        <br>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="submit" name="remove_product" class="remove-btn" value="Sil">
                        </form>
                    </div>
                </div>
            </td>
            <td>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                  <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                  <input type="submit" class="edit-btn" value="Ekle" name="edit_quantity">
                </form>
            </td>
            <td>
                <span>TL</span>
                <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
            </td>
        </tr>
        <?php 
                } // foreach döngüsü sonu
            } else {
                echo "<tr><td colspan='3'>Sepetiniz boş.</td></tr>";
              }
          ?>
      </table>
  
       <div class="cart-total">
          <table>
           <tr>
              <td>Toplam Ücret</td>
              <td><?php echo $_SESSION['total'];?>TL</td>
           </tr>
          </table>
       </div>
      
       <div class="checkout-container">
          <form method="POST" action="checkout.php">
           <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
          </form>
       </div>
  
   </section>
  
<?php include('layouts/footer.php');?>
