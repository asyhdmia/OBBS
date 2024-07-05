<?php
// Database connection details
$servername = "localhost";
$dbUsername = "root"; // Update with your MySQL username
$dbPassword = ""; // Update with your MySQL password if applicable
$database = "bloodbank";

// Create connection
$connection = new mysqli($servername, $dbUsername, $dbPassword, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$errorMessage = "";
$successMessage = "";
$inputUsername = ""; // Variable to hold the input username

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUsername = $_POST["username"];
    $password = $_POST["password"];
    $rememberMe = isset($_POST["rememberMe"]) ? 1 : 0;

    // Sanitize and validate user inputs
    $inputUsername = trim($inputUsername); // Remove extra spaces
    $password = trim($password); // Remove extra spaces

    if (empty($inputUsername) || empty($password)) {
        $errorMessage = "Please enter both username and password.";
    } else {
        // Check if the user exists in the donor_signup table
        $stmt = $connection->prepare("SELECT * FROM donor_signup WHERE username = ?");
        $stmt->bind_param("s", $inputUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password from donor_signup table
            if (password_verify($password, $user['password'])) {
                // Login successful for donor
                $successMessage = "Login successful!";
                // Update login details in the donor_signup table
                $stmt_update = $connection->prepare("UPDATE donor_signup SET remember_me = ?, updated_at = NOW() WHERE username = ?");
                $stmt_update->bind_param("is", $rememberMe, $inputUsername);
                $stmt_update->execute();
                $stmt_update->close();

                // Redirect to the donor page
                header("Location: donor.php");
                exit();
            } else {
                $errorMessage = "Invalid username or password.";
            }
        } else {
            // Check if the user exists in the users_login table
            $stmt = $connection->prepare("SELECT * FROM users_login WHERE username = ?");
            $stmt->bind_param("s", $inputUsername);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify the password from users_login table
                if (password_verify($password, $user['password'])) {
                    // Login successful for admin
                    $successMessage = "Login successful!";
                    // Update login details in the users_login table
                    $stmt_update = $connection->prepare("UPDATE users_login SET remember_me = ?, updated_at = NOW() WHERE username = ?");
                    $stmt_update->bind_param("is", $rememberMe, $inputUsername);
                    $stmt_update->execute();
                    $stmt_update->close();

                    // Redirect to the admin page
                    header("Location: admin.php");
                    exit();
                } else {
                    $errorMessage = "Invalid username or password.";
                }
            } else {
                // User not found in both tables, login failed
                $errorMessage = "Invalid username or password.";
            }
        }
        $stmt->close();
    }

    // Close the database connection
    $connection->close();
}
?>
