<!DOCTYPE html>
<html lang="en">
<?php 
    include("connection.php");
?>

<?php
    if(isset($_POST['submit'])){

        $studID = $_POST['studID']; //Get the student ID from form
        $password = $_POST['studPass']; //Get student password from form
        //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
        //query
        $sql = "SELECT * FROM student WHERE studentID = '$studID' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
       
        if($count==1){
            header("Location:student.php");
            $_SESSION['studID'] = $studID; //set the value of studentid into overall session
            
        }
        else{
            echo '<script>
                window.location.href = "index.php";
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

    <!--<link rel="stylesheet" href="./style.css">-->
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <div class="home">
        <div class="loginform">
            <form name="form" action="index.php" onsubmit="return isvalid()" method="POST">
                <h2>Login</h2>
                <div class="input_box">
                    <input type="text" name="studID" id="studID" placeholder="Student ID"/>
                    <span class="material-icons-sharp">person</span>
                </div>

                <div class="input_box">
                    <input type="password" name="studPass" id="studPass" placeholder="Password"/>
                    <span class="material-icons-sharp">lock</span>
                </div>

                <div class="option_field">
                    <span class="checkbox">
                        <input type="checkbox" id="check">
                        <label for="check">Remember me</label>
                    </span>
                    <a href="loginStaff.php" class="login-staff">Login Staff</a>
                </div>

                <input type="submit" id="btn" value="Login" name="submit" class="button"></button>
            </form>
        </div>
    </div>
    <script>
            function isvalid(){
                var studID = document.form.studID.value;
                var studPass = document.form.studPass.value;
                if(studID.length=="" && studPass.length==""){
                    alert("Student ID and Password is empty !");
                    return false
                }
                else{
                    if(studID.length==""){
                    alert("Student ID is empty!");
                    return false
                    }
                    if(studPass.length==""){
                    alert("Password is empty!");
                    return false
                    }
                }
            }
    </script>
</body>
</html>