<?php
    include("connection.php");
    error_reporting(0);
?>

<?php
    $policeID = $_SESSION['staffID']; 

    $sql = "SELECT * FROM police WHERE policeID = '$policeID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<!-- SUM all compound in RM -->
<?php
    $policeID = $_SESSION['staffID']; 

    $sqlC = "SELECT SUM(compoundAmount) as sum FROM compound";
    $resultC = mysqli_query($conn, $sqlC);
    
    while($rowC = mysqli_fetch_assoc($resultC)){
        $sum = $rowC['sum'];
    }
?>

<!-- COUNT unpaid compound -->
<?php
    $policeID = $_SESSION['staffID'];
    $unpaid = "unpaid";

    $sqlU = "SELECT COUNT(compoundID) as unpaidComp FROM compound WHERE paymentStatus = '$unpaid'";
    $resultU = mysqli_query($conn, $sqlU);
    
    $rowU = mysqli_fetch_array($resultU, MYSQLI_ASSOC);
?>

<!-- COUNT sticker registered -->
<?php
    $policeID = $_SESSION['staffID']; 

    $sqlT = "SELECT COUNT(stickerID) as total FROM sticker";
    $resultT = mysqli_query($conn, $sqlT);
    
    while($rowT = mysqli_fetch_assoc($resultT)){
        $total = $rowT['total'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
     <!-- MATERIAL CDN -->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
     

    <link rel="stylesheet" href="./errorScan.css">
    

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
                <a href="staffListCompound.php">
                    <span class="material-icons-sharp"> fact_check </span>
                    <h3>Compound List</h3>
                </a>
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
                            <h1>RM<?php echo $sum ?>.00</h1>
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
                            <h3>Registered</h3>
                            <h1><?php echo $total ?></h1>
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

                <!-- ----- error message  ----- -->
            <div class="container">
                <div class="containerForm">
                    <div class="title">Unknown Car Plate Number !</div>
                    <form action="staff.php">
                        <div class="registerDetails">
                            <div class="input-box">
                                <span class="material-icons-sharp">cancel</span>
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" value="Back" name="submit">
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
                                <td><?php echo $row['policeName']; ?></td>
                            </b>
                        </p>
                        <small class="text-muted"><?php echo $row['role']?></small>
                        <br> 
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
    
</body>
</html>