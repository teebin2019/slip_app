<?php
session_start();
include_once '../connent/db.php';
try {
    $id = $_GET['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (($user['username'] != $username) || $user['email'] != $email) {
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($user)) {
            echo 'มีusername แล้ว';
            return;
        }

        $stmt = $conn->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($user)) {
            echo 'มีemail แล้ว';
            return;
        }
    }

    $stmt = $conn->prepare("UPDATE users SET username = :username , email = :email WHERE id = :id");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: index.php"); //reset_password ถูกต้องและกระโดดไปหน้าตามที่ต้องการ

} catch (\Exception $e) {
    echo 'Error' . $e->getMessage();
}
