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

        header("location:/Project_obbs/sidebar-05/registration2.php");
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
        <form action="#!">
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                  <input type="fullName" class="form-control" name="fullName" id="fullName" value="<?php echo $fullName; ?>"></input>
                </div>
                <div class="col-12">
                  <label for="IC_No" class="form-label">IC No <span class="text-danger">*</span></label>
                  <input type="IC_No" class="form-control" name="IC_No" id="IC_No" value="<?php echo $IC_No; ?>"></input>
                </div>
                <div class="col-12">
                  <label for="Phone" class="form-label">Phone <span class="text-danger">*</span></label>
                  <input type="Phone" class="form-control" name="Phone" id="Phone" value="<?php echo $Phone; ?>"></input>
                </div>
				<div class="col-12">
                  <label for="Address" class="form-label">Address <span class="text-danger">*</span></label>
                  <input type="Address" class="form-control" name="Address" id="Address" value="<?php echo $Address; ?>"></input>
                </div>
				<div class="col-12">
				<label for="maritalStatus" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                  
                                  <select id="maritalStatus" class="form-control">
                                    <option selected>Marital Status ...</option>
                                    <option value="Single" <?php if(isset($maritalStatus) && $maritalStatus == "Single") echo "selected"; ?>>Single</option>
                                    <option value="Married" <?php if(isset($maritalStatus) && $maritalStatus == "Married") echo "selected"; ?>>Married</option>
                                    <option> widowed</option>
                                    <option> Divorced</option>
                                  </select>
                        </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                    <label class="form-check-label text-secondary" for="iAgree">
                      I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-danger" type="submit">Register</button>
                  </div>
                </div>
              </div>
            </form>
    </div>
</body>
</html>