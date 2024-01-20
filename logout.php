<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>
    <center> 
    <h1>You have successfully log out </h1>
    <a href="index.php">Click here to log in</a>
    </center>
</body>
</html>

<?php

    session_start();
    if(session_destroy()){
        header("Location: index.php");
    }

?>