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

<?php
    $policeID = $_SESSION['staffID']; 

    $sqlC = "SELECT * FROM compound";
    //$sqlCompund = "SELECT student.studentID,student.studentName FROM `student` INNER JOIN `compound` ON student.studentID = compound.studentID";
    $resultC = mysqli_query($conn, $sqlC,$sqlCo);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
     <!-- MATERIAL CDN -->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
     

    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./styleStaff.css">

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
                <a href="staff.php">
                    <span class="material-icons-sharp"> grid_view </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" class="active">
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
            <br>
            <br>
            <br>
            <h1>Compound List</h1>
            
                <!-- ----- END OF INSIGHTS ----- -->
                <div class="history">
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Compound ID</th>
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
                                    while($rowC = mysqli_fetch_assoc($resultC))
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
    <script src="./orders.js"></script>
    <script src="./index.js"></script>
</body>
</html>