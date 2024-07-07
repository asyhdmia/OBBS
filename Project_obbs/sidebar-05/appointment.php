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
        $id = $_GET['id'];

        $sql = "SELECT date FROM appointments WHERE id = '$id'";
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
        $id = $_POST['id'];
        $date = $_POST['date'];

        $sql = "INSERT INTO appointments (id, date) VALUES ('$id', '$date')";
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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
        }
        .wrapper {
            display: flex;
            align-items: stretch;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #7386D5;
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar .custom-menu {
            display: none;
        }
        #sidebar .p-4 {
            padding: 20px;
        }
        #sidebar .p-4 .logo {
            display: block;
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }
        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }
        #sidebar ul li {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }
        #sidebar ul li a {
            color: #fff;
        }
        #sidebar ul li a:hover {
            background: #7386D5;
        }
        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #fff;
            background: #6d7fcc;
        }
        .container {
            margin-left: 250px;
            padding: 20px;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }
        #reminder {
            margin-top: 20px;
            color: #ff0000;
        }
    </style>
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4">
            <h1><a href="index.html" class="logo">Blood Bank <span>Online System</span></a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="index.html"><span class="fa fa-home mr-3"></span> Home</a>
                </li>
                <li>
                    <a href="registration.php"><span class="fa fa-pencil-square-o mr-3"></span> Register</a>
                </li>
                <li>
                    <a href="app.php"><span class="fa fa-calendar-o mr-3"></span> Appointment</a>
                </li>
                <li>
                    <a href="viewProfile.php"><span class="fa fa-user mr-3"></span> Profile</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-book mr-3"></span> Manual</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="col-sm-8"><h1>Blood Donation Appointment</h1></div>
        <h5>Please choose from available dates only</h5>
        <label for="appointment-date">Select Appointment Date:</label>
        <select id="appointment-date"></select>
        <button class="btn btn-primary" onclick="bookAppointment()">Book Appointment</button>
        <div id="reminder"></div>
        <div id="appointments"></div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', async (event) => {
    const selectElement = document.getElementById('appointment-date');

    try {
        const response = await fetch('http://localhost/OBBS/Project_obbs/app.php?action=available-dates');
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const data = await response.json();
        data.dates.forEach(date => {
            const option = document.createElement('option');
            option.value = date;
            option.textContent = date;
            selectElement.appendChild(option);
        });

        const reminder = localStorage.getItem('appointmentDate');
        if (reminder) {
            document.getElementById('reminder').textContent = You have an appointment booked on ${reminder};
        }
    } catch (error) {
        console.error('Error fetching available dates:', error);
    }
});

async function bookAppointment() {
    const donorId = prompt("Enter your donor ID:");
    const selectedDate = document.getElementById('appointment-date').value;

    try {
        const response = await fetch('http://localhost/OBBS/Project_obbs/app.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: action=book-appointment&donor_id=${donorId}&date=${selectedDate}
        });
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const data = await response.json();
        if (data.message) {
            alert(data.message);
            localStorage.setItem('appointmentDate', selectedDate);
            document.getElementById('reminder').textContent = You have an appointment booked on ${selectedDate};
        } else if (data.error) {
            alert(data.error);
        }
    } catch (error) {
        console.error('Error booking appointment:', error);
    }
}

async function viewAppointments() {
    const donorId = prompt("Enter your donor ID:");
    const appointmentsDiv = document.getElementById('appointments');
    appointmentsDiv.innerHTML = '';

    try {
        const response = await fetch(http://localhost/OBBS/Project_obbs/app.php?action=view-appointments&donor_id=${donorId});
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
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