<?php
if( isset($_GET["ID"])){
    $ID = $_GET["ID"];

    $servername="localhost";
$username="root";
$password="";
$database="bloodbank";

$connection = new mysqli($servername,$username,$password,$database);

$sql = "DELETE FROM recipients WHERE ID=$ID";
$connection->query($sql);

}

header("location: http://localhost/dashboard/OBBS/administratorpage/blood-requests.php");
exit;
?>