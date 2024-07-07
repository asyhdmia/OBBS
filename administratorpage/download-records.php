<?php
session_start();
//error_reporting(0);
session_regenerate_id(true);
include('includes/config.php');
?>
<table border="1">
									<thead>
										<tr>
										<th>No</th>
											<th>Donor Name</th>
											<th>IC No</th>
											<th>Phone</th>
											<th>Address</th>
											<th>Marital Status</th>
										</tr>
									</thead>

<?php
$filename="Donor list";
$sql = "SELECT * from  registration ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{

echo '
<tr>
<td>'.$cnt.'</td>
<td>'.$fullName= $result->fullName.'</td>
<td>'.	$IC_No= $result->IC_No.'</td>
<td>'.$Phone= $result->Phone.'</td>
<td>'.$Address= $result->Address.'</td>
<td>'.$maritalStatus= $result->maritalStatus.'</td>
';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
			$cnt++;
			}
	}
?>
</table>
