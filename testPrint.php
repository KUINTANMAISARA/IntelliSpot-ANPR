<?php
    include("connection.php");

?>

<?php
    
    $studID = $_SESSION['studID'];
    //Check expiration of sticker
    $sqlCheck = "SELECT carPlateNumber,renewAt FROM sticker WHERE studentID = '$studID'";
    $resultCheck = mysqli_query($conn,$sqlCheck);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <link rel="stylesheet" href="./styleTestP.css">
</head>
<body>

    <div class="container">
        <div class="printSect">
            <div class="circle">
                <div class="uitmImg"></div>
                <div class="barCode"></div>
                <div class="valid">
                    <form>
                        <center>
                            <label for="due">VALID UNTIL</label><br>

                            <?php
                    
                            if ($resultCheck){

                            $rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
                            
                            // Calculation when the sticker will be expired
                            $date=date_create($rowCheck['renewAt']);
                            $date1 = date_format($date,'Y-m-d');
                            $expired = date('d-m-Y', strtotime($date1. ' + 30 days'));
                            }else { 
                                // Query failed
                                echo 'Null';
                            }
                            ?>

                            <input type="text" name="due" id="due" value="<?php echo $expired ?>" disabled/>
                        <center>
                    </form>
                </div>

            </div>

            <div class="buttonContainer">
                <div class="button1">
                    <button type="submit" onclick="window.print();">Print</button></div>
                <div class="button2">
                    <button type="submit" onclick="location.href='student.php'">Return</button>
                </div>
            </div>
           
        </div>
    </div>

    
</body>
</html>