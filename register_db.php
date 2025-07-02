<?php
include_once 'connent/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $c_password = trim($_POST['c_password']);

        if (!$username) {
            echo 'กรูณากรอก username';
            return;
        }
        if (!$email) {
            echo 'กรูณากรอก email';
            return;
        }
        if (!$password) {
            echo 'กรูณากรอก password';
            return;
        }


        // ค้นหา username
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetchColumn(0);

        if (!empty($user)) {
            echo "username
         Dupicate";
            return;
        }

        // ค้นหา email
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetchColumn(0);

        if (!empty($user)) {
            echo "email Dupicate";
            return;
        }


        if ($password != $c_password) {
            echo "รหัสผ่านไม่ตรงกัน";
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        // เพิ่มข้อมูล
        $stmt = $conn->prepare("INSERT INTO users (username, email, password)
    VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);
        $stmt->execute();
        header('Location: index.php'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
        echo "New records created successfully";
    } else {
        echo "REQUEST_METHOD ผิด";
    }
} catch (PDOException $e) {
    echo "Register Error: " . $e->getMessage();
}
