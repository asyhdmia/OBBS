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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-5/assets/css/registration-5.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="wrapper d-flex align-items-stretch">
  <nav id="sidebar">
    <div class="custom-menu">
      <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
      </button>
    </div>
    <div class="p-4">
      <h1><a href="index.html" class="logo">Blood Bank <span>Online System</span></a></h1>
      <ul class="list-unstyled components mb-5">
        <li class="active">
          <a href="index.html"><span class="fa fa-home mr-3"></span> Home</a>
        </li>
        <li>
            <a href="registration.php"><span class="fa fa-pencil-square-o mr-3"></span> Register</a>
        </li>
        <li>
          <a href="appo.html"><span class="fa fa-calendar-o mr-3"></span>Appointment</a>
        </li>
        <li>
          <a href="#"><span class="fa fa-user mr-3"></span> Profile</a>
        </li>
        <li>
          <a href="#"><span class="fa fa-book mr-3"></span> Manual</a>
        </li>
      </ul>
    </div>
  </nav>

  <section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="card border-light-subtle shadow-sm">
      <div class="row g-0">
        <div class="col-12 col-md-6 text-bg-danger">
          <div class="d-flex align-items-center justify-content-center h-100">
            <div class="col-10 col-xl-8 py-3">
              <img class="img-fluid rounded mb-4" loading="lazy" src="css/registerdonor.jpg" width="500" height="400" alt="BootstrapBrain Logo">
              <hr class="border-primary-subtle mb-4">
              <h2 class="h1 mb-4">YOUR DONATION MAKES A DIFFERENCE.</h2>
              <p class="lead m-0">Your donation will go a long way in helping us make a difference.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h2 class="h3">Registration</h2>
                  <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register as donor</h3>
                </div>
              </div>
            </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="row gy-3 gy-md-4 overflow-hidden">
      <div class="col-12">
        <label for="name">Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo isset($fullName) ? $fullName : ''; ?>"><br>
        </div>

        <div class="col-12">
        <label for="IC_No">IC No:</label>
        <input type="text" id="IC_No" name="IC_No" value="<?php echo isset($IC_No) ? $IC_No : ''; ?>"><br>
        </div>
        
        <div class="col-12">
        <label for="Phone">Phone:</label>
        <input type="text" id="Phone" name="Phone" value="<?php echo isset($Phone) ? $Phone : ''; ?>"><br>
        
        <div class="col-12">
        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address" value="<?php echo isset($Address) ? $Address : ''; ?>"><br>
        </div>

        <div class="col-12">
        <label for="maritalStatus">Marital Status:</label>
        <select id="maritalStatus" name="maritalStatus">
          <option value="Single" <?php if(isset($maritalStatus) && $maritalStatus == "Single") echo "selected"; ?>>Single</option>
          <option value="Married" <?php if(isset($maritalStatus) && $maritalStatus == "Married") echo "selected"; ?>>Married</option>
          <option value="Widowed" <?php if(isset($maritalStatus) && $maritalStatus == "Widowed") echo "selected"; ?>>Widowed</option>
          <option value="Divorced" <?php if(isset($maritalStatus) && $maritalStatus == "Divorced") echo "selected"; ?>>Divorced</option>
        </select>
        <br>
        </div>

        <div class="col-12"></div>
        <input type="checkbox" id="iAgree" name="iAgree" <?php if(isset($iAgree) && $iAgree) echo "checked"; ?>>
        <label for="iAgree">I agree to the terms and conditions</label><br>
        </div>

        <div class="col-12">
        <div class="d-grid">
        <button class="btn bsb-btn-xl btn-danger" type="submit">Register</button>
        </div>
                </div>
    </form>
    </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>

