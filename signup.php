<?php
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
	echo $con->connect_error;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device,width, initial-scale=1">
<title>Sign up form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style>
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
	#err{
		color:red;
		text-align:center;
	}
</style>
</head>
<body>
<div class="login-form">
 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<h3 class="text-center">Sign up form</h3>
	<div class="form-group">
        Name:-&nbsp;&nbsp;&nbsp;<input type="text" class="form-control" name="name" required>
    </div>
	<div class="form-group">
		Mail Id:-&nbsp;&nbsp;&nbsp;<input type="email" class="form-control"  name="mail" pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" required>
	</div>
	<div class="form-group">
		Mob.no:-&nbsp;&nbsp;&nbsp;<input type="tel" class="form-control"  name="mob" pattern="[789][0-9]{9}" required>
	</div>
	<div class="form-group">
		Password:-<input type="password" class="form-control"  name="pass" required>
	</div>
	<div class="form-group">
		Confirm Password:-<input type="password" class="form-control"  name="pass1" required>
	</div>
	<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
    </div>
 </form>
</div>
<?php
$pass2 = '';
if(isset($_POST["submit"])){
	$name = $_POST["name"];
	$email = $_POST["mail"];
	$mob = $_POST["mob"];
	$pass = $_POST["pass"];
	$pass1 = $_POST["pass1"];
	$sql = "SELECT * FROM signup WHERE mail = '$email' OR mob = '$mob'";
	$result = $con->query($sql);
	if($result->num_rows>0){
		echo "<p id='err'>This email/mobno already exists</p>";
	}else{
		if($pass != $pass1){
			echo "<p id='err'>Password should be same</p>";
		}else{
			$sql = "INSERT INTO signup(name,mail,mob,pass) VALUES('$name','$email','$mob','$pass')";
			if($con->query($sql)){
				header('location:home.php');
			}else{
				echo "<p id='err'>These information is not stored</p>";
			}
		}
   }
}
?>
<script type="text/javascript">
$(window).load(function() {
 // executes when complete page is fully loaded, including all frames, objects and images                  
	 setTimeout(function () {
		 $('#err').hide();
	 }, 2500);   
});
</script>
</body>
</html>