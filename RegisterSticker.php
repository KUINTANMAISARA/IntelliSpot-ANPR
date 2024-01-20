<?php
    include("connection.php");
?>

<?php
    $studID = $_SESSION['studID']; 

    $sql = "SELECT * FROM student WHERE studentID = '$studID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
   
?>

<?php // To allow student to registered one sticker 

    $sqlCheckExist = "SELECT carName,carPlateNumber FROM sticker WHERE studentID = '$studID'";
    $resultExist = mysqli_query($conn,$sqlCheckExist);
?>

<?php
    if(isset($_POST['submit'])){

        $currentDate = date('Y-m-d'); //set current date format
        $carName = $_POST['carName'];
        $carPlate = $_POST['carPlate'];
        $carPlateU = strtoupper($carPlate); //convert the string to uppercase
        echo $carPlateU;
    
        //Checking existing car plate query
        $sqlCheck = "SELECT carPlateNumber FROM sticker WHERE carPlateNumber = '$carPlateU'";
        $check=mysqli_query($conn,$sqlCheck);
        $rowC = mysqli_fetch_array($check, MYSQLI_ASSOC);
        $countC = mysqli_num_rows($check);

        if($countC==1){
            echo '<script>
            
            alert("Car Plate Number has been registered !");
            window.location.href = "registerSticker.php";
            
            </script>';
        }else{
            $sqlCheckInsert = "INSERT INTO sticker (carName, carPlateNumber, studentID, renewAt) VALUES ('$carName', '$carPlateU', '$studID', '$currentDate')";
            mysqli_query($conn,$sqlCheckInsert);
            
            header("Location: paymentRegisterSticker.php"); 
        } 
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

    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/logo.png" alt="">
                    <h2 class="text-muted">INTELLI <span class="danger">SPOT</span></h2>
                </div>
                <div>
                    <div class="close" id="close-btn">
                        <span class="material-icons-sharp">close</span>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <a href="student.php">
                    <span class="material-icons-sharp"> grid_view </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="profile.php">
                    <span class="material-icons-sharp">person</span>
                    <h3>Profile</h3>
                </a>
                <a href="#" class="active">
                    <span class="material-icons-sharp">app_registration</span>
                    <h3>Apply Sticker</h3>
                </a>
                <a href="RenewSticker.php">
                    <span class="material-icons-sharp"> directions_car</span>
                    <h3>Renew Sticker</h3>
                <a href="logout.php" >
                    <span class="material-icons-sharp"> logout </span>
                    <h3>Logout</h3>
                </a>
                </a>
            </div>
        </aside>
        <!-- ----- END OF ASIDE SECTION ----- -->

        <main>
            <br>
            <h1>Register Car Sticker Parking</h1>
            <div class="container">
                <div class="containerForm">
                    <div class="title">Application Form</div>
                    <form  action="RegisterSticker.php" name="applySticker" onsubmit="return isvalid()" method="POST">
                        <div class="registerDetails">
                            <div class="input-box">
                                <br>
                                <span class="details">Car Name</span>
                                 <!-- If the student have regsiter the sticker , the form will be disabled -->
                                 <?php 
                                                        if ($resultExist) {

                                                            $rowCheck = mysqli_fetch_array($resultExist, MYSQLI_ASSOC);
                                                            

                                                            if ($rowCheck !== null) { ?>
                                                                
                                                                <input type="text" name="carName" id="carName" value="<?php echo $rowCheck['carName']; ?>" disabled/>

                                                            <?php
                                                            }else if($rowCheck == null){ ?>
                                                                <!-- No data found -->
                                                                <input type="text" name="carName" id="carName" placeholder="Example : Proton" required/>
                                                            <?php
                                                            }
                                                        } else {
                                                            // Query failed
                                                            echo 'Null';
                                                        }
                                                    ?>
                            </div>

                            <div class="input-box">
                                <br>
                                <span class="details">Car Plate Number</span>
                                 <?php 
                                    if ($resultExist) {
                                        if ($rowCheck !== null) { ?>
                                            <input type="text" name="carPlate" id="carPlate" value="<?php echo $rowCheck['carPlateNumber']; ?>" disabled/>
                                        <?php
                                        }else if($rowCheck == null){ ?>
                                            <!-- No data found -->
                                            <input type="text" name="carPlate" id="carPlate" placeholder="Example : ABC 1234" required/>
                                        <?php
                                        }
                                        } else {
                                            // Query failed
                                            echo 'Null';
                                        }
                                        ?>
                            </div>
                        </div>
                        <div class="button">
                            <?php 
                                if ($resultExist) {
                                   
                                    if ($rowCheck !== null) { ?>
                                        <!-- Student has registered -->
                                        <input type="submit" value="Register" name="submit" disabled> <!-- disabled the register button -->
                                        <?php
                                    } else { ?>
                                    <!-- student has not registered -->
                                    <input type="submit" value="Register" name="submit"> <!-- Disable the renew button -->
                                    <?php
                                    }
                                    } else {
                                    // Query failed
                                        echo 'Null';
                                     }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <!-- -------- END OF MAIN ---------- -->

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, 
                            <b>
                                <td><?php echo $row['studentName']; ?></td>
                            <?php
                                
                            ?>
                            </b>
                        </p>
                        <small class="text-muted">Student</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./images/profile.jpg" alt="profile">
                    </div>
                </div>
            </div>
            <!-- END OF TOP SECTION -->
            <div class="notes">
                <h2>Important</h2>
                <div class="importantNotes">
                    <small class="text-muted"> Car with 3 unpaid compound in a row will be clamped immediately!</small>
                </div>
            </div>
        </div>
    </div>
    <script src="./orders.js"></script>
    <script src="./index.js"></script>
    <script>
            function isvalid(){
                var carName = document.form.carName.value;
                var carPlate = document.form.carPlate.value;
                if(carName.length=="" && carPlate.length==""){
                    alert("Car name and car plate is empty !");
                    return false
                }
                else if{
                    if(carName.length==""){
                    alert("Car name is empty!");
                    return false
                    }
                    if(carPlate.length==""){
                    alert("Car plate is empty!");
                    return false
                    }
                }
                else if{
                    if(carPlate.length >="8" || carPlate.length <="8"){
                        alert("Car plate format is wrong !");
                        return false
                    }
                }
            }
    </script>
</body>
</html>