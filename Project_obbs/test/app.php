<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodbank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'action' key exists in the GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'available-dates') {
    $sql = "SELECT date FROM appointments";
    $result = $conn->query($sql);

    $dates = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $dates[] = $row['date'];
        }
    }

    echo json_encode(['dates' => $dates]);
}

// Check if 'action' key exists in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'book-appointment') {
    $date = $_POST['date'];
    // Add your logic to handle booking here. This example assumes you only log the date.
    echo json_encode(['message' => "Appointment booked for $date"]);
}

$conn->close();
?>
