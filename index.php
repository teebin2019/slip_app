<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class=" d-flex flex-column " style="min-height: 100vh;">
    <?php include_once 'header.php'; ?>
    <div class="container d-flex mt-5 justify-content-center ">
        <div class="card  flex-grow-1" style="max-width: 420px;">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                <form action="login_db.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>


                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </form>
                <p class="mt-3">เข้าหน้า <a href="register.php" rel="noopener noreferrer">ลงทะเบียน</a></p>
            </div>

        </div>

    </div>
    <?php include_once 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>