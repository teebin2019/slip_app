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
                <form action="register_db.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" name="c_password" class="form-control" id="exampleInputPassword1">
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

</body>

</html>