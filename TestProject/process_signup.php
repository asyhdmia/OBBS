<?php

// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "testobbs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_signup = uniqid(); // Generate a unique ID
  $username = $_POST["username"];
  $email = $_POST["inputEmail"];
  $password = $_POST["inputPassword"];

  // Prepare and execute SQL statement
  $sql = "INSERT INTO donor_signup (id_signup, username, email, password) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $id_signup, $username, $email, $password);
  $stmt->execute();

  // Check for errors
  if ($stmt->error) {
    echo "Error: " . $stmt->error;
  } else {
    echo "New record created successfully";
  }

  $stmt->close();
}

$conn->close();

?>