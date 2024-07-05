<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloodbank";

$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$username = "";
$email = "";
$password = "";
$confirmPassword = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $email = $_POST["inputEmail"];
    $password = $_POST["inputPassword"];
    $confirmPassword = $_POST["inputConfirmPassword"];

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are required";
    } elseif ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match";
    } else {
        // Store the plain password (Not recommended)
        $plainPassword = $password;

        $sql = "INSERT INTO donor_signup (username, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
        $stmt = $connection->prepare($sql);

        // Bind parameters to prevent SQL injection
        $stmt->bind_param("sss", $username, $email, $plainPassword);

        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "Donor successfully added";
            header("Location: process_login.php"); 
            exit;
        }
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Donor Sign Up Form</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-danger">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Sign Up An Account</h1>
                            </div>
                            <form class="user" method="POST" action="process_signup.php">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" placeholder="Username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="inputEmail" placeholder="Email Address" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="inputPassword" placeholder="Password" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="inputConfirmPassword" placeholder="Confirm Password" value="<?php echo isset($confirmPassword) ? htmlspecialchars($confirmPassword) : ''; ?>">
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
                                <button type="submit" class="btn btn-primary btn-user btn-block">Sign Up</button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="process_login.php">Already have an account? Login!</a>
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