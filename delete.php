<?php

//connection to the database
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
 echo $con->connect_error;
}
$id = $_GET['stdid'];
$sql = "DELETE FROM student_master WHERE stdid=".$id;
if ($con->query($sql))
{
    header('location:home.php');
}
else{
	echo "error";
}
?>