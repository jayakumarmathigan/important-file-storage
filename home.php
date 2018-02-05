<?php
//connection to the database
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
 echo $con->connect_error;
}
$tbl1='';
$sql = "SELECT * FROM student_master INNER JOIN class_master ON student_master.stdclass = class_master.classid";
$result = $con->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	$tbl1 = $tbl1.'<tr><td class="text-center">'.$row["stdid"].'</td><td class="text-center">'.$row["stdname"].'</td><td class="text-center">'.$row["stddob"].'</td>
	<td class="text-center">'.$row["classname"].'</td>
	<td class="text-center"><a href="update.php?stdid='.$row['stdid'].'"><input type="button" class="btn btn-success" name="update" value="Update"></td>
	<td class="text-center"><a href="delete.php?stdid='. $row['stdid'].'"><input type="button" class="btn btn-danger" name="delete" value="Delete"></a></td></tr>';
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
table{width:100%;}
table,tr,td{border:1px solid grey;border-collapse:collapse;}
th{background-color:#048faf;text-align:center;color:#fff;padding:5px;}
td{padding:5px;text-align:center;color: midnightblue;}
#btn{margin:20px;}
tr:nth-child(even) {background: #CCC}
tr:nth-child(odd) {background: #FFF}
</style>
<script type="text/javascript">
function flow(){
	window.location.assign('add.php');
}
function flow1(){
	window.location.assign('login.php');
}
</script>
</head>
<body style="background-color: rgba(0,0,0,0.4);">
<div class="container-fluid">
<div id="btn">
<input type="button" class="btn btn-primary" onclick="flow()" style="float:right;" value="ADD">
<input type="button" class="btn btn-info" onclick="flow1()"  value="SignOut">
</div>
<br/>
<center>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>DOB</th>
				<th>CLASS</th>
				<th>EDIT</th>
				<th>DELETE</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tbl1; ?>
		</tbody>
	</table>
</center>
</div>
</body>
</html>