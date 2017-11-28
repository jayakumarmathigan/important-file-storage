
<?php
$con = new mysqli("localhost","root","","mydb");
if($con->connect_error){
    echo $con->connect_error;
    die("sorry database connection failed");
}
?>



<html>
    <head>
        <title>
            to change password successfully.
        </title>
    </head>
    <body>
        <form method="POST">
           
            <label>old password</label><input type="password" name="oldpass"/><br/>
            <label>new password</label><input type="password" name="newpass"/>
            <input type="submit" name="submit" value="submit"/>
        </form>
        
        <?php
            if(isset($_POST['submit']))
            {
                
                $oldpass=$_POST['oldpass'];
                $newpass=$_POST['newpass'];
                
                $sql="SELECT * FROM signup WHERE password='$oldpass'";
                $result=mysqli_query($con, $sql);
                $resultCheck=mysqli_num_rows($result);
                if($resultCheck>0)
                {
                    $sql="UPDATE signup SET password='$newpass'";
                    if($con->query($sql))
                    {
                        echo"your password updated successfully";
                    }
                    else
                    {
                        echo"sorry ";

                    }
                    
                }
                else
                {
                    echo"old password does not match";
                }
               
            }
       ?>
        
        
    </body>
</html>