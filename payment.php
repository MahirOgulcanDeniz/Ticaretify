<?php
session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
    $order_id = $_POST['order_id']; // order_id'yi burada alalım
} else {
    header('location: account.php');
    exit;
}
?>

<?php include('layouts/header.php'); ?>

<!-- Payment -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Ödeme Noktası</h2>
        <hr>
    </div>
    <div class="mx-auto container text-center">
        <?php if(isset($order_total_price) && $order_total_price != 0) { ?>
            <p>Toplam Ödenecek Tutar: <?php echo $order_total_price; ?> TL</p>
            <form action="pay.php" method="GET">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input class="btn btn-primary" style="color: white; background-color: #fb774b; border:none;" type="submit" value="Şimdi Ödeyin">
            </form>
        <?php } else if(isset($order_status) && $order_status == "ödenmedi") { ?>
            <p>Toplam Ödenecek Tutar: <?php echo $order_total_price; ?> TL</p>
            <form action="pay.php" method="GET">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input class="btn btn-primary" style="color: white; background-color: #fb774b; border:none;" type="submit" value="Şimdi Ödeyin">
            </form>
        <?php } else { ?>
            <p>Sepetiniz Boş</p>
        <?php } ?>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
