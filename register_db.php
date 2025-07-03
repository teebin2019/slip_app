<?php
include_once 'connent/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json; charset=utf-8');

        // รับข้อมูล JSON
        $data = json_decode(file_get_contents('php://input'), true);


        $username = isset($data['username']) ? trim($data['username']) : '';
        $email = isset($data['email']) ? trim($data['email']) : '';
        $password = isset($data['password']) ? trim($data['password']) : '';
        $c_password = isset($data['c_password']) ? trim($data['c_password']) : '';


        if (!$username) {
            echo json_encode(['error' => 'กรุณากรอก username']);
            return;
        }
        if (!$email) {
            echo json_encode(['error' => 'กรุณากรอก email']);
            return;
        }
        if (!$password) {
            echo json_encode(['error' => 'กรุณากรอก password']);
            return;
        }

        // ค้นหา username
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetchColumn(0);

        if (!empty($user)) {
            echo json_encode(['error' => 'username ซ้ำ']);
            return;
        }

        // ค้นหา email
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetchColumn(0);

        if (!empty($user)) {
            echo json_encode(['error' => 'email ซ้ำ']);
            return;
        }

        if ($password != $c_password) {
            echo json_encode(['error' => 'รหัสผ่านไม่ตรงกัน']);
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        // เพิ่มข้อมูล
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'สมัครสมาชิกสำเร็จ']);
    } else {
        echo json_encode(['error' => 'REQUEST_METHOD ผิด']);
    }
} catch (PDOException $e) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => $e->getMessage()]);
}
