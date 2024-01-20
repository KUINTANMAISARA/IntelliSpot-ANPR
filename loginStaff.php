<!DOCTYPE html>
<html lang="en">
<?php
    include("connection.php");
?>

<?php
    if(isset($_POST['submit'])){

        $policeID = $_POST['staffID']; //Get the police ID from form
        $password = $_POST['staffPass']; //Get police password from form

        //query
        $sql = "SELECT * FROM police WHERE policeID = '$policeID' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
       
        if($count==1){
            header("Location:staff.php");
            $_SESSION['staffID'] = $policeID; //set the value of staffID into overall session
            
        }
        else{
            echo '<script>
                window.location.href = "loginStaff.php";
                alert("Login failed. Invalid username or password !")
            </script>';
        }
    }

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <div class="home">
        <div class="loginform">
            <form name="form" action="loginStaff.php" onsubmit="return isvalid()" method="POST">
                <h2>Login</h2>
                <div class="input_box">
                    <input type="text" name="staffID" id="staffID" placeholder="Police ID"/>
                    <span class="material-icons-sharp">person</span>
                </div>

                <div class="input_box">
                    <input type="password" name="staffPass" id="staffPass" placeholder="Password"/>
                    <span class="material-icons-sharp">lock</span>
                </div>

                <div class="option_field">
                    <span class="checkbox">
                        <input type="checkbox" id="check">
                        <label for="check">Remember me</label>
                    </span>
                    <a href="index.php" class="login-staff">Login Student</a>
                </div>

                <input type="submit" id="btn" value="Login" name="submit" class="button"></button>
            </form>
        </div>
    </div>
    <script>
            function isvalid(){
                var staffID = document.form.staffID.value;
                var staffPass = document.form.staffPass.value;
                if(staffID.length=="" && staffPass.length==""){
                    alert("Staff ID and Password is empty !");
                    return false
                }
                else{
                    if(staffID.length==""){
                    alert("Staff ID is empty!");
                    return false
                    }
                    if(staffPass.length==""){
                    alert("Password is empty!");
                    return false
                    }
                }
            }
    </script>
</body>
</html>