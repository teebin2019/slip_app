<?php
session_start();
include_once '../connent/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE  FROM users WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
header("Location: index.php"); //reset_password ถูกต้องและกระโดดไปหน้าตามที่ต้องการ