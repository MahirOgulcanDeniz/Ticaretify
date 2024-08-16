<?php
session_start();
include('connection.php');

// Eğer kullanıcı oturum açmamışsa, login.php'ye yönlendir
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// Kullanıcının bu ürünü zaten favorilere eklemiş olup olmadığını kontrol et
$stmt_check = $conn->prepare("SELECT * FROM favorites WHERE user_id = ? AND product_id = ?");
$stmt_check->bind_param("ii", $user_id, $product_id);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    // Kullanıcı bu ürünü zaten favorilere eklemiş tekrar eklemeyi önlemek için hata mesajı gönder
    header('location:../favorites.php');
    exit;
}

// Favorilere ekleme işlemi
$stmt_insert = $conn->prepare("INSERT INTO favorites (user_id, product_id) VALUES (?, ?)");
$stmt_insert->bind_param("ii", $user_id, $product_id);

if ($stmt_insert->execute()) {
    header('location:../favorites.php');
} else {
    header('location: single_product.php?product_id=' . $product_id . '&error=Ürün favorilere eklenirken bir hata oluştu');
}

$stmt_check->close();
$stmt_insert->close();
$conn->close();
?>
