<?php
$con = new mysqli("localhost","root","","mydb");
if($con->connect_error){
    echo $con->connect_error;
    die("sorry database connection failed");
}

?>
<html>
    <head>
        <title>image upload</title>
    </head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image"/>
        <input type="submit" name="submit" value="save"/>
    </form>
<?php
if(isset($_POST["submit"])){
   if(getimagesize($_FILES['image']['tmp_name'])==false){
       echo "please select image";
   } else{
       $image=$_FILES['image']['tmp_name'];
       $image=file_get_contents($image);
       $image= base64_encode($image);
       $sql="INSERT INTO images(image) VALUES('$image')";
       if($con->query($sql)){
           echo "image stored"."<br/>";
       }
       else{
           echo "error";
       }
   }
}
else{
    echo "please select to save image";
    echo "<br/>";
}
$sql="SELECT * FROM images";
$result=$con->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo "<img width='150px' height='150px' src='data:image;base64,{$row['image']}'>";
        echo "<br/><hr/>";
    }
}else{
    echo "no image stored";
}

?>
    	
</body>
</html>
