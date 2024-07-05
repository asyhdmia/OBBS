<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Update with your MySQL username
$password = ""; // Update with your MySQL password if applicable
$database = "bloodbank";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rememberMe = isset($_POST["rememberMe"]) ? 1 : 0;

    // Sanitize and validate user inputs
    $username = trim($username); // Remove extra spaces
    $password = trim($password); // Remove extra spaces

    if (empty($username) || empty($password)) {
        $errorMessage = "Please enter both username and password.";
    } else {
        // Prepare the SQL statement to select the user
        $stmt = $connection->prepare("SELECT * FROM users_login WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Login successful
                $successMessage = "Login successful!";
                // Insert login details into the database
                $stmt = $connection->prepare("UPDATE users_login SET remember_me = ?, updated_at = NOW() WHERE username = ?");
                $stmt->bind_param("is", $rememberMe, $username);
                $stmt->execute();

                // Redirect to the appropriate page based on the user's role
                if ($user['role'] === 'admin') {
                    header("Location: admin.php"); 
                } else {
                    header("Location: donor.php"); 
                }
                exit(); // Stop further execution after redirect
            } else {
                $errorMessage = "Invalid username or password.";
            }
        } else {
            // User not found, login failed
            $errorMessage = "Invalid username or password.";
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
                                            <input type="username" class="form-control form-control-user" name="username" id="inputUsername" aria-describedby="username" placeholder="Username" value="<?php echo isset($username) ? $username : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="inputPassword" placeholder="Password" value="<?php echo isset($password) ? $password : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="rememberMe" id="customCheck" <?php if(isset($rememberMe) && $rememberMe) echo "checked"; ?>>
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
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="process_signup.html">Create an Account!</a>
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

