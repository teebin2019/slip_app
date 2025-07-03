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
                <div class="mb-3">
                    <label for="formFile" class="form-label">อัพโหลด</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="visually-hidden" id="show">
                    <img src="" alt="สลิปโอนเงิน" height="300px" id="img">
                    <p>ผู้โอน : <span id="sender-displayName"></span> จาก : <span id="sendingBankName"></span></p>
                    <p>ผู้ถูกโอน <span id="receiver-displayName"></span>: จาก <span id="receivingBankName"></span></p>
                    <p>จำนวนเงิน <span id="amount"></span> </p>

                </div>

            </div>
        </div>
    </div>

    <?php include_once 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
        // Example: add a change event handler for the file input
        $("#formFile").on("change", function() {
            // Handle file selection here
            console.log("File selected:", this.files[0]);

            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
            var form = new FormData();
            form.append("file", this.files[0]);

            var settings = {
                "url": "verify.php",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                console.log(JSON.parse(response));
                const data = JSON.parse(response)
                $('#show').removeClass('visually-hidden')
                $('#sender-displayName').text(data.sender.displayName)
                $('#sendingBankName').text(data.sendingBankName)
                $('#receiver-displayName').text(data.receiver.displayName)
                $('#receivingBankName').text(data.receivingBankName)
                $('#amount').text(data.amount)


            });
        });
    </script>

</body>

</html>