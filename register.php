<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign Up</title>
</head>

<body class=" d-flex flex-column" style="min-height: 100vh;">
    <?php include_once 'header.php' ?>
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                Sign Up
            </div>
            <div class="card-body">
                <div id="error"></div>
                <div id="success"></div>
                <!-- <div class="alert alert-danger" role="alert">
                    A simple danger alert—check it out!
                </div> -->
                <form id="formsubmit">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="c_password" class="form-label">Confirm Password</label>
                        <input type="password" name="c_password" class="form-control" id="c_password">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
                <p class="mt-3">เข้าหน้า <a href="index.php" rel="noopener noreferrer">เข้าสู่ระบบ</a></p>
            </div>

        </div>
    </div>
    <?php include_once 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
        $("#formsubmit").submit(function(event) {
            event.preventDefault();
            const username = $('#username').val();
            const email = $('#email').val();
            const password = $('#password').val();
            const c_password = $('#c_password').val();
            $.ajax({
                url: "register_db.php",
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                data: JSON.stringify({
                    "username": username,
                    "email": email,
                    "password": password,
                    "c_password": c_password
                }),
                success: function(response) {
                    console.log(response)
                    if (response.error) {
                        const messent = `<div class="alert alert-danger" role="alert">${response.error} </div>`
                        $('#error').html(messent)
                    }
                    if (response.success) {
                        const messent = `<div class="alert alert-success" role="alert">${response.message} </div>`
                        $('#error').html(messent)
                    }
                    // You will get response from your PHP page (what you echo or print)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            })
        });
    </script>

</body>

</html>