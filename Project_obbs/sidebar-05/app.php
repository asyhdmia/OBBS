<?php
header('Content-Type: application/json'); // Ensure response is JSON
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodbank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Handle GET request to fetch available dates
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'available-dates') {
    $sql = "SELECT date FROM appointments";
    $result = $conn->query($sql);

    $dates = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dates[] = $row['date'];
        }
    } else {
        echo json_encode(["dates" => []]);
        $conn->close();
        exit();
    }
    echo json_encode(["dates" => $dates]);
}

// Handle POST request to book an appointment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'book-appointment') {
    $date = $_POST['date'];
    // Add your logic to handle booking here
    // Example: Log the date (for now, just send a message back)
    echo json_encode(["message" => "Appointment booked for $date"]);
}

$conn->close();
?>
