<?php include("connection.php"); ?>

<!-- GET STUDENT ID -->
<?php

    //$_SESSION['studID'] = $studID;
    $studID = $_SESSION['studID'];
    //var_dump($studID);

    $sql = "SELECT * FROM student WHERE studentID = '$studID'";
    $sqlSticker = "SELECT * FROM sticker WHERE studentID = '$studID'";

    $result = mysqli_query($conn, $sql);
    $resultSticker = mysqli_query($conn, $sqlSticker);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$rowSticker = mysqli_fetch_array($resultSticker, MYSQLI_ASSOC);
    //$count = mysqli_num_rows($rowSticker); 
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
    <link rel="stylesheet" href="./profile.css">

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
                <a href="profile.php" class="active">
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
            <h1>Profile</h1>
            
                <div class="about">
                            <table>
                                
                                    <tbody>
                                        <tr>
                                            <td>Full Name :</td>
                                                <td><?php echo $row['studentName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Matrix Number :</td>
                                                <td><?php echo $row['studentID'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Identification Number :</td>

                                                <td><?php echo $row['icNumber'] ?></td>

                                        </tr>
                                        <tr>
                                            <td>Phone Number :</td>

                                                <td><?php echo $row['phoneNumber'] ?></td>

                                        </tr>
                                        <tr>
                                            <td>Programme :</td>

                                                <td><?php echo $row['programme'] ?></td>

                                        </tr>
                                        <tr>
                                            <td>Faculty :</td>

                                                <td><?php echo $row['faculty'] ?></td>

                                        </tr>
                                        <tr>
                                            <td>Semester :</td>

                                                <td><?php echo $row['semester'] ?></td>

                                        </tr>
                                        <tr>
                                            <td>Email :</td>

                                                <td><?php echo $row['email'] ?></td>

                                        </tr>
                                        <tr>
                                            <td>Sticker ID :</td>

                                                <td>
                                                    <!-- This code is to check if student has not register sticker -->
                                                    <?php 
                                                        if ($resultSticker) {
                                                            $rowSticker = mysqli_fetch_array($resultSticker, MYSQLI_ASSOC);

                                                            if ($rowSticker !== null) {
                                                                // Data was fetched successfully, and $rowSticker is not null
                                                                echo $rowSticker['stickerID'];
                                                            } else {
                                                                // No data found
                                                                echo 'Not Applicable';
                                                            }
                                                        } else {
                                                            // Query failed
                                                            echo 'Null';
                                                        }
                                                    ?>
                                                </td>

                                        </tr>
                                        <tr>
                                            <td>Car Plate Number :</td>

                                                <td>
                                                    <!-- This code is to check if student has not register sticker -->
                                                    <?php 
                                                        if ($resultSticker) {

                                                            if ($rowSticker !== null) {
                                                                // Data was fetched successfully, and $rowSticker is not null
                                                                echo $rowSticker['carPlateNumber'];
                                                            } else {
                                                                // No data found
                                                                echo 'Not Applicable';
                                                            }
                                                        } else {
                                                            // Query failed
                                                            echo 'Null';
                                                        }
                                                    ?>
                                                </td>

                                        </tr>
                                    </tbody>
                                <br>
                            </table>
                            <br>
                            <button><a href="profile-update.php">Update Profile</a></button>
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
</body>
</html>