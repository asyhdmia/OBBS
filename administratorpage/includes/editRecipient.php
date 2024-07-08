<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloodbank";

$connection = new mysqli($servername, $username, $password, $database);

$ID = "";
$name = "";
$phoneNum = "";
$Descrip = "";

$errorMessage = "";
$successMessage = "";

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["ID"])) {
        header("location:http://localhost/dashboard/OBBS/administratorpage/blood-requests.php");
        exit;
    }

    $ID = $_GET["ID"];

    $sql = "SELECT * FROM recipients WHERE ID=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:http://localhost/dashboard/OBBS/administratorpage/blood-requests.php");
        exit;
    }

    $name = $row["name"];
    $phoneNum = $row["phoneNum"];
    $Descrip = $row["Descrip"];
} else {
    $ID = $_POST["ID"];
    $name = $_POST["name"];
    $phoneNum = $_POST["phoneNum"];
    $Descrip = $_POST["Descrip"];

    do {
        if (empty($ID) || empty($name) || empty($phoneNum) || empty($Descrip)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE recipients SET name=?, phoneNum=?, Descrip=? WHERE ID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssi", $name, $phoneNum, $Descrip, $ID);
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Recipient has been updated";

        header("location: http://localhost/dashboard/OBBS/administratorpage/blood-requests.php");
        exit;
    } while (true);
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Recipient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
    <h2>Edit Recipient</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>

    <form method="post">
        <input type="hidden" name="ID" value="<?php echo htmlspecialchars($ID); ?>">

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phoneNum" value="<?php echo htmlspecialchars($phoneNum); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Descrip" value="<?php echo htmlspecialchars($Descrip); ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="http://localhost/dashboard/OBBS/administratorpage/blood-requests.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
