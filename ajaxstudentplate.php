<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intellispot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you've received the response from the AJAX request

$response = json_decode($_POST['data'], true);

if ($response && isset($response['image_path'])) {
    $imagePath = $response['image_path'];

    // Prepare and execute SQL query
    $sql = "SELECT student.studentID,student.studentName FROM `student` INNER JOIN `sticker` ON student.studentID = sticker.studentID WHERE sticker.carPlateNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $imagePath);
    $stmt->execute();

    // Get result set
    $result = $stmt->get_result();

    // Fetch data
    $data = $result->fetch_assoc();

    // Output data (you may want to format it differently)
    echo json_encode($data);

    // Close statement and connection
    $stmt->close();
} else {
    
    echo "Invalid or missing response data.";
}

$conn->close();

?>
