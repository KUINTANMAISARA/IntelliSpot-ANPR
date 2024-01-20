<?php
    require_once('connection.php');
    error_reporting(0);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intellispot System</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <!--<link rel="stylesheet" href="./style.css">-->
    <link rel="stylesheet" href="./paymentSuccess.css">
</head>
<body>
        <div class="popup">
            <form action="testPrint.php" method="POST">
                <h2>Payment Success</h2>
                <p>Your account has been deducted</p>
                <input type="submit" value="OK" name="submit">
                
            </form>
        </div>
</body>
</html>