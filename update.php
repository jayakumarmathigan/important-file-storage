<?php
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
 echo $con->connect_error;
}
$clsnam='';
$sql = "SELECT classid, classname FROM class_master";
$results = $con->query($sql);
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
<?php
if(isset($_GET['stdid'])){
$id = $_GET['stdid'];
$sql1 = "SELECT * FROM student_master WHERE stdid=$id";
$result = $con->query($sql1);
while($row=$result->fetch_assoc()){
	echo '<div class="login-form">';
	echo '<form method="post">';
	echo '<h3 class="text-center">Student Details</h3>';
	echo '<div class="form-group">';
	echo	'<input type="hidden" class="form-control" name="s_id" value="'.$row['stdid'].'">';
	echo '</div>';
	echo '<div class="form-group">';
	echo ' Name:-&nbsp;&nbsp;&nbsp;<input type="text" class="form-control" name="s_name" value="'. $row['stdname'].'">';
    echo '</div>';
	echo '<div class="form-group">';
	echo '	Date of birth:-&nbsp;&nbsp;&nbsp;<input type="date" class="form-control"  name="s_dob" value="'. $row['stddob'].'">';
	echo '</div>';
	echo '<div class="form-group">';
	if($row['stdsex']=='male'){
	echo 'Sex:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male <input type="radio" name="s_sex" value="male" checked>
			 Female <input type="radio" name="s_sex" value="female">';
	}else{
		echo 'Sex:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male <input type="radio" name="s_sex" value="male">
			 Female <input type="radio" name="s_sex" value="female" checked>';
	}
	echo '</div>';
	echo '<div class="form-group">';
	echo '	Class:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="s_class">';
			if($results->num_rows>0){
				while($rows=$results->fetch_assoc()){
					if($rows['classid']==$row['stdclass'])
					{
						$clsnam = $clsnam . "<option value= '".$rows['classid']."' selected>".$rows['classname']."</option>";
					}
					else
					{
						$clsnam = $clsnam . "<option value= '".$rows['classid']."'>".$rows['classname']."</option>";
					}
		
				}
			}
			echo $clsnam;
	echo '	</select>';
	echo '</div>';
	echo '<div class="form-group">';
    echo '        <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>';
    echo '</div>';
 echo '</form>';
echo '</div>';
}
}
if(isset($_POST['submit'])){
	$id = $_POST['s_id'];
	$name = $_POST['s_name'];
	$dob = $_POST['s_dob'];
	$sex = $_POST['s_sex'];
	$class_name = $_POST['s_class'];
	$date = date("Y-m-d");
	$sol = $date - $dob;
	if($sol>15){
	$sql2 = "UPDATE student_master SET stdname='".$name."', stddob='".$dob."', stdsex='".$sex."', stdclass=".$class_name." WHERE stdid=".$id;
	if($con->query($sql2)){
		header('location:home.php');
	}else{
		echo "<p>error while updating</p>";
	}
	}else{
		echo "Age should be greater than 15";
	}
}
?>
</body>
</html>