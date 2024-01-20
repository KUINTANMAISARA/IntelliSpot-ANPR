<?php
    require_once('connection.php');
    //error_reporting(0);
?>

<?php 
    // To retrieve value for compund amount and type of compound from database table
    $studID = $_SESSION['studID'];
    $unpaid = 'unpaid';

    $sql = "SELECT * FROM compound WHERE studentID = '$studID' AND paymentStatus = 'unpaid' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //echo $sql;

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
    <link rel="stylesheet" href="./payment.css">

</head>
<body>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <center><main>
            <h1>maybank2u.com</h1>
            <div class="container">
                <center><img src="./images/FPX.png" alt="fpxLogo"></center>
                <br>
                <h3>Step 1 out of 1</h3>

                <div class="formContainer">
                    <form action="">
                        <div class="input_box">
                            <label for="">From account : </label>
                            <input type="text" id="from" name="accountNum" placeholder="Your account number" required/>
                        </div>

                        <div class="input_box">
                            <label for="">Merchant Name : </label>
                            <input type="text" id="name" name="merchantName" placeholder="Merchant Name" required/>
                        </div>

                        <div class="input_box">
                            <label for="">Payment Reference : </label>
                            <input type="text" id="reference" name="reference" value="<?php echo $row['compoundType'] ?>" disabled/>
                        </div>

                        <div class="input_box">
                            <label for="">Amount : </label>
                            <input type="text" id="amount" name="amount" value="<?php echo $row['compoundAmount'] ?>" disabled/>
                        </div>

                        <button type="button" onclick="location.href='paymentSuccess.php'">Pay Now</button>
                        <br>
                        <br>
                        <a href="student.php">cancel</a>
                    </form>
                </div>
            </div>
        </main></center>
        
    <script src="./orders.js"></script>
    <script src="./index.js"></script>
</body>
</html>