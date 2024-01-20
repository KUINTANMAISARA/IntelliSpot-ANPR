<?php
    include('connection.php');
    error_reporting(0);
?>

<?php
    $studID = $_SESSION['studID']; 

    $sql = "SELECT * FROM student WHERE studentID = '$studID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
?>

<!-- SUM of total compound a student receive -->
<?php
    $studID = $_SESSION['studID']; 

    $sqlC = "SELECT SUM(compoundAmount) as sum FROM compound WHERE studentID = '$studID'";
    $resultC = mysqli_query($conn, $sqlC);
    
    $rowC = mysqli_fetch_array($resultC, MYSQLI_ASSOC);
?>

<!-- SUM of total sticker a student applied -->
<?php
    $studID = $_SESSION['studID']; 

    $sqlT = "SELECT COUNT(stickerID) as count FROM sticker WHERE studentID = '$studID'";
    $resultT = mysqli_query($conn, $sqlT);
    
    $rowT = mysqli_fetch_array($resultT, MYSQLI_ASSOC);
?>

<!-- COUNT unpaid compound -->
<?php
    $studID = $_SESSION['studID']; 
    $unpaid = "unpaid";

    $sqlU = "SELECT COUNT(compoundID) as unpaidComp FROM compound WHERE studentID = '$studID' AND paymentStatus = '$unpaid'";
    $resultU = mysqli_query($conn, $sqlU);
    
    $rowU = mysqli_fetch_array($resultU, MYSQLI_ASSOC);
?>

<!-- To check if the sticker is expired or not -->
<?php

    $currentDate = date('Y-m-d'); //set current date format

    $sql = "SELECT renewAt FROM sticker WHERE studentID = '$studID'";
    //$sql = "SELECT createdAt FROM sticker WHERE studentID = '$studID'";
    $resultS = mysqli_query($conn, $sql);
    $rowS = mysqli_fetch_array($resultS, MYSQLI_ASSOC);
    $stickerDate = $rowS['renewAt']; //retrieve sticker date registered

   
        // Assuming you have two date strings or DateTime objects
     
        $currentDateString = date('Y-m-d'); // Current date

        // Create DateTime objects for the two dates
        $oldDate = new DateTime($stickerDate);
        $currentDate = new DateTime($currentDateString);

        // Calculate the difference in days
        $interval = $currentDate->diff($oldDate);

        // Get the total number of days
        $dayDiff = $interval->days;

        //echo "The difference between $currentDateString and $oldDateString is $dayDiff days.";
      

?>

<!-- IF stickerID has expired -->
<?php

    $compoundType = "Expire Sticker";
    $compoundAmount = 100;
    $paymentPaid = "paid";
    $paymentUnpaid = "unpaid";

    // To check if the student id and compound type has been inserted 
    $sqlCheck = "SELECT compoundID FROM compound WHERE compoundType='$compoundType' AND studentID='$studID'";
    $resultCheck = mysqli_query($conn,$sqlCheck);
    $rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);

    if($dayDiff > 60  && $rowCheck == null){ // if the data has not been inserted
        
        $sqlInsertCompound = "INSERT INTO compound (compoundType, compoundAmount, paymentStatus, studentID) VALUES ('$compoundType', '$compoundAmount', '$paymentUnpaid', '$studID')";
        mysqli_query($conn,$sqlInsertCompound);
        
    }else if($dayDiff  > 60 && $rowCheck != null){ // if the data has been inserted
        //exit(); //stop the script from running
    }
?>

<!-- To display data from compound table in database -->
<?php
    $sql = "SELECT * FROM compound WHERE studentID = '$studID'";
    $resultCompound = mysqli_query($conn, $sql);
    //$rowCompound = mysqli_fetch_array($resultCompound, MYSQLI_ASSOC);

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
                <a href="#" class="active">
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
                <a href="RenewSticker.php" >
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
            <h1>Dashboard</h1>

            <div class="insights">
                 <div class="compound">
                    <!--<span class="material-icons-sharp">receipt_long</span>-->
                    <div class="middle">
                        <div class="left">
                            <h3>Total Compound</h3>
                            <h1>RM <?php echo $rowC['sum']; ?>.00</h1>
                        </div>
                        <div class="progress">
                            
                            <!--<svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>-->
                            <div class="number">
                                <span class="material-icons-sharp">receipt_long</span>
                                <!--<p>56%</p>-->
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>

                <div class="clamp">
                    
                    <div class="middle">
                        <div class="left">
                            <h3>Unpaid Compound</h3>
                            <h1><?php echo $rowU['unpaidComp']; ?></h1>
                        </div>
                        <div class="progress">
                            <!--<svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>-->
                            <div class="number">
                                <span class="material-icons-sharp">taxi_alert</span>
                                <!--<p>39%</p>-->
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>

                <div class="Registered">
                    
                    <div class="middle">
                        <div class="left">
                            <h3>Registered Sticker</h3>
                            <h1><?php echo $rowT['count']; ?></h1>
                        </div>
                        <div class="progress">
                            <!--<svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>-->
                            <div class="number">
                                <span class="material-icons-sharp">how_to_reg</span>
                                <!--<p>60%</p>-->
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
            </div>
                <!-- ----- END OF INSIGHTS ----- -->

                <div class="history">
                    <h2>Compound History</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Generated</th>
                                <th>Type of Compound</th>
                                <th>Charges</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- while loop to display all data from compound database -->
                                <?php
                                    while($rowC = mysqli_fetch_assoc($resultCompound))
                                    {
                                ?>
                                    <!-- display data -->
                                    <td><?php echo $rowC['compoundID']; ?></td>
                                    <td><?php echo $rowC['dateGenerated']; ?></td>
                                    <td><?php echo $rowC['compoundType']; ?></td>
                                    <td><?php echo $rowC['compoundAmount']; ?></td>

                                    <!-- If the compound has been paid, turns out green and vice versa -->
                                    <?php 
                                        if($rowC['paymentStatus']=='unpaid'){ ?> 
                                            <td class="danger"><?php echo $rowC['paymentStatus'] ?></td>
                                        
                                        <?php }
                                        else if($rowC['paymentStatus']=='paid'){ ?>
                                            <td class="success"><?php echo $rowC['paymentStatus'] ?></td> 
                                        <?php
                                        }
                                    ?>

                                    <!-- If the compound has been paid, disabled the pay now button. -->
                                    <?php 
                                        if($rowC['paymentStatus']=='unpaid'){?> 
                                            <td><a href="payment.php">
                                            <button type="button" id="payment">Pay Now</button></a>
                                            </td>
                                        
                                        <?php }
                                        else if($rowC['paymentStatus']=='paid'){ ?>
                                                <td><a href="payment.php" disabled>
                                                <button type="button" id="payment" disabled>Pay Now</button></a>
                                                </td>
                                        <?php
                                        }
                                    ?>
                                </tr>
                                <?php
                                    }

                                ?>
                            
                        </tbody>
                    </table>
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
                        <small class="text-muted"><?php echo $row['role']?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="./images/profile.jpg" alt="profile">
                        <?php 
                            echo '<img src="data:image/"/>';
                        ?>
                        <img src="img/<?php echo $row['image']; ?>" alt="profile">
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