<?php
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
 echo $con->connect_error;
}
$clsnam='';
$sql = "SELECT classid, classname FROM class_master";
$result = $con->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		//$clsnam = $clsnam . "<option value='".$row['classname']."'>'".$row['classid']."'</option>";
		$clsnam = $clsnam . "<option value= ".$row['classid'].">".$row['classname']."</option>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>student details</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h3 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<h3 class="text-center">Student Details</h3>
	<div class="form-group">
        Name:-&nbsp;&nbsp;&nbsp;<input type="text" class="form-control" name="s_name">
    </div>
	<div class="form-group">
		Date of birth:-&nbsp;&nbsp;&nbsp;<input type="date" class="form-control"  name="s_dob">
	</div>
	<div class="form-group">
		Sex:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male <input type="radio" name="s_sex" value="male">
			 Female <input type="radio" name="s_sex" value="female">
	</div>
	<div class="form-group">
		Class:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="s_class">
			<?php echo $clsnam; ?>
		</select>
	</div>
	<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
    </div>
 </form>
</div>
<?php
if(isset($_POST["submit"])){
	$name = $_POST['s_name'];
	$dob = $_POST['s_dob'];
	$sex = $_POST['s_sex'];
	$class_name = $_POST['s_class'];
	$date = date("Y-m-d");
	$sol = $date - $dob;
	if($sol>15){
	$sql = "INSERT INTO student_master(stdname,stddob,stdsex,stdclass) VALUES('$name','$dob','$sex','$class_name')";
	if($con->query($sql)){
		//echo "success"."<br/>";
		header('location:home.php');
	}else{
		echo "error";
	}
	}else{
		echo "<p id='hide'>Age should be greater than 15</p>";
		//echo '<script type="text/javascript">jsfunction();</script>';
		//echo "Age should be greater than 15.";
	}
}
else{
	
}
?>
<script type="text/javascript">
function jsfunction(){
	setTimeout( 5000, doHide()) ;
	function doHide(){
		document.getElementById('hide').style.display = "none";
	}
}
</script>
</body>
</html>