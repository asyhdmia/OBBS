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
    $role = isset($_POST["role"]) ? $_POST["role"] : 'donor';
    $rememberMe = isset($_POST["rememberMe"]) ? 1 : 0;

    // Sanitize and validate user inputs (using prepared statements)
    $username = trim($username); // Remove extra spaces
    $password = trim($password); // Remove extra spaces

    if (empty($username) || empty($password)) {
        $errorMessage = "Please enter both username and password.";
    } else {
        // Prepare the SQL statement (using prepared statements to prevent SQL injection)
        $stmt = $connection->prepare("SELECT * FROM users_login WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, login successful
            $successMessage = "Login successful!";
            // Redirect to the appropriate page based on the user's role
            // Example:
            if ($role === 'admin') {
                header("Location: admin.php"); 
            } else {
                header("Location: donor.php"); 
            }
            exit(); // Stop further execution after redirect
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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Into Your Account</h1>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="obbs">
                                            <form action="login.php" method="post">
                                                <div class="form-group text-center">
                                                <div class="form-group text-center"></div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="data[User][role]" id="donorCheckbox" value="<?php echo isset($role) ? $role : ''; ?>" required="required" checked>
                                                        <label class="form-check-label">
                                                            Donor
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="data[User][role]" id="adminCheckbox" value="<?php echo isset($role) ? $role : ''; ?>" required="required">
                                                        <label class="form-check-label">
                                                            Admin
                                                        </label>
                                                    </div>
                                                </div>   
                                                <hr>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                id="inputUsername" aria-describedby="username"
                                                placeholder="Username" value="<?php echo isset($username) ? $username : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="inputPassword" placeholder="Password" value="<?php echo isset($password) ? $password : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" <?php if(isset($rememberMe) && $rememberMe) echo "checked"; ?>>
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                        <hr>
                                        <div class="signup-link">
                                            <p>Don't have an account yet? <a href="donorsignup.html">Sign Up</a></p>
                                        </div>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="donorsignup.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>