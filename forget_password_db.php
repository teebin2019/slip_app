<?php
session_start();
include_once 'connent/db.php';

try {
    $email = $_POST['email'];

    if (!$email) {
        echo 'กรุณากรอก email';
        return;
    }

    // ค้นหา email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch();


    if (!empty($row['email'])) {
        $token = bin2hex(random_bytes(16)); //generates a crypto-secure 32 characters long 
        // echo $token;
        $id = $row['id'];

        $stmt = $conn->prepare("UPDATE users SET token = :token WHERE id = :id");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: reset_password.php?token=$token"); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
        echo 'สำเร็จ';
    } else {
        echo "Invalid email.";
    }
} catch (PDOException $e) {
    echo "Forget Password Error: " . $e->getMessage();
}
