<?php
    include("connection.php");

?>
<?php
    
    $studID = $_SESSION['studID'];
    //This section is to display car plate in form field
    $sqlCheck = "SELECT carPlateNumber,renewAt FROM sticker WHERE studentID = '$studID'";
    $resultCheck = mysqli_query($conn,$sqlCheck);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Sticker</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <link rel="stylesheet" href="./stylePrint.css">

</head>
<body>
    
        <center>
            <div class="box">
                <form>
                    <div class="image">
                        
                    </div>
                    <?php
                    
                    if ($resultCheck) {

                    $rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
                    
                    // Calculation when the sticker will be expired
                    $date=date_create($rowCheck['renewAt']);
                    $date1 = date_format($date,'Y-m-d');
                    $expired = date('d-m-Y', strtotime($date1. ' + 30 days'));

                    $date2=date_create($rowCheck['renewAt']);
                    $renew = date_format($date2, 'd-m-Y');
                   
                    if ($rowCheck !== null) { ?>
                        <!-- Data was fetched successfully, and $rowSticker is not null -->
                        <h1>Car Number : </h1>
                        <input type="text" name="carPlate" id="carName" value="<?php echo $rowCheck['carPlateNumber']; ?>" required/>
                        <br><br>
                        <h1>Renew at : </h1>
                        <input type="text" name="carPlate" id="carName" value="<?php echo  $renew ?>" required/>
                        <br><br>
                        <h1>Expired at : </h1>
                        <input type="text" name="carPlate" id="carName" value="<?php echo $expired ?>" required/>
                    <?php
                    }else if($rowCheck == null){ ?>
                        <!-- No data found -->
                        <input type="text" name="carName" id="carName" value="Not Applicable" disabled/>
                    <?php
                    }
                    } else { 
                        // Query failed
                        echo 'Null';
                    }?>
                    <br>
                    <br>
                    <h2>PELAJAR</h2>
                </form>
            </div>
            <div class="buttonPrint">
                <button onclick="window.print();"> Print </button>
                <span>
                    <button onclick="location.href='student.php'"> Return </button>
                </span>
            </div>
            
        </center>


    
</body>
</html>