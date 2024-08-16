<?php
session_start();
include('connection.php');

// Kullanıcı oturum açmamışsa giriş sayfasına yönlendir
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    // Favorilerden çıkar
    $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param('ii', $user_id, $product_id);

    if ($stmt->execute()) {
        header('location: ../favorites.php');
        exit();
    } else {
        echo "Favorilerden çıkarma işlemi başarısız oldu.";
    }
} else {
    header('location: favorites.php');
    exit();
}
