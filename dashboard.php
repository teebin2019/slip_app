<?php session_start();

if (!$_SESSION) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body class="d-flex  flex-column" style="min-height: 100vh;">
    <?php include_once 'header.php' ?>

    <div class="container mt-5">
        <div class="card ">
            <div class="card-header">
                <div class="card-text">Welcome to <?= $_SESSION['username']; ?></div>
            </div>
            <div class="card-body">
                <h5 class="card-title">กรุณาตรวจสอบการชำระเงิน</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card’s content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>

    <?php include_once 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>