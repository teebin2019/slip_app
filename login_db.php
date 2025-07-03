<?php
session_start();
include_once 'connent/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json; charset=utf-8');
        $data = json_decode(file_get_contents('php://input'), true);
        $email =   isset($data['email']) ? trim($data['email']) : '';
        $password =  isset($data['password']) ? trim($data['password']) : '';

        if (!$email) {
            echo json_encode(['error' => 'กรุณากรอก email']);
            return;
        }

        if (!$password) {
            echo  json_encode(['error' => 'กรุณากรอก password']);
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
                echo json_encode(['success' => true, 'message' => 'เข้าสู่ระบบสำเร็จ']);
                return;
                // header('Location: dashboard.php'); //dashboard ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
            }
            echo json_encode(['error' => 'รหัสผ่านไม่ตรงกัน']);
        } else {
            echo json_encode(['error' => 'ไม่พบอีเมล']);
        }
    } else {
        echo json_encode(['error' => 'REQUEST_METHOD ผิด']);
    }
} catch (PDOException $e) {
    echo "Login Error: " . $e->getMessage();
}
