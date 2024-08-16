<?php

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback);

    if ($stmt->execute()) {
        echo "Geri bildiriminiz için teşekkür ederiz!";
    } else {
        echo "Bir hata oluştu. Lütfen tekrar deneyiniz.";
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: contact.php');
}
?>
