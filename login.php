<?php
$con = new mysqli("localhost","root","","mydb");
if($con->connect_error){
    echo $con->connect_error;
    die("sorry database connection failed");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
    </head>
    <body>
        <form action="" method="POST">
            <label>Name</label><input type="text" name="user"/>
            <label>password</label><input type="password" name="pass"/>
            <input type="submit" name="submit" value="submit"/>
        </form>
        <?php
        if(isset($_POST["submit"])){
            $name=$_POST['user'];
            $password=$_POST['pass'];
            
            $sql="SELECT * FROM signup WHERE username='$name' AND password='$password'";
            $result=mysqli_query($con, $sql);
            $resultCheck=mysqli_num_rows($result);
            if($resultCheck>0)
                {
                echo "login success";
            }
            else
                {
                echo "failed to login";
            }
        }
        ?>
    </body>
</html>