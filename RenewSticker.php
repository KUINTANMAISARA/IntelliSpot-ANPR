<?php
    include("connection.php");

?>

<?php
    
    $studID = $_SESSION['studID'];
    //echo "Today is : ".date("Y-m-d");

    //This section is to display current details of student in form 
    $sql = "SELECT carName, carPlateNumber FROM sticker WHERE studentID = '$studID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if(isset($_POST['submit'])) //This section only will be executed if student click on 'submit' button
    {
        //Update query for column renewAt 
        $update = "UPDATE sticker set carName='". $_POST['carName'] ."',
        carPlateNumber='". $_POST['carPlateNumber'] ."',
        renewAt='".date("Y-m-d")."'
        WHERE studentID = '$studID'";

        mysqli_query($conn,$update);
        //$message = "<p style='color:green;'>Sticker renewed Successfully !</p><br>"; //pop up message indicate the process is successful

        echo '<script>
            
            alert("Confirm ?");
            window.location.href = "printPayment.php";
            
            </script>';
    }

    $resultUpdate = mysqli_query($conn,"SELECT * FROM sticker WHERE studentID = '$studID'");
    $rowUpdate = mysqli_fetch_array($resultUpdate);
?>

<!--To disable student renewing sticker if they dont even register yet-->
<?php
    $sqlCheck = "SELECT carName,carPlateNumber,renewAt FROM sticker WHERE studentID = '$studID'";
    $resultCheck = mysqli_query($conn,$sqlCheck);
    //$rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);  
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
                <a href="RegisterSticker.php">
                    <span class="material-icons-sharp">app_registration</span>
                    <h3>Apply Sticker</h3>
                </a>
                <a href="RenewSticker.php" class="active">
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
            <h1>Renew Sticker</h1>
            <div class="container">
                <div class="containerForm">
                    <!-- Display message if record successful updated-->
                    <?php if(isset($message)) { echo $message;} ?>  
                    <div class="title">Renew</div>
                    <form name="form" method="POST">
                        <div class="registerDetails">
                            <div class="input-box">
                                <br>
                                <span class="details">Car Name</span>
                                <!-- If the student have not register the sticker yet and did not need to renew, the form will be disabled -->
                                                    <?php 
                                                        
                                                        if ($resultCheck) {
                                                            $rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
                                                           

                                                            if ($rowCheck !== null) {

                                                                //$currentDate = date('Y-m-d'); //set current date format
                                                                $stickerDate = $rowCheck['renewAt']; //retrieve sticker date registered
                                                               
                                                                $currentDateString = date('Y-m-d'); // Current date

                                                                // Create DateTime objects for the two dates
                                                                $oldDate = new DateTime($stickerDate);
                                                                $currentDate = new DateTime($currentDateString);
                                                        
                                                                // Calculate the difference in days
                                                                $interval = $currentDate->diff($oldDate);
                                                        
                                                                // Get the total number of days
                                                                $dayDiff = $interval->days;
                                                        
                                                               

                                                                if($dayDiff > 50){ ?>
                                                                    <input type="text" name="carName" id="carName" value="<?php echo $rowCheck['carName']; ?>" required/>
                                                                <?php
                                                                }else{ ?>
                                                                    <!-- Not expired yet -->
                                                                    <input type="text" name="carName" id="carName" value="Not Applicable" disabled/>
                                                                <?php
                                                                }
                                                            }else{ ?>
                                                              
                                                                <input type="text" name="carName" id="carName" value="Not Applicable" disabled/>
                                                                
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
                                <!-- If the student have not regsiter the sticker yet , the form will be disabled -->
                                <?php 
                                                        if ($resultCheck) {
                                                                //$rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
    
                                                                if ($rowCheck !== null) {
    
                                                                    //$currentDate = date('Y-m-d'); //set current date format
                                                                    $stickerDate = $rowCheck['renewAt']; //retrieve sticker date registered
                                                                   
                                                                     //$currentDate = date('Y-m-d'); //set current date format
                                                                        $stickerDate = $rowCheck['renewAt']; //retrieve sticker date registered
                                                                    
                                                                        $currentDateString = date('Y-m-d'); // Current date

                                                                        // Create DateTime objects for the two dates
                                                                        $oldDate = new DateTime($stickerDate);
                                                                        $currentDate = new DateTime($currentDateString);
                                                                
                                                                        // Calculate the difference in days
                                                                        $interval = $currentDate->diff($oldDate);
                                                                
                                                                        // Get the total number of days
                                                                        $dayDiff = $interval->days;

                                                                    if($dayDiff > 50){ ?>
                                                                        <input type="text" name="carPlateNumber" id="carPlateNumber" value="<?php echo $rowCheck['carPlateNumber']; ?>" required/>
                                                                    <?php
                                                                    }else{ ?>
                                                                        <!-- Not expired yet -->
                                                                        <input type="text" name="carPlateNumber" id="carPlateNumber" value="Not Applicable" disabled/>
                                                                    <?php
                                                                    }
                                                                }else { ?>
                                                                   <input type="text" name="carName" id="carPlateNumber" value="Not Applicables" disabled/>
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
                                                        if ($resultCheck) {
                                                           
                                                            //$rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
                                                            if ($rowCheck !== null) {
    


                                                                //$currentDate = date('Y-m-d'); //set current date format
                                                                $stickerDate = $rowCheck['renewAt']; //retrieve sticker date registered
                                                                   
                                                                //$currentDate = date('Y-m-d'); //set current date format
                                                                   $stickerDate = $rowCheck['renewAt']; //retrieve sticker date registered
                                                               
                                                                   $currentDateString = date('Y-m-d'); // Current date

                                                                   // Create DateTime objects for the two dates
                                                                   $oldDate = new DateTime($stickerDate);
                                                                   $currentDate = new DateTime($currentDateString);
                                                           
                                                                   // Calculate the difference in days
                                                                   $interval = $currentDate->diff($oldDate);
                                                           
                                                                   // Get the total number of days
                                                                   $dayDiff = $interval->days;

                                                                if($dayDiff > 50 ){ ?>
                                                                    <input type="submit" value="Renew" name="submit"> <!-- Inable the renew button -->
                                                                <?php
                                                                }else{ ?>
                                                                    <!-- Not expired yet -->
                                                                    <input type="submit" name="Renew" id="carPlateNumber" value="Renew" disabled/>
                                                                <?php
                                                                }
                                                            }
                                                            else{ ?>
                                                                <!-- No data found -->
                                                                <input type="submit" value="Renew" name="submit" disabled> <!-- Inable the renew button -->
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
                                <td><?php 
                                //This section is to display current details of student in form 
                                $sql = "SELECT * FROM student WHERE studentID = '$studID'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                echo $row['studentName']; ?></td>
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
</body>
</html>