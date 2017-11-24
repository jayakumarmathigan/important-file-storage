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
        <title>sign up</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="first_name" placeholder="your firstname"/>
            <input type="text" name="last_name" placeholder="your lastname"/>
            <input type="email" name="email" placeholder="your email id" />
            <input type="text" name="username" placeholder="your name" />
            <input type="password" name="password" placeholder="password" />
            <input type="password" name="confirm_password" placeholder="confirm password" />
            <input type="submit" name="submit" value="save" />
        </form>
        
        <?php
        if(isset($_POST["submit"])){
            $firstname=$_POST['first_name'];
            $lastname=$_POST['last_name'];
            $email=$_POST['email'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $confirm_password=$_POST['confirm_password'];
            if($password==$confirm_password){
                $sql="INSERT INTO signup(fname,lname,email,username,password)VALUES('$firstname','$lastname','$email','$username','$password')";
                if($con->query($sql)){
                    header("Location:https://www.google.co.in/?gws_rd=ssl");
                }else{
                    echo "error";
                }
            }
        }
        ?>
    </body>
</html>

