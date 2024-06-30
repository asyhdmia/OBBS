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
  $maritalStatus = isset($_POST["maritalStatus"]) ? $_POST["maritalStatus"] : '';
  $iAgree = isset($_POST["iAgree"]) ? 1 : 0;
  
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

      header("location:/OBBS/Project_obbs/sidebar-05/registration.php");
      exit;

  }while(false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form with Select Option</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo isset($fullName) ? $fullName : ''; ?>"><br>
        <label for="IC_No">IC No:</label>
        <input type="text" id="IC_No" name="IC_No" value="<?php echo isset($IC_No) ? $IC_No : ''; ?>"><br>
        <label for="Phone">Phone:</label>
        <input type="text" id="Phone" name="Phone" value="<?php echo isset($Phone) ? $Phone : ''; ?>"><br>
        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address" value="<?php echo isset($Address) ? $Address : ''; ?>"><br>
        <label for="maritalStatus">Marital Status:</label>
        <select id="maritalStatus" name="maritalStatus">
          <option value="Single" <?php if(isset($maritalStatus) && $maritalStatus == "Single") echo "selected"; ?>>Single</option>
          <option value="Married" <?php if(isset($maritalStatus) && $maritalStatus == "Married") echo "selected"; ?>>Married</option>
          <option value="Widowed" <?php if(isset($maritalStatus) && $maritalStatus == "Widowed") echo "selected"; ?>>Widowed</option>
          <option value="Divorced" <?php if(isset($maritalStatus) && $maritalStatus == "Divorced") echo "selected"; ?>>Divorced</option>
        </select>
        <br>
        <input type="checkbox" id="iAgree" name="iAgree" <?php if(isset($iAgree) && $iAgree) echo "checked"; ?>>
        <label for="iAgree">I agree to the terms and conditions</label><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

