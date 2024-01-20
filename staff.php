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

<?php 
    //Process to insert compound details into database table name 'compound'
   
    if(isset($_POST['submit'])){

        $paymentPaid = "paid"; 
        $paymentUnpaid = "unpaid";

        $studID = $_POST['studID'];
        $compoundType = $_POST['CompoundType'];
        $amount = $_POST['Amount'];
        

        //insert query 
        $sqlInsert = "INSERT INTO compound (compoundType, compoundAmount, paymentStatus, studentID, policeID) VALUES ('$compoundType', '$amount', '$paymentUnpaid', '$studID', '$policeID')";
        //var_dump($sqlInsert);

        $res=mysqli_query($conn,$sqlInsert);
        if ($res==1) {echo 
        '<script>
            
        alert("Compound Successful !");
        window.location.href = "staff.php";
        
        </script>';}
        else {
            echo '<script>
            
            alert("Insert failed !")
            
            </script>';}
        mysqli_close($conn);
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

                <!-- ----- CAR PLATE SCANNER & CAR DETAILS  ----- -->
                <BR></BR>
                <div class="plateScanner">
                    <br>
                    <div class="scannerContainer">
                        <h1><center>CAR PLATE SCANNER</center></h1>
                        <center><span class="material-icons-sharp">cloud_upload</span></center>
                            <form  id="uploadForm">
                                <center>
                                <input type="file" id="uploadPic" name="uploadPic" class="file" >
                                <br>
                                <br>
                                <input style="cursor:pointer" type="submit" id="btn" value="Scan Image">
                                </center>
                            </form>
                        <br>
                    </div>
                    
                    <div class="scannerDetails">
                        <h1><center>Car Owner's Details</center></h1>
                        
                        <form name="displayCarDetails" action="staff.php" method="POST">
                            <div class="input_box">
                                <input type="text" name="studID" id="studID" placeholder="Student ID"/>
                                <span class="material-icons-sharp">person</span>
                            </div>
                            <div class="input_box">
                                <input type="text" name="studName" id="studName" placeholder="Student Name"/>
                                <span class="material-icons-sharp">person</span>
                            </div>
                            <div class="input_box">
                                <input type="text" name="CompoundType" id="CompoundType" placeholder="Compound Type :" required/>
                                <span class="material-icons-sharp">format_list_bulleted</span>
                            </div>
                            <div class="input_box">
                                <input type="text" name="Amount" id="Amount" placeholder="Amount RM :" required/>
                                <span class="material-icons-sharp">paid</span>
                            </div>
                            <center><input style=cursor:pointer  type="submit" id="btn" value=" Compound " name="submit" class="buttonCompound"></button></center>
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
    <script src="./orders.js"></script>
    <script src="./index.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#uploadForm').submit(function(e) {
                e.preventDefault(); // trigger 1 event in JS

                var formData = new FormData(); // create a new object name formData
                formData.append('file', $('#uploadPic')[0].files[0]);
                console.log('berjaya'); 
                console.log(formData);
        
                $.ajax({ // start to call api
                    type: 'POST',
                    url: 'http://127.0.0.1:5000/upload', // python url 
                    data: formData,
                    contentType: false,
                    processData: false,
                   
                    success: function(response) { // api successfully response pyhton
                        console.log(response["image_path"]); // parse the car plate string
                        console.log(formData);
                        $.ajax({
                            type: 'POST',
                            url: 'ajaxstudentplate.php',
                            data: { data: JSON.stringify(response) },
                            success: function(data) { // if the data is successfully found in the database
                             

                                console.log(JSON.parse(data));  // Use JSON.parse to decode the JSON string

                                var parsedData = JSON.parse(data);

                                if(!parsedData)
                                {
                                    location.replace("errorScan.php");
                                }

                                var studID = $("#studID");  // Using jQuery to select the element by ID
                                studID.val(parsedData.studentID); // get the value of student ID

                                $('#studName').val(parsedData.studentName);
                                $('#compoundType').val(parsedData.carName);
                                $('#amountRM').val(parsedData.carPlateNumber);
                            },
                            error: function(error) {
                                console.log(error);
                                //console.log('gagal');
                               

                            }
                        });
                    },
                    error: function(error) {
                        //location.replace("errorScan.php");
                        console.log(error);
                        console.log(formData);
                    }
                });
            });
        });
    </script>
</body>
</html>