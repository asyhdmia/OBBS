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

// Fetch available dates
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

// Book an appointment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'book-appointment') {
    $donor_id = $_POST['donor_id'];
    $date = $_POST['date'];

    $sql = "INSERT INTO booked_appointments (donor_id, date) VALUES ('$donor_id', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => "Appointment booked for $date"]);
    } else {
        echo json_encode(['error' => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

// Fetch booked appointments for a specific donor
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'view-appointments') {
    $donor_id = $_GET['donor_id'];

    $sql = "SELECT date FROM booked_appointments WHERE donor_id = '$donor_id'";
    $result = $conn->query($sql);

    $appointments = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $appointments[] = $row['date'];
        }
    }

    echo json_encode(['appointments' => $appointments]);
}

$conn->close();
?>
