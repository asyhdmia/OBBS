<?php
$servername="localhost";
$username="root";
$password="";
$database="bloodbank";

$connection = new mysqli($servername,$username,$password,$database);
$fullName = "";
$IC_No = "";
$Phone = "";
$Address = "";
$maritalStatus = "";
$iAgree = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $fullName = $_POST["fullName"];
    $IC_No = $_POST["IC_No"];
    $Phone = $_POST["Phone"];
    $Address = $_POST["Address"];
    $maritalStatus = $_POST["maritalStatus"];
    $iAgree = $_POST["iAgree"];

    do{
        if( empty($fullName) || empty($IC_No) || empty($Phone) || empty($Address) || empty($maritalStatus) || empty($iAgree)){
            $errorMessage ="All the fields are required";
            break;
        }

        $sql = "INSERT INTO registration (fullName,IC_No,Phone,Address,maritalStatus,iAgree)" . "VALUES ('$fullName','$IC_No','$Phone','$Address','$maritalStatus','$iAgree')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: ". $connection->error;
            break;
        }

        $fullName = "";
        $IC_No = "";
        $Phone = "";
        $Address = "";
        $maritalStatus = "";
        $iAgree = "";

        $successMessage = "Recipient have succesfully added";

        header("location:/Project_obbs/recipientPage.php");
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
               <a class="btn btn-outline-primary" href="/Project_obbs/RecipientPage.php" role="button">Cancel</a>
            </div>
        </div>
</form>

    </div>
</body>
</html>