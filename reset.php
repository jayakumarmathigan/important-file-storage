<?php
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
	echo $con->connect_error;
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
	#hide{text-align:center;color:red;}
</style>
</head>
<body>
<div class="login-form">
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  <marquee><h2 class="text-center">Checking Details</h2></marquee> 
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Old Password" name="old_pass">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="New Password" name="new_pass">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm Password" name="new_pass1">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
        </div> 
		<div class="clearfix">
            <a href="login.php" class="pull-right">Login</a>
        </div> 		
    </form>
</div>
<?php
if(isset($_POST['submit'])){
	$old_pass = $_POST['old_pass'];
	$new_pass = $_POST['new_pass'];
	$new_pass1 = $_POST['new_pass1'];
	$sql = "SELECT pass FROM signup WHERE pass='$old_pass'";
	$result = $con->query($sql);
	if($result->num_rows>0){
		if($new_pass == $new_pass1){
			$sql1 = "UPDATE signup SET pass='$new_pass' WHERE pass='$old_pass'";
			if($con->query($sql1))
			{
			header('location:login.php');
		}else{
			echo "<p id='hide'>Sorry,password doesn't match</p>";
		}
		}else{
			echo "<p id='hide'>Sorry,password doesn't match</p>";
		}
	}
	
}
?>
<script type="text/javascript">
$(window).load(function(){
	setTimeout(function(){
		$("#hide").hide();
	},3000);
});
</script>
</body>
</html>