                <?php
                        $servername = "localhost";
                        $username = "root";
                        $password="";
                        $database="bloodbank";

                        $connection = new mysqli($servername,$username,$password,$database) ;

                        if($connection->connect_error){
                            die("Connection failed: ". $connection->connect_error);
                        }
                       
                        $sql = "SELECT * FROM recipients";
                        $result = $connection->query($sql);

                        if(!$result){
                            die("Invalid query: " .$connection->error);
                        }
                ?>
<!-- Registration 5 - Bootstrap Brain Component -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-5/assets/css/registration-5.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">

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
            <a href="registration.html"><span class="fa fa-pencil-square-o mr-3"></span> Register</a>
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
            <form action="#!">
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                  <input type="fullName" class="form-control" name="fullName" id="fullName" placeholder="Full Name" required>
                </div>
                <div class="col-12">
                  <label for="IC_No" class="form-label">IC No <span class="text-danger">*</span></label>
                  <input type="IC_No" class="form-control" name="IC_No" id="IC_No" placeholder="NRIC Number" required>
                </div>
                <div class="col-12">
                  <label for="Phone" class="form-label">Phone <span class="text-danger">*</span></label>
                  <input type="Phone" class="form-control" name="Phone" id="Phone" placeholder="Mobile No." required>
                </div>
				<div class="col-12">
                  <label for="Address" class="form-label">Address <span class="text-danger">*</span></label>
                  <input type="Address" class="form-control" name="Address" id="Address" placeholder="Current Address" required>
                </div>
				<div class="col-12">
				<label for="maritalStatus" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                  
                                  <select id="maritalStatus" class="form-control">
                                    <option selected>Marital Status ...</option>
                                    <option> Single</option>
                                    <option> Married</option>
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
        </div>
      </div>
    </div>
  </div>
</section>