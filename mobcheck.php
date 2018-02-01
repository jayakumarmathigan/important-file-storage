<?php
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
	echo $con->connect_error;
}
$clsname='';
$sql = "SELECT * FROM class_master";
$result = $con->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		$clsname = $clsname . "<option value='".$row['classid']."'>".$row['classname']."</option>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Simple Login Form</title>
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
    .login-form h2 {
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
	#message{
		color:red;
		text-align:center;
	}
</style>
</head>
<body>
<div class="login-form">
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <h2 class="text-center">Checking Details</h2>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="user_name" required="required">
        </div>
        <div class="form-group">
            <input type="tel" class="form-control" placeholder="Phone number" name="mob" required="required">
        </div>
		 <div class="form-group">
           Class:- <select name="s_dept">
				<?php echo $clsname; ?>
			</select>
        </div>
		<div class="form-group">
			
		</div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
        </div>      
    </form>
</div>
<?php
if(isset($_POST['submit'])){
	$name = $_POST['user_name'];
	$mob = $_POST['mob'];
	$dept = $_POST['s_dept'];
	$sql1 = "SELECT mobile FROM mobile WHERE mobile='$mob'";
	$result = $con->query($sql1);
	if($result->num_rows>0){
		echo "mobile number already exists";
	}else{
	$sql = "INSERT INTO mobile(name,mobile,dept) VALUES('$name', '$mob', '$dept')";
	if($con->query($sql)){
		echo "submitted successfully";
		echo "<br/>";
	}
	else{
		echo "error";
	}
	$sql = "SELECT mobile.id, mobile.`name`, mobile.mobile, class_master.classname FROM mobile INNER JOIN class_master ON mobile.dept = class_master.classid";
	//$sql = "SELECT * FROM mobile";
	$result = $con->query($sql);
	if($result->num_rows>0){
		while($row=$result->fetch_assoc()){
			echo "Your name ".$row['name'].". Your mobile number ".$row['mobile'].". Your department ".$row['classname'].".";
			echo "<br/>";
		}
	}
	}
}
?>
</body>
</html>