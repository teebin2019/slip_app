<?php
session_start();
include_once 'connent/db.php';

try {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$email) {
        echo 'กรุณากรอก email';
        return;
    }
    if (!$password) {
        echo 'กรุณากรอก password';
        return;
    }

    // ค้นหา email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch();


    if (!empty($row['email'])) {
        $hash = $row['password'];
        // เช็ค password
        if (password_verify($password, $hash)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('Location: dashboard.php'); //dashboard ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
        }
        echo 'Invalid password.';
    } else {
        echo "Invalid email.";
    }
} catch (PDOException $e) {
    echo "Login Error: " . $e->getMessage();
}
