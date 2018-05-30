<?php
/*
$arr_conn['server'] = "192.168.0.200";
$arr_conn['user'] = "root";
$arr_conn['password'] = "goodday123";
$arr_conn['database'] = "raspupdate";
$arr_conn['persistent'] = "N";
	sc_connection_edit("conn_mysql",$arr_conn);
*/
//sc_reset_connection_edit();

$dbsql = "select cloudserverid,accountid from company_master";
sc_select(chkdb,$dbsql);

if($chkdb == false)
	{
	
	$arr_conn = array();
	/*$arr_conn['server'] = "192.168.0.200";
	$arr_conn['user'] = "root";
	$arr_conn['password'] = "goodday123";
	$arr_conn['database'] = "raspupdate";*/
	$arr_conn['server'] = "hcr.skyhms.in";
	$arr_conn['user'] = "raspadmin";
	$arr_conn['password'] = "Dbadmin@mhc";
	$arr_conn['database'] = "raspupdate";
	$arr_conn['persistent'] = "N";
	sc_connection_edit("conn_mysql",$arr_conn);
	sc_redir(blk_cloud_login);
	}

/*$num='';
$inctype='';
$dbsql1 = "select count(accountid) from company_master";
sc_select(sqldb,$dbsql1);
if($sqldb->recordcount()>0){
	while(!$sqldb->EOF){
		 $sqldb->fields['count(accountid)'];
		$sqldb->MoveNext();
	}
	*/

	if($chkdb->recordcount()==1)	
	{		
		$inctype ="<div class='row margin' style='display:none;'>
					<div class='input-field col s12'>
						<i class='material-icons prefix'>security</i>
						<input class='validate userids' id='accountid' type='hidden' name='accountid' value='".$chkdb->fields['accountid']."' autocomplete='off'>
						<p style='display: none;' id='nameerrormsg'>Enter Valid Account ID</p>
						<label for='userid' data-error='Please Enter User Name' data-success=''>Enter Account Id</label>
					</div>
           		 </div>";
			
	}
	else
	{
		//$inctype ="<input type='text' name='accountid' id='accountid' placeholder='Enter Account Id'>";
		$inctype ="<div class='row margin'>
					<div class='input-field col s12'>
						<i class='material-icons prefix'>security</i>
						<input class='validate userids' id='accountid' type='text' name='accountid'>
						<p style='display: none;' id='nameerrormsg'>Enter Valid Account ID</p>
						<label for='userid' data-error='Please Enter User Name' data-success=''>Enter Account Id</label>
					</div>
           		 </div>";
	}



echo"<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='shortcut icon' href='assets/images/favicon.png' type='image/x-icon'>
    <link rel='icon' href='assets/images/favicon.png' type='image/x-icon'>
    <title>SkyHMS :: All-in-One Cloud Based Hotel Management System Login</title>
    <!-- Page Animation css
    <link rel='stylesheet' type='text/css' href='assets/css/animate.css'> <script type='text/javascript' src='js/jquery.js'></script>-->
    <!-- font-awesome icon css-->
    <link rel='stylesheet' href='assets/css/font-awesome.css'>

    <!-- raspberry pos login screen css-->
    <link href='assets/css/material-icons.css'  rel='stylesheet'>
    <link href='assets/css/mystyle.css' rel='stylesheet'>
    <link href='assets/css/dynamic.css' rel='stylesheet'>
    <!-- ajax login form validation script -->
    <script type='text/javascript' src='assets/js/jquery-1.9.1.min.js'></script>
    <script>
        window.onload = function() {
            $('#accountid').focus();
        }
    </script>

<script type='text/javascript'>

function do_login()
{
	var id ='';
	var user='';
	var userid='';
 var user=$('#userid').val();
 var pass=$('#password').val();
 var id=$('#accountid').val();
 if(user!='' && pass!='' && id!='')
 {
  
  $.ajax
  ({
  dataType:'Json',
  type:'post',
  url:'../blk_validation/blk_validation.php',
  beforeSend: function(){ $('#login').text('Connecting...');},
  
  data:{
   do_login:1,
   id:id,
   user:user,
   password:pass
   
  },
 
  success:function(response) {
 //alert(response);
 id= response.no;
 
   if(id==1)
  {
  
 	$.ajax
  ({
  dataType:'Json',
  type:'post',
  url:'../blk_validation/blk_validation.php',
  beforeSend: function(){ $('#login').text('Connecting...');},

   data:{
   do_login:2,
   user:user,
   password:pass
   
  },
 
  success:function(response) {
 // alert(response);
  
  ids= response.id;
   if(ids==2)
  {	
   window.location.href='../blk_dashboard/blk_dashboard.php';
  }
   else
  {
	$('#login').text('Login...');
	$('#errormsg').text('User Id Or Password  Wrong..!');
	$('#errormsg').show();
	setTimeout(function() { $('#errormsg').hide(); }, 2000);
	$('#userid').focus();
	window.location.href='../blk_cloud_login/blk_cloud_login.php';
  }
  }
  });
  }
  
  else
  {
	$('#login').text('Login...');
	$('#errormsg').text('Account Id Not Valid..!');
	$('#errormsg').show();
	setTimeout(function() { $('#errormsg').hide(); }, 2000);
	$('#accountid').focus();
  }
  }
  });
  
  }

 else
 {
	$('#login').text('Login...');
	$('#errormsg').text('Invalid Login Credentials..!');
	$('#errormsg').show();
	setTimeout(function() { $('#errormsg').hide(); }, 3000);
	$('#accountid').focus();
	return false;
 }

 return false;
}
</script>
</head>
<body>
<div id='clud'></div>

<!--start respberry pos login form code-->
<div id='login-page' class='row animated zoomInUp'>
    <div class='col s12 z-depth-6 card-panel'>
                        <form class='login-form right-alert' method='post' id='login_form' name='login_form' onsubmit='return do_login();'>
            <div class='row head'>
                <div class='input-field col s12 center'>

                    <img src='assets/images/skylogo.png' alt='' class='responsive-img valign profile-image-login'>

                   <!-- <p class='center login-form-text'>Login</p>-->
                </div>
            </div>
			".$inctype."
            <div class='row margin'>
                <div class='input-field col s12'>
                    <i class='material-icons prefix'>perm_identity</i>
                    <input class='validate userids' id='userid' type='text' name='userid' autocomplete='off'>
                    <p style='display: none;' id='nameerrormsg'>Enter Valid User ID</p>
                    <label for='userid' data-error='Please Enter User Name' data-success=''>User Name</label>
                </div>
            </div>
            <div class='row margin'>
                <div class='input-field col s12'>
                    <i class='material-icons prefix'>verified_user</i>
                    <input class='validate password' id='password' name='password' type='password' >
                    <p style='display: none;' id='pwderrormsg'>Enter Valid Password</p>
                    <label for='password' data-error='Please Enter Password' data-success=''>Password</label>
                </div>
            </div>
            <p style='display: none;' id='errormsg'>Invalid Login Credentials..!</p>
            <div class='row lastrow'>
                <div class='input-field col s12'>
                    <button type='submit' id='login' name='login' class='btn waves-effect waves-light col s12'>Login</button>
                </div>
            </div>

            <div class='row footer'>
                <div class='input-field col s12'>
                    <p class='margin medium-small lnkcntr'>Powered by &copy;<a href='https://skyhms.in'> SkyHMS</a></p>
                </div>
            </div>
        </form>
                    </div>
	
</div>


<script type='text/javascript' src='assets/js/jquery-1.11.2.min.js'></script>
<script type='text/javascript' src='assets/js/myscript.js'></script>

</body>
</html>";
?>