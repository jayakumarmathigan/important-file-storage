<?php
//connection to the database
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
 echo $con->connect_error;
}
$tbl1=$tbl2=$tbl3=$tbl4=$tbl5=$tbl6='';
$sql = "SELECT * FROM student_master INNER JOIN class_master ON student_master.stdclass = class_master.classid";
$result = $con->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	//echo "<br/>";
	//echo $row['stdname']." ".$row['stddob']." ".$row['stdsex']." ".$row['classname']."<br/>";
	$tbl1 = $tbl1.'<p class="text-center">'.$row["stdid"].'</p>';
	$tbl2 = $tbl2.'<p class="text-center">'.$row["stdname"].'</p>';
	$tbl3 = $tbl3.'<p class="text-center">'.$row["stddob"].'</p>';
	$tbl4 = $tbl4.'<p class="text-center">'.$row["classname"].'</p>';
	$tbl5 = $tbl5.'<p class="text-center"><a href="update.php?stdid='.$row['stdid'].'"><input type="button" class="btn btn-success btn-small" name="update" value="Update"></p>';
	$tbl6 = $tbl6.'<p class="text-center"><a href="delete.php?stdid='. $row['stdid'].'"><input type="button" class="btn btn-danger btn-small" name="delete" value="Delete"></a></p>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Details Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style> 
#flow{float:right;margin:10px;}
.col-md-2{border:1px solid black;border-collapse:collapse;}
h5{font-weight:600;background-color:grey;padding:9px;color:darkorange;}
.btn-success,.btn-danger{font-size: 9px;padding: 3px 8px;}
</style>
<script type="text/javascript">
function flow(){
	window.location.assign('add.php');
}
</script>
</head>
<body>
<div class="container">
	<input type="button" class="btn btn-primary" onclick="flow()" id="flow" value="ADD">
</div>
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<h5 class="text-center">ID</h5>
			<?php echo $tbl1; ?>
		</div>
		<div class="col-md-2">
			<h5 class="text-center">NAME</h5>
			<?php echo $tbl2; ?>
		</div>
		<div class="col-md-2">
			<h5 class="text-center">DOB</h5>
			<?php echo $tbl3; ?>
		</div>
		<div class="col-md-2">
			<h5 class="text-center">CLASS</h5>
			<?php echo $tbl4; ?>
		</div>
		<div class="col-md-2">
			<h5 class="text-center">EDIT</h5>
			<?php echo $tbl5; ?>
		</div>
		<div class="col-md-2">
			<h5 class="text-center">DELETE</h5>
			<?php echo $tbl6; ?>
		</div>
	</div>
</div>
</body>
</html>