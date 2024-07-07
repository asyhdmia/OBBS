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
        // Check if the user exists in the donor_signup table (for donors)
        $stmt = $connection->prepare("SELECT password FROM donor_signup WHERE username = ?");
        $stmt->bind_param("s", $inputUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password from donor_signup table
            if ($password == $user['password']) { // For demonstration, using plain text comparison
                // Login successful for donor
                $successMessage = "Login successful!";
                // Update login details in the donor_signup table
                $stmt = $connection->prepare("UPDATE donor_signup SET remember_me = ?, updated_at = NOW() WHERE username = ?");
                $stmt->bind_param("is", $rememberMe, $inputUsername);
                $stmt->execute();

                // Redirect to the donor page
                header("Location: http://localhost/dashboard/OBBS/Project_obbs/sidebar-05/index.html"); // Redirect to the donor homepage
                exit();
            } else {
                $errorMessage = "Invalid username or password.";
            }
        } else {
            // Check if the user exists in the users_login table (for admins)
            $stmt = $connection->prepare("SELECT password FROM users_login WHERE username = ?");
            $stmt->bind_param("s", $inputUsername);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify the password from users_login table
                if ($password == $user['password']) { // For demonstration, using plain text comparison
                    // Login successful for admin
                    $successMessage = "Login successful!";
                    // Update login details in the users_login table
                    $stmt = $connection->prepare("UPDATE users_login SET remember_me = ?, updated_at = NOW() WHERE username = ?");
                    $stmt->bind_param("is", $rememberMe, $inputUsername);
                    $stmt->execute();

                    // Redirect to the admin page
                    header("Location: http://localhost/dashboard/OBBS/administratorpage/donor-list.php"); // Replace with your admin page URL
                    exit();
                } else {
                    $errorMessage = "Invalid username or password.";
                }
            } else {
                // User not found in either table
                $errorMessage = "Invalid username or password.";
            }
        }
        $stmt->close();
    }

    // Close the database connection
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User Login Form</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-danger">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Into Your Account</h1>
                                    </div>
                                    <form action="process_login.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="inputUsername" aria-describedby="username" placeholder="Username" value="<?php echo htmlspecialchars($inputUsername); ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="inputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="rememberMe" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            if (!empty($errorMessage)) {
                                                echo "<div class='alert alert-danger'>$errorMessage</div>";
                                            } elseif (!empty($successMessage)) {
                                                echo "<div class='alert alert-success'>$successMessage</div>";
                                            }
                                            ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="process_signup.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
