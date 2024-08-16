<?php include('layouts/header.php'); ?>
<?php
include('server/connection.php');

if (isset($_POST['payment'])) {
    $order_id = $_POST['order_id'];
    
    // Order status ödendi' olarak güncelle
    $stmt = $conn->prepare("UPDATE orders SET order_status = 'ödendi' WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Ödeme başarıyla tamamlandı!'); window.location.href = 'account.php';</script>";
    } else {
        echo "<script>alert('Ödeme işlemi başarısız oldu. Lütfen tekrar deneyin.'); window.location.href = 'account.php';</script>";
    }
} else {
    // Eğer ödeme formu gönderilmediyse, order_id'nin GET yöntemiyle geldiğini kontrol et
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    } else {
        echo "<script>alert('Geçersiz sipariş ID\'si.'); window.location.href = 'account.php';</script>";
        exit;
    }
}
?>

<!--Ödeme Formu-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Kart Bilgileri</h2>
    </div>
    <div class="mx-auto container">
        <form id="payment-form" method="POST" action="pay.php">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <div class="form-group">
                <label>Kart Sahibinin Adı Soyadı</label>
                <input type="text" class="form-control" id="payment-name" name="name" placeholder="İsim" required>
            </div>
            <div class="form-group">
                <label>Kart Numarası</label>
                <input type="text" class="form-control" id="card-number" name="cardNumber" placeholder="Kart No" required>
            </div>
            <div class="form-group">
                <label>Son Kullanma Tarihi (AA/YY)</label>
                <input type="text" class="form-control" id="expiry-date" name="expiryDate" placeholder="AA/YY" required>
            </div>
            <div class="form-group">
                <label>CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="payment-btn" name="payment" value="Öde">
            </div>
        </form>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
