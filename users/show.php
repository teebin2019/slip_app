<?php session_start();
include_once '../connent/db.php';
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$row = $stmt->fetchAll();
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $key => $item): ?>
                            <tr>
                                <th scope="row"> <?= ++$key ?></th>
                                <td> <?= $item['username'] ?></td>
                                <td><?= $item['email'] ?></td>
                                <td><?= $item['created_at'] ?></td>
                                <td><?= $item['updated_at'] ?></td>
                                <td>
                                    <a href="#" class="btn btn-info">Show</a>
                                    <a href="#" class="btn btn-warning">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include_once '../footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>