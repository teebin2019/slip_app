<?php
session_start();
include_once 'connent/db.php';

try {
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $token = $_POST['token'];

    if (!$password) {
        echo 'กรุณากรอก password';
        return;
    }
    if (!$c_password) {
        echo 'กรุณากรอก c_password ';
        return;
    }

    if ($password  != $c_password) {
        echo "รหัสผ่านไม่ตรงกัน";
        return;
    }

    // ค้นหา email
    $stmt = $conn->prepare("SELECT * FROM users WHERE token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $row = $stmt->fetch();

    if (!empty($row)) {
        $id = $row['id'];
        $token = null;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET  password = :password , token = :token WHERE id = :id");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $hash);
        $stmt->execute();
        header('Location: index.php'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
        echo 'สำเร็จ';
    } else {
        echo "Invalid token.";
    }
} catch (PDOException $e) {
    echo "Forget Password Error: " . $e->getMessage();
}
