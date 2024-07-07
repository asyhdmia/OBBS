<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

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

    if ($_GET['action'] === 'available-dates') {
        $sql = "SELECT date FROM available_dates"; // Adjust table name as needed
        $result = $conn->query($sql);

        $dates = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dates[] = $row['date'];
            }
        }

        echo json_encode(['dates' => $dates]);
        exit();
    }

    if ($_GET['action'] === 'view-appointments') {
        $sql = "SELECT date FROM appointments";
        $result = $conn->query($sql);

        $appointments = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $appointments[] = $row['date'];
            }
        }

        echo json_encode(['appointments' => $appointments]);
        exit();
    }

    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

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

    if ($_POST['action'] === 'book-appointment') {
        $date = $_POST['date'];

        $sql = "INSERT INTO appointments (date) VALUES ('$date')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['message' => "Appointment booked for $date"]);
        } else {
            echo json_encode(['error' => "Error: " . $sql . "<br>" . $conn->error]);
        }
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Appointment</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1 { text-align: center; }
        label, select, button { display: block; width: 100%; margin-bottom: 10px; }
        button { background: #007bff; color: #fff; border: none; padding: 10px; cursor: pointer; }
        button:hover { background: #0056b3; }
        #reminder { margin-top: 20px; color: #ff0000; text-align: center; }
        #appointments { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Blood Donation Appointment</h1>
    <h5>Please choose from available dates only</h5>
    <label for="appointment-date">Select Appointment Date:</label>
    <select id="appointment-date"></select>
    <button onclick="bookAppointment()">Book Appointment</button>
    <div id="reminder"></div>
    <div id="appointments"></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const selectElement = document.getElementById('appointment-date');

    try {
        const response = await fetch('http://localhost/OBBS/Project_obbs/app.php?action=available-dates');
        if (!response.ok) throw new Error('Network response was not ok ' + response.statusText);

        const data = await response.json();
        data.dates.forEach(date => {
            const option = document.createElement('option');
            option.value = date;
            option.textContent = date;
            selectElement.appendChild(option);
        });

        const reminder = localStorage.getItem('appointmentDate');
        if (reminder) document.getElementById('reminder').textContent = `You have an appointment booked on ${reminder}`;
    } catch (error) {
        console.error('Error fetching available dates:', error);
    }
});

async function bookAppointment() {
    const selectedDate = document.getElementById('appointment-date').value;

    try {
        const response = await fetch('http://localhost/OBBS/Project_obbs/app.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=book-appointment&date=${selectedDate}`
        });
        if (!response.ok) throw new Error('Network response was not ok ' + response.statusText);

        const data = await response.json();
        if (data.message) {
            alert(data.message);
            localStorage.setItem('appointmentDate', selectedDate);
            document.getElementById('reminder').textContent = `You have an appointment booked on ${selectedDate}`;
        } else if (data.error) {
            alert(data.error);
        }
    } catch (error) {
        console.error('Error booking appointment:', error);
    }
}

async function viewAppointments() {
    const appointmentsDiv = document.getElementById('appointments');
    appointmentsDiv.innerHTML = '';

    try {
        const response = await fetch('http://localhost/OBBS/Project_obbs/app.php?action=view-appointments');
        if (!response.ok) throw new Error('Network response was not ok ' + response.statusText);

        const data = await response.json();
        if (data.appointments.length > 0) {
            const ul = document.createElement('ul');
            data.appointments.forEach(date => {
                const li = document.createElement('li');
                li.textContent = date;
                ul.appendChild(li);
            });
            appointmentsDiv.appendChild(ul);
        } else {
            appointmentsDiv.textContent = 'No appointments found.';
        }
    } catch (error) {
        console.error('Error fetching appointments:', error);
    }
}
</script>
</body>
</html>
