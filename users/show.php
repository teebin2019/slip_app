<?php
session_start();
include_once '../connent/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$json_obj = json_encode($row);
$user = json_decode($json_obj);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Users</title>
</head>

<body class=" d-flex flex-column" style="min-height: 100vh;">
    <?php include_once '../header.php' ?>
    <div class="container my-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Users</h2>
                <!-- <a href="#" class="btn btn-success">Add</a> -->
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user->username ?? '' ?>" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="<?= $user->email ?? '' ?>" id="email">
                    </div>
                    <a href="index.php" class="btn btn-primary">ย้อนกับ</a>
                </form>
            </div>
        </div>
    </div>
    <?php include_once '../footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>