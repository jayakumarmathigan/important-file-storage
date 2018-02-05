<?php
$con = mysqli_connect("localhost","root","","student");
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";


if(isset($_POST['submitBtn']) && !empty($_POST['submitBtn'])) {
    if(isset($_FILES['uploadFile']['name']) && !empty($_FILES['uploadFile']['name'])) {
        //Allowed file type
        $allowed_extensions = array("jpg","jpeg","png","gif");
    
        //File extension
        $ext = strtolower(pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION));
    
        //Check extension
        if(in_array($ext, $allowed_extensions)) {
           //Convert image to base64
           $encoded_image = base64_encode(file_get_contents($_FILES['uploadFile']['tmp_name']));
           $encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;
           $query = "insert into `images` set `encoded_image` = '".$encoded_image."'";
           mysqli_query($con, $query);
           echo "File name : " . $_FILES['uploadFile']['name'];
           echo "<br>";
           if(mysqli_affected_rows($con) > 0) {
              echo "Status : Uploaded";
              $last_insert_id = mysqli_insert_id($con); 
           } else {
              echo "Status : Failed to upload!";
           }
       } else {
           echo "File not allowed";
       }
	   $query = "select `encoded_image` from `images` where `id`= ". $last_insert_id;
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_object($result);
		echo "<br><br>";
		echo '<img src="'.$row->encoded_image.'" width="250">';
  }
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
</head>
<body>
<form action="" method="post" id="form" enctype="multipart/form-data">
     Upload image : 
     <input type="file" name="uploadFile" value="" />
     <input type="submit" name="submitBtn" value="Upload" />
</form>
</body>
</html>