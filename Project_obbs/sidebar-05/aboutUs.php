<?php
// Database connection details (adjust according to your setup)
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloodbank";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch dynamic content if needed
$sql = "SELECT * FROM about WHERE id = 1";
$result = $conn->query($sql);

$aboutContent = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $aboutContent = $row["content"];
} else {
    $aboutContent = "Default about content";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Online Blood Bank System</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">About the Online Blood Bank System</h1>
        <p>
            The <strong>Online Blood Bank System</strong> is designed to streamline the process of blood donation and management. Our platform offers a comprehensive solution for managing donor information, blood inventory, and donation records.
        </p>
        <p>
            The system aims to connect blood donors with recipients in a more efficient manner, ensuring timely and accurate availability of blood. This initiative plays a crucial role in saving lives by facilitating easy access to blood for medical emergencies.
        </p>
        <h2>Key Features</h2>
        <ul>
            <li>Donor registration and profile management</li>
            <li>Real-time blood inventory tracking</li>
            <li>Appointment scheduling for blood donations</li>
            <li>Notification system for donor eligibility and blood requirements</li>
            <li>Secure and user-friendly interface</li>
        </ul>
        <h2>System Architecture</h2>
        <p>
            The system architecture is designed to ensure scalability, security, and reliability. The backend is built on a robust database system that handles all donor and blood data, while the frontend is designed to provide a seamless user experience.
        </p>
        <h2>Benefits</h2>
        <ul>
            <li>Ensures a steady supply of blood for hospitals and medical facilities</li>
            <li>Facilitates efficient blood management and reduces wastage</li>
            <li>Provides a platform for potential donors to easily register and donate</li>
            <li>Improves response times in medical emergencies</li>
        </ul>
        <h2>Stakeholders</h2>
        <p>
            The primary stakeholders of the system include:
            <ul>
                <li>Blood donors</li>
                <li>Hospitals and medical facilities</li>
                <li>Patients in need of blood</li>
                <li>Healthcare professionals</li>
            </ul>
        </p>
        <h2>Vision</h2>
        <p>
            Our vision is to create a reliable and accessible blood donation network that contributes to saving lives and improving healthcare outcomes.
        </p>
        <h2>Contact Us</h2>
        <p>
            For more information or to get involved, please contact us at <a href="mailto:info@bloodbank.com">info@bloodbank.com</a> or call us at +1-800-123-4567.
        </p>
        <hr>
        <h2>Dynamic Content</h2>
        <p><?php echo $aboutContent; ?></p>
    </div>
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
