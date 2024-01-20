<?php
    include('connection.php');
    error_reporting(0);
?>

<?php
    if(isset($_POST['submit'])){

        $studID = $_POST['studID'];
        $studName = $_POST['studName'];
        $icNumber = $_POST['icNumber'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $faculty = $_POST['faculty'];
        $programme = $_POST['programme'];
        $semester = $_POST['semester'];
        $role = $_POST['role'];
        $studPass = $_POST['studPass'];
        $hashedPassword = password_hash($studPass, PASSWORD_DEFAULT);


        //Insert query
        $sqlInsert = "INSERT INTO student (studentID, studentName, icNumber, phoneNumber, email, faculty, programme, semester, role, password) 
        VALUES ('$studID', '$studName', '$icNumber','$phoneNumber', '$email', '$faculty','$programme', '$semester', '$role','$hashedPassword')";

        $res=mysqli_query($conn,$sqlInsert);
        mysqli_close($conn);
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT STUDENT</title>
</head>
<body>
<form name="form" action="" method="POST">
                <h2>REGISTER</h2>
                    <input type="text" name="studID" placeholder="Student ID"/><br>
                    <input type="text" name="studName"  placeholder="Student Name"/><br>
                    <input type="text" name="icNumber"  placeholder="Student IC"/><br>
                    <input type="text" name="phoneNumber"  placeholder="Student Phone Number"/><br>
                    <input type="email" name="email"  placeholder="Student Email"/><br>
                    <input type="text" name="faculty"  placeholder="Student faculty"/><br>
                    <input type="text" name="programme"  placeholder="Student Programme"/><br>
                    <input type="text" name="semester"  placeholder="Student semester"/><br>
                    <input type="text" name="role"  placeholder="Student role"/><br>
                    <input type="password" name="studPass" id="studPass" placeholder="Password"/><br>
                    
                    <input type="submit" value="submit" name="submit"><br>
            </form>
</body>
</html>