<?php
$servername="localhost";
$username="root";
$password="";
$database="bloodbank";

$connection = new mysqli($servername,$username,$password,$database);
$name = "";
$phoneNum = "";
$Descrip = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $phoneNum = $_POST["phoneNum"];
    $Descrip = $_POST["Descrip"];

    do{
        if( empty($name) || empty($phoneNum) || empty($Descrip)){
            $errorMessage ="All the fields are required";
            break;
        }

        $sql = "INSERT INTO recipients (name,phoneNum,Descrip)" . "VALUES ('$name','$phoneNum','$Descrip')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: ". $connection->error;
            break;
        }

        $name = "";
        $phoneNum = "";
        $Descrip = "";

        $successMessage = "Recipient have succesfully added";

        header("location:http://localhost/dashboard/OBBS/administratorpage/blood-requests.php");
        exit;

    }while(false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>createRecipient</title>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-social.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/chart.css">
<link rel="stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container my-5">
        <h2>New Recipient</h2>

        <?php
        if( !empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
               <strong>$errorMessage</strong>
               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>
               ";
        }
        ?>
        <form method="post">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>"></input>
            </div>
        </div>

        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phoneNum" value="<?php echo $phoneNum; ?>"></input>
            </div>
        </div>

        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Descrip" value="<?php echo $Descrip; ?>"></input>
            </div>
        </div>

        <?php
        if ( !empty($successMessage) ){
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
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
                <button type = "submit" class="btn btn-primary"> Submit</button>
            </div>
            <div class="offset-sm-3 col-sm-3 d-grid">
               <a class="btn btn-outline-primary" href="http://localhost/dashboard/OBBS/administratorpage/blood-requests.php" role="button">Cancel</a>
            </div>
        </div>
</form>

    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
