<?php
$con = new mysqli("localhost", "root", "", "student");
if($con->connect_error){
	echo $con->connect_error;
}
?>
<?php
error_reporting(1);
//if(isset($_POST['submit'])){
	$name = $_POST['username'];
	$pass = $_POST['password'];
$sql = "SELECT userid, pwd FROM user_master WHERE userid='$name' AND pwd='$pass'";
//$sql = "SELECT userid, pwd FROM user_master WHERE userid='".$name."' AND pwd='".$pass."'";
//echo $sql;
$result = $con->query($sql);
if($result->num_rows>0){
	echo 1;
}else{
	echo 0;
}

?>