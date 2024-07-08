<?php
session_start();
error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "";
$database = "bloodbank";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
 {
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $fullName = $_POST['fullName'];
        $IC_No = $_POST['IC_No'];
        $Phone = $_POST['Phone'];
        $Address = $_POST['Address'];
        $maritalStatus = $_POST['maritalStatus'];

        $sql = "UPDATE registration SET fullName=?, IC_No=?, Phone=?, Address=?, maritalStatus=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('sssssi', $fullName, $IC_No, $Phone, $Address, $maritalStatus, $id);

        if ($stmt->execute()) {
            $msg = "Donor details updated successfully";
        } else {
            $error = "Error updating details: " . $stmt->error;
        }
    }

    if(isset($_REQUEST['del'])) {
        $did = intval($_GET['del']);
        $sql = "DELETE FROM registration WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('i', $did);
        if ($stmt->execute()) {
            $msg = "Record deleted successfully";
        } else {
            $error = "Error deleting record: " . $stmt->error;
        }
    }
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>BBDMS | Donor List</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/chart.css">
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
    <?php include('includes/leftbar.php');?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Manage Registered Donors</h2>
                    <div class="panel panel-default">
                        <div class="panel-heading">Donor Info</div>
                        <a href="download-records.php" style="font-size:16px;" class="btn btn-info">Download Donor List</a>
                        <div class="panel-body">
                            <?php if($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                            <?php if($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } ?>
                            <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Donor Name</th>
                                        <th>IC No.</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Marital Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM registration";
                                    $query = $connection->query($sql);
                                    $cnt = 1;
                                    if ($query->num_rows > 0) {
                                        while($result = $query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result['fullName']);?></td>
                                        <td><?php echo htmlentities($result['IC_No']);?></td>
                                        <td><?php echo htmlentities($result['Phone']);?></td>
                                        <td><?php echo htmlentities($result['Address']);?></td>
                                        <td><?php echo htmlentities($result['maritalStatus']);?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?php echo htmlentities($result['id']); ?>">Edit</button>
                                            <a href="donor-list.php?del=<?php echo htmlentities($result['id']);?>" onclick="return confirm('Do you really want to delete this record')" class="btn btn-danger" style="margin-top:1%;">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="updateModal<?php echo htmlentities($result['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update Donor</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="donor-list.php">
                                                        <input type="hidden" name="id" value="<?php echo htmlentities($result['id']); ?>">
                                                        <div class="form-group">
                                                            <label for="fullName">Full Name</label>
                                                            <input type="text" class="form-control" name="fullName" value="<?php echo htmlentities($result['fullName']); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="IC_No">IC No.</label>
                                                            <input type="text" class="form-control" name="IC_No" value="<?php echo htmlentities($result['IC_No']); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Phone">Phone</label>
                                                            <input type="text" class="form-control" name="Phone" value="<?php echo htmlentities($result['Phone']); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Address">Address</label>
                                                            <input type="text" class="form-control" name="Address" value="<?php echo htmlentities($result['Address']); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="maritalStatus">Marital Status</label>
                                                            <input type="text" class="form-control" name="maritalStatus" value="<?php echo htmlentities($result['maritalStatus']); ?>" required>
                                                        </div>
                                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $cnt=$cnt+1; }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<?php } ?>
