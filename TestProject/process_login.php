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
  $username = $_POST["inputUsername"];
  $password = $_POST["inputPassword"];
  $role = $_POST["data[User][role]"]; // Get the role from the radio button

  // Prepare and execute SQL statement
  $sql = "SELECT * FROM users_login WHERE username = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if user exists
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row["role"] == $role) { // Check if role matches
      session_start();
      $_SESSION["username"] = $username;
      $_SESSION["role"] = $role;
      // Redirect to the appropriate page based on the role
      if ($role == 'admin') {
        header("Location: admin_dashboard.php");
        exit;
      } else {
        header("Location: donor_dashboard.php");
        exit;
      }
    } else {
      echo "Invalid role";
    }
  } else {
    echo "Invalid username or password";
  }

  $stmt->close();
}

$conn->close();

?>