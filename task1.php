<?php 
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
	echo $con->connect_error;
}
$country='';
$city='';
$sql = "SELECT * FROM country_city";
$result = $con->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		$country=$country."<option value='".$row['id']."'>".$row['country']."</option>";
		$city=$city."<option value='".$row['id']."'>".$row['city']."</option>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>I am the best</title>
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
	<form action="task2.php" method="post">
		 <div class="form-group">
			 <input type="text" class="form-control" id="user" placeholder="Username" name="user_name">
			 <center>
			 <span id="demo" style="color:red;"></span>
			 </center>
		 </div>
		  <div class="form-group">
			 <input type="text" class="form-control" id="mail" placeholder="Email Id" name="user_id">
			 <span id="demo1"></span>
		 </div>
		 <div class="form-group">
			Country:-&nbsp;<select name="country">
				<?php echo $country; ?>
			 </select>
		 </div>
		  <div class="form-group">
			 City:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="city">
				<?php echo $city; ?>
			 </select>
		 </div>
		 <div class="form-group">
            <button type="submit" onclick="return validateForm();" class="btn btn-primary btn-block" name="submit">Submit</button>
        </div>
	</form>
</div>
<script type="text/javascript">

	function validateForm(){
		var name=document.getElementById("user");
		var email=document.getElementById("mail");
		if(name.value == "" || email.value == "" ){
			document.getElementById("demo").innerHTML="username/mail id is empty";
			return false;
		}
	}

</script>
</body>
</html>