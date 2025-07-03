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
                <form action="login_db.php" id="formsubmit" method="post">
                    <div id="message"></div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <p class="text-end">
                        <a href="forget_password.php" class="link-offset-2 link-underline link-underline-opacity-0">Forget Password</a>
                    </p>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>


                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </form>
                <p class="mt-3">เข้าหน้า <a href="register.php" class="link-offset-2 link-underline link-underline-opacity-0" rel="noopener noreferrer">ลงทะเบียน</a></p>
            </div>

        </div>

    </div>
    <?php include_once 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $("#formsubmit").submit(function(event) {
            event.preventDefault();
            const email = $('#email').val();
            const password = $('#password').val();
            $.ajax({
                url: "login_db.php",
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                data: JSON.stringify({
                    "email": email,
                    "password": password,
                }),
                success: function(response) {
                    console.log(response)
                    if (response.error) {
                        const message = `<div class="alert alert-danger" role="alert">${response.error} </div>`
                        $('#message').html(message)
                    }
                    if (response.success) {
                        // const message = `<div class="alert alert-success" role="alert">${response.message} </div>`
                        // $('#message').html(message)
                        $(location).prop('href', 'dashboard.php')
                        
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