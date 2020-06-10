<?php
ini_set('display_errors', 1);
error_reporting(~0);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fetola Registration</title>
	
<link href="reg-style.css" rel="stylesheet">	
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> 
</head>
<body>
   

<?php 
Include '../config/database_conn.php';

	

$error="";
$email1="";
$headers="";
$fromName="";
$from="";
$expdate="";
$sql="";
$Body="";
$row1="";
$OQuery="";
$otp="";
$ch="";
$row="";

include '../config/mail_conn.php';



if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email1 =  $_POST["email"];
$_SESSION["email"] = $email1;
$email1 = filter_var($email1, FILTER_SANITIZE_EMAIL);
$email1 = filter_var($email1, FILTER_VALIDATE_EMAIL);
if (!$email1) {
   echo '<div class="error"><p>Invalid email address please type a valid email address!</p>
   <p><a href="https://localhost/Fetola%20Project/admin/users/check_email.php">Click here</a> to Reset your password again.</p></div><br />';
     }else{
   $sel_query = "SELECT * FROM participant.admin WHERE str_participant_Email = '".$email1."'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $results = sqlsrv_query($objCon,$sel_query,$params,$options);
   $row = sqlsrv_num_rows($results);
   if ($row==""){
   echo '<div class="error"><p>No user is registered with this email address!. Please follow the registration process in order to register your email address ?.</p>
     <p><a href="https://localhost/Fetola%20Project/Fetola_Login.html">Click here</a> to Login.</p></div><br />';
     }else{
    
   $sel_query1 = "SELECT * FROM admin.otp_expire WHERE EMail = '".$email1."'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $results1 = sqlsrv_query($objCon,$sel_query1,$params,$options);
   $row1 = sqlsrv_num_rows($results1);
     if ($row1!=""){
        
?>
   <p>Welcome !!! Your email is registered on the database.</p>
  <a href="https://localhost/Fetola%20Project/Register/registrationp1.php">Click here to complete the process</a></p>        
   <?php 
      }else{
         die( print_r( sqlsrv_errors(), true));//echo "Error: " . $sel_query1 . "<br>" . sqlsrv_errors($objCon);
         "<br /><a href='javascript:history.go(-1)'>Go Back</a>";}
    
}}}else{
 
   ?>
        	
<div class="reset_password">	
	<div class="email_reset ">
		
		
		<img src="logos.png" style="width:550px ; position:relative;left: 18%"  alt="fetola">
		<hr>
		<form action="https://localhost/Fetola%nj/Register/regstart.php" method="post">
		<h1 style="width:550px ; position:relative;left: 20%">Welcome to the Mentor Hotline!</h1>	
		<p id="msg_email" style="text-align: center; position: relative; left: 1%">This is your space to reach out and get the support you need. Please enter your email address to proceed with registration.</p>

		<input type="text" class="user_email" id="user_email" name="email" placeholder="Enter your e-mail address" required>
      <br><br>
     
		<input type="submit" class="btn_user_email" id="btn_user_email" value="Register">
	</form>
	</div>
</div>
	
   <?php } ?>

   </body>
</html>