<?php session_start();
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
                <div id="message"></div>
                <form id="formsubmit">
                    <div class="mb-3">
                        <label for="id" class="form-label">Username</label>
                        <input type="hidden" name="id" class="form-control" value="<?= $user->id ?? '' ?>" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user->username ?? '' ?>" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="<?= $user->email ?? '' ?>" id="email">
                    </div>
                    <button class="btn btn-primary" type="submit">ยันยืน</button>
                </form>
            </div>
        </div>
    </div>
    <?php include_once '../footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $("#formsubmit").submit(function(event) {
            event.preventDefault();
            const id = $('#id').val();
            const username = $('#username').val();
            const email = $('#email').val();
            $.ajax({
                url: "update.php",
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                data: JSON.stringify({
                    "id": id,
                    "username": username,
                    "email": email,
                }),
                success: function(response) {
                    console.log(response)
                    if (response.error) {
                        const message = `<div class="alert alert-danger" role="alert">${response.error} </div>`
                        $('#message').html(message)
                    }
                    if (response.success) {
                        $(location).prop('href', 'index.php')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            })
        });
    </script>

</body>

</html>