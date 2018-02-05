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
	/* The Modal (background) */
	.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content {
	   background-color: #3b4148;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
	}

	/* The Close Button */
	.close {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: #000;
		text-decoration: none;
		cursor: pointer;
	}
</style>
<script type="text/javascript">
            $(document).ready(function(){

                $("#submit").click(function(){
                    var username = $("#user_id").val().trim();
                    var password = $("#password").val().trim();

                    if( username != "" && password != "" ){
                        $.ajax({
                            url:'login2.php',
                            type:'post',
                            data:{username:username,password:password},
                            success:function(response){
                                var msg = "";
                                if(response == 1){
                                    //alert('success');
                                    //window.location = "home.php";
									// Get the modal
										var modal = document.getElementById('myModal');

										// Get the button that opens the modal
										//var btn = document.getElementById("myBtn");

										// Get the <span> element that closes the modal
										var span = document.getElementsByClassName("close")[0];

										// When the user clicks the button, open the modal 
										 function myTest() {
											modal.style.display = "block";
										}

										// When the user clicks on <span> (x), close the modal
										span.onclick = function() {
											modal.style.display = "none";
											window.location.assign("home.php");
										}

										// When the user clicks anywhere outside of the modal, close it
										window.onclick = function(event) {
											if (event.target == modal) {
												modal.style.display = "none";
											}
										}
									myTest();
									
                                }else{
                                    msg = "Invalid username and password!";
									 $("#message").html(msg);
									 return false;
                                }
                               
                            }
                        });
                    }
                });

            });
</script>
</head>
<body>
<div class="login-form">
    <form>
        <h2 class="text-center">Log in</h2>
		<div id="message"></div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" id="user_id" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" id="password" required="required">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" id="submit">Log in</button>
        </div>
        <div class="clearfix">
          <!--  <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>-->
		  <a href="reset.php" class="pull-left">Create new Password</a>
            <a href="mobcheck.php" class="pull-right">Forgot Password?</a>
        </div>        
    </form>
    <p class="text-center"><a href="signup.php">Create an Account</a></p>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p style="color:#fff;">success</p>
  </div>

</div>
</body>
</html>                                		                            