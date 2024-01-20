<?php
    include("connection.php");
?>

<?php
    //$_SESSION['studID'] = $studID;
    $studID = $_SESSION['studID'];
    //var_dump($studID); //to check current session user

    //This section is to display current details of student in form 
    $sql = "SELECT * FROM student WHERE studentID = '$studID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if(isset($_POST['submit'])) //This section only will be executed if student click on 'submit' button
    {
        //Update query
        $update = "UPDATE student set studentName='". $_POST['studentName'] ."',
        icNumber='". $_POST['icNumber'] ."',
        phoneNumber='". $_POST['phoneNumber'] ."',
        semester='". $_POST['semester'] ."',
        programme='". $_POST['programme'] ."',
        faculty='". $_POST['faculty'] ."',
        email='". $_POST['email'] ."' WHERE studentID = '$studID'";

        mysqli_query($conn,$update);
        $message = "<p style='color:green;'>Record Updated Successfully !</p><br>"; //pop up message indicate the process is successful

    }

    $resultUpdate = mysqli_query($conn,"SELECT * FROM student WHERE studentID = '$studID'");
    $rowUpdate = mysqli_fetch_array($resultUpdate);

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
                <div class="container">
                <div class="containerForm">
                    <!-- Display message if record successful updated-->
                    <?php if(isset($message)) { echo $message;} ?>  
                    <div class="title">Update</div>
                                        <form name="form" method="POST" action="">
                                            <div class="registerDetails">
                                                <div class="input-box">
                                                    <br>
                                                    <span class="details">Full Name</span>
                                                    <input type="text" name="studentName" value="<?php echo $row['studentName'] ?>" />
                                                </div>
                                                <div class="input-box">
                                                <br>
                                                    <span class="details">Identification Number</span>
                                                    <input type="text" name="icNumber" value="<?php echo $row['icNumber'] ?>" />
                                                </div>
                                                <div class="input-box">
                                                <br>
                                                    <span class="details">Phone Number</span>
                                                    <input type="text" name="phoneNumber" value="<?php echo $row['phoneNumber'] ?>" />
                                                </div>
                                                <div class="input-box">
                                                <br>
                                                    <span class="details">Semester</span>
                                                    <input type="text" name="semester" value="<?php echo $row['semester'] ?>" />
                                                </div>
                                                <div class="input-box">
                                                <br>
                                                    <span class="details">Programme</span>
                                                    <input type="text" name="programme" value="<?php echo $row['programme'] ?>" />
                                                </div>
                                                <div class="input-box">
                                                <br>
                                                    <span class="details">Faculty</span>
                                                    <input type="text" name="faculty" value="<?php echo $row['faculty'] ?>" />
                                                </div>
                                                <div class="input-box">
                                                <br>
                                                    <span class="details">Email</span>
                                                    <input type="text" name="email" value="<?php echo $row['email'] ?>" />
                                                </div>
                                            </div>
                                            <div class="button">
                                                <input type="submit" value="submit" name="submit">
                                            </div>
                                        </form>
                    
                </div>
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
                                <td><?php echo $row['studentName'] ?></td>
                        
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