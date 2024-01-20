<?php
    require_once('connection.php');
    error_reporting(0);
?>

<?php 
    $studID = $_SESSION['studID'];
    $paymentPaid = 'paid';

    if(isset($_POST['submit']))
    {
        //Update query
        $sql = "UPDATE compound set paymentStatus = '$paymentPaid' WHERE studentID = '$studID' ";

        $res = mysqli_query($conn,$sql);
        if($res==1){echo 
            '<script>
                
            alert("Payment Successful !");
            
            window.location.href = "student.php";
            
            </script>';}
        else {
                echo '<script>
                
                alert("Payment Successful !");
            
                window.location.href = "student.php";
                
                </script>';}
        mysqli_close($conn);

    }

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
            <form action="paymentSuccess.php" method="POST">
                <h2>Payment Success</h2>
                <p>Your account has been deducted</p>
                
                <input type="submit" value="OK" name="submit">
                
            </form>
        </div>
</body>
</html>