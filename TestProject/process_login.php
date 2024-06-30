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
    $obbs = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $role = isset($_POST["role"]) ? $_POST["role"] : 'donor';
    $rememberMe = isset($_POST["rememberMe"]) ? 1 : 0;

    if (empty($obbs) || empty($password)) {
        $errorMessage = "Please enter both username and password.";
    } else {
        // Prepare the SQL statement (using prepared statements to prevent SQL injection)
        $stmt = $connection->prepare("SELECT * FROM users_login WHERE username = ?");
        $stmt->bind_param("s", $obbs); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // User found and password is correct, login successful
                $successMessage = "Login successful!";
                // Redirect to the appropriate page based on the user's role
                if ($role === 'admin') {
                    header("Location: admin.php"); 
                } else {
                    header("Location: donor.php"); 
                }
                exit(); // Stop further execution after redirect
            } else {
                $errorMessage = "Invalid username or password.";
            }
        } else {
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
                                    <?php if ($errorMessage): ?>
                                        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                                    <?php endif; ?>
                                    <?php if ($successMessage): ?>
                                        <div class="alert alert-success"><?php echo $successMessage; ?></div>
                                    <?php endif; ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div class="form-group text-center">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="donorCheckbox" value="donor" required="required" checked>
                                                <label class="form-check-label" for="donorCheckbox">Donor</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="adminCheckbox" value="admin" required="required">
                                                <label class="form-check-label" for="adminCheckbox">Admin</label>
                                            </div>
                                        </div>   
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="inputUsername" aria-describedby="username" placeholder="Username" value="<?php echo isset($obbs) ? htmlspecialchars($obbs) : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="inputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="rememberMe" class="custom-control-input" id="customCheck" <?php if(isset($rememberMe) && $rememberMe) echo "checked"; ?>>
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
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
