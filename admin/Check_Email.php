<?php
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
<link href="../style-css/Styles_login.css" rel="stylesheet">	
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> 
</head>
<body>
   
   <div class="reset_password">  
      <div class="email_reset">
         <br>
         <img src="../site-images/logo_150px.png" style="width:200px;height:75px; position: relative; left:30%" alt="fetola">
         <hr>

<?php 
Include '../config/database_conn.php';
$serv_name = $_SERVER['SERVER_NAME'];

	

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
   <p><a href="https://".$serv_name."/admin/check_email.php">Click here</a> to Reset your password again.</p></div><br />';
     }else{
   $sel_query = "SELECT * FROM participant.admin WHERE str_participant_Email = '".$email1."'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $results = sqlsrv_query($objCon,$sel_query,$params,$options);
   $row = sqlsrv_num_rows($results);
   if ($row==""){
   echo '<div class="error"><p>No user is registered with this email address!. Please follow the registration process in order to register your email address ?.</p>
     <p><a href="https://".$serv_name."/Fetola_Login.html">Click here</a> to Login.</p></div><br />';
     }else{
    if($error!=""){
   echo "<div class='error'>".$error."</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
   }else{
   $otp = rand(100000, 999999);
   $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
   $expDate = date("Y-m-d H:i:s",$expFormat);
   // Insert Temp Table
$sql = "INSERT INTO admin.OTP_Expire (OTP, Email, Expire, [Created_At])
VALUES ('".$otp."', '".$email1."', '0', '".$expDate."')";
   
   if (sqlsrv_query($objCon, $sql)) {
      echo "";
   }else {
      die( print_r( sqlsrv_errors(), true));;
   }
   $sel_query1 = "SELECT * FROM admin.otp_expire WHERE EMail = '".$email1."'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $results1 = sqlsrv_query($objCon,$sel_query1,$params,$options);
   $row1 = sqlsrv_num_rows($results1);
  if ($row1!=""){
        
?>
   <p>An email has been submitted to you with your OTP Code.</p>
  <a href="reset-password.php">Click here to complete the process</a></p>        
   <?php 
      }else{
         die( print_r( sqlsrv_errors(), true));//echo "Error: " . $sel_query1 . "<br>" . sqlsrv_errors($objCon);
         "<br /><a href='javascript:history.go(-1)'>Go Back</a>";}
        
         
   
 // Set content-type header for sending HTML email 
 $headers = "MIME-Version: 1.0" . "\r\n"; 
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
  
 // Additional headers 
 $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 


$subject = "Password Recovery - OTP Code - Fetola Portal";
$Message = "<html> <head>";
$Message .= "<meta charset='utf-8>'";
$Message .= "<title></title>";
$Message .= "<style> Colour palette: Blue: #007197 Green: #799900 pastle blue : #e5f9ff; Font: font-family: Corbel; *{font-family: Corbel;} table{align:centre; border-collapse: collapse; border: none; }	#email-header{ align:center; padding: 30px 130px 30px 130px; } #email-body{border-collapse: collapse; border: none; text-align: center; } #graphic{padding: 0 130px 0 130px; } button{border: none; border-radius: 15px; background-color: #007197 ; color: white; height: 30px; width: 200px; outline: none; } button:hover{ cursor: pointer; color: white; background-color: #799900; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); } </style>";
$Message .= "</head>";
$Message .= "<body>";
$Message .= "<table align='center' border='none' cellpadding='0' cellspacing='0' width='600'>";
$Message .= "<tr>";
$Message .= "<td>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "<tr>";
$Message .= "<td  bgcolor='#ffffff' style='padding: 0px 30px 40px 30px;'>";
$Message .= "<table id='email-body'  cellpadding='0' cellspacing='0'  width='100%'>";
$Message .= "<tr>";
$Message .= "<td>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "<tr>";
$Message .= "<td style='padding: 0px 0 30px 0;'>";
$Message .= "<p style='font-size: 2em'>Trouble signing in?</p>";
$Message .= "<p>Your OTP Code provided by Fetola is : $otp.</p>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "<tr>";
$Message .= "<td>";
$Message .= "<p style='font-size:12px;'> If you have not requested a password reset, please ignore this email.</p>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "</table>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "<tr>";
$Message .= "<td id='email-footer' bgcolor='#e5f9ff'>";
$Message .= "<p></p>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "</table>";
$Message .= "</body>";
$Message .= "</html>";

$body = $Message;
$email_to = $email1;
$fromserver = "smtp.office365.com"; 
//include 'mail_conn.php';

//$mail = new PHPMailer(true);
//$mail->IsSMTP();
//$mail->Host = "smtp.office365.com"; // Enter your host here
//$mail->SMTPAuth = true;
//$mail->Username = "No-Reply@fetola.co.za"; // Enter your email here
//$mail->Password = "P@55w0rd#$'"; //Enter your password here
//$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = "No-Reply@fetola.co.za";
$mail->FromName = "Fetola";
$mail->Sender = "No-Reply@fetola.co.za"; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $Message;
$mail->AddAddress($email_to);
}if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}}}}else{

   
   ?>
        	
<div class="reset_password">	
	<div class="email_reset">
		<br>
		<img src="../site-images/logo_150px.png" style="width:200px;height:75px; position: relative; left:30%" alt="fetola">
		<hr>
		<form action="check_email.php" method="post">
		<p id="msg_email">An e-mail will be sent to you with instructions on how to reset you password.</p>
		<input type="text" class="user_email" id="user_email" name="email" placeholder="Enter your e-mail address" required>
		<br><br>
		<input type="submit" class="btn_user_email" id="btn_user_email" value="Reset Password">
	</form>
	</div>
</div>
	
   <?php } ?>

   </body>
</html>