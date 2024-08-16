<?php
session_start();
include('server/connection.php');

// Kullanıcı oturum açmamışsa giriş sayfasına yönlendir
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Kullanıcının favori ürünlerini al
$stmt = $conn->prepare("SELECT products.* FROM products JOIN favorites ON products.product_id = favorites.product_id WHERE favorites.user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$favorites = $stmt->get_result();

?>

<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <h2>Favorilerim</h2>
    <p style="text-align: center; color: coral;font-size: 1.5rem;font-weight: 600;">İSTEK LİSTESİ</p>
    <hr>
    <?php if ($favorites->num_rows === 0) : ?>
        <p style="text-align: center; margin-top: 50px;">Favori ürününüz bulunmamaktadır.</p>
    <?php else : ?>
        <div class="row">
            <?php while ($row = $favorites->fetch_assoc()) : ?>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card mb-4">
                        <img src="/assets/img/<?php echo $row['product_image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <p class="card-text"><?php echo $row['product_price']; ?> TL</p>
                            <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary">Ürünü Görüntüle</a>
                            <form method="POST" action="server/remove_from_favorites.php" class="mt-2">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <button type="submit" class="btn btn-danger">Listeden Çıkar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<?php include('layouts/footer.php'); ?>
