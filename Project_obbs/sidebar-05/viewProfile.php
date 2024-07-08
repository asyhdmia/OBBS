<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloodbank";

// Establish the database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest donor profile data
$sql = "SELECT * FROM registration ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullName = $row["fullName"];
    $ic_num = $row["IC_No"];
    $phone_num = $row["Phone"];
    $home_address = $row["Address"];
    $mar_stats = $row["maritalStatus"];
} else {
    echo "No donor profile found.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Donor Profile</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-5/assets/css/registration-5.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-danger">

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
          <a href="viewProfile.php"><span class="fa fa-user mr-3"></span> Profile</a>
        </li>
        <li>
              <a href="manual.html"><span class="fa fa-book mr-3"></span> Manual</a>
	          </li>
			  <li>
				<a href="http://localhost/dashboard/OBBS/Homepage/index.html"><span class="fa fa-sign-out mr-3"></span>Logout</a>
			</li>
      </ul>
    </div>
  </nav>

  <section class="p-3 p-md-4 p-xl-5 bg-danger w-100">
    <div class="container-fluid">
      <div class="card border-light-subtle shadow-sm stretch-card">
        <div class="row g-0">
          <div class="col-12">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
                <div class="col-12">
                  <div class="mb-5">
                    <h1 class="h2">View Donor Profile</h1> 

                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                      <!-- Content Header (Page header) -->
                      <section class="content-header">
                        <div class="container-fluid">
                          <div class="row mb-2">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                            </div>
                          </div>
                        </div><!-- /.container-fluid -->
                      </section>
  
                      <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                          <div class="container-fluid">
                            <div class="row mb-2">
                              <div class="col-sm-6">
                              </div>
                              <div class="col-sm-6">
                              </div>
                            </div>
                          </div><!-- /.container-fluid -->
                        </section>

                        <!-- Main content -->
                        <section class="content">
                          <div class="container-fluid">
                            <div class="row">
                              <!-- left column -->
                              <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                  <div class="card-header">
                                    <h3 class="card-title"></h3>
                                  </div>
                                  <!-- /.card-header -->
                                  <!-- form start -->
                                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="card-body">
                                      <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input name="fullName" id="fullName" type="text" class="form-control" value="<?php echo isset($fullName) ? $fullName : ''; ?>" readonly><br>
                                      </div>
                                      <div class="form-group">
                                        <label for="ic_no" class="form-label">IC No</label>
                                        <input name="ic_num" id="ic_num" type="text" class="form-control" value="<?php echo isset($ic_num) ? $ic_num : ''; ?>" readonly><br>
                                      </div>
                                      <div class="form-group">
                                        <label for="phone_no" class="form-label">Phone</label>
                                        <input name="phone_num" id="phone_num" type="text" class="form-control" value="<?php echo isset($phone_num) ? $phone_num : ''; ?>" readonly><br>
                                      </div>
                                      <div class="form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <input name="home_address" id="home_address" type="text" class="form-control" value="<?php echo isset($home_address) ? $home_address : ''; ?>" readonly><br>
                                      </div>
                                      <div class="form-group">
                                        <label for="marital_status" class="form-label">Marital Status</label>
                                        <input name="mar_stats" id="mar_stats" type="text" class="form-control" value="<?php echo isset($mar_stats) ? $mar_stats : ''; ?>" readonly><br>
                                      </div>

                                      <div class="card-footer">
                                        <button type="button" class="btn btn-danger" onclick="location.href='index.html'">Back</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
