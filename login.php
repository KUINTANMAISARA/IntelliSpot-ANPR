<?php
    session_start();
    include("connection.php");
    if(isset($_POST['submit'])){
        $studentid = $_POST['studID'];
        $password = $_POST['studPass'];
        

        $sql = "select * from student where studentId = '$studentid' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count==1){
            header("Location:student.php");
        }
        else{
            echo '<script>
                window.location.href = "index.php";
                alert("Login failed. Invalid username or password !")
            </script>';
        }

    }

    if(isset($_POST['submit'])){
        $staffid = $_POST['staffID'];
        $passwordStaff = $_POST['staffPass'];

        $sql = "select * from police where policeId = '$staffid' and password = '$passwordStaff'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count==1){
            header("Location:staff.php");
        }
        else{
            echo '<script>
                window.location.href = "index.php";
                alert("Login failed. Invalid username or password !")
            </script>';
        }

    }

?>