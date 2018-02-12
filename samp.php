<?php
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
 echo $con->connect_error;
}
$num='';
$num1='';
$inctype='';
$sql = "SELECT count(accountid) FROM country";
$result=$con->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	$num=$num.$row['count(accountid)'];
	//echo $row['accountid'];
	}
	if($num==1){
		$sql1="SELECT accountid FROM country";
		$result1=$con->query($sql1);
		while($row=$result1->fetch_assoc()){
			$inctype.="<input type='hidden' class='form-control' name='name' value='".$row['accountid']."' required>";
		}
	}else{
		$inctype.="Name:-&nbsp;&nbsp;&nbsp;<input type='text' class='form-control' name='name' placeholder='Enter your accountId' required>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width,initial-scale=1'>
<title>Signup form</title>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
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
</style>
</head>
<body>
<div class='login-form'>
 <form action='' method='post'>
	<h3 class='text-center'>Sign up form</h3>
	<div class='form-group'>
       <!-- Name:-&nbsp;&nbsp;&nbsp;<input type='text' class='form-control' name='name' placeholder='Enter your accountId' required>-->
	   <?php echo $inctype;?>
    </div>
	<div class='form-group'>
		Mail Id:-&nbsp;&nbsp;&nbsp;<input type='email' class='form-control'  name='mail' placeholder='Enter your cmpmail' pattern='[a-zA-Z0-9!#$%&amp;*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*' required>
	</div>
	<div class='form-group'>
		Mob.no:-&nbsp;&nbsp;&nbsp;<input type='tel' class='form-control'  name='mob' placeholder='Enter your cmpphone' pattern='[789][0-9]{9}' required>
	</div>
	<div class='form-group'>
            <button type='submit' class='btn btn-primary btn-block' name='submit'>Save</button>
    </div>
 </form>
</div>
</body>
</html>
