<?php
session_start();
include_once '../connent/db.php';
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json; charset=utf-8');
        // รับข้อมูล JSON
        $data = json_decode(file_get_contents('php://input'), true);

        $id = isset($data['id']) ? trim($data['id']) : '';
        $username = isset($data['username']) ? trim($data['username']) : '';
        $email = isset($data['email']) ? trim($data['email']) : '';

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            echo json_encode(['error' => 'หาไม่เจอ']);
            return;
        }

        if (($user['username'] != $username) || $user['email'] != $email) {
            $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($user)) {
                echo json_encode(['error' => 'มีusername แล้ว']);
                return;
            }

            $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($user)) {
                echo  json_encode(['error' => 'มีemail แล้ว']);
                return;
            }
        }

        $stmt = $conn->prepare("UPDATE users SET username = :username , email = :email WHERE id = :id");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo  json_encode(['success' => true, 'message' => 'แก้ไขข้อมูลสำเร็จ']);
    } else {
        echo json_encode(['error' => 'REQUEST_METHOD ผิด']);
    }
} catch (\Exception $e) {
    echo   json_encode(['status' => 500, 'message' => 'Error' . $e->getMessage()]);
}
