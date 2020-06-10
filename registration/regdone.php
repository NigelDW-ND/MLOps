<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
  session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome To Fetola Registration</title>
<link href="../style-css/registerstyle.css" rel="stylesheet">	
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> 
</head>	
<body>


    <?php
Include('../config/database_conn.php');
include('../config/mail_conn.php');
$serv_name = $_SERVER['SERVER_NAME'];	


if (isset($_POST['Firstname'])) {
$FirstName	= $_POST['Firstname'];
$Contact = $_POST['contactnumber'];
$Title	= $_POST['Title'];
$Gender = $_POST['Gender'];
$Address = $_POST['Address'];
$Province =$_POST['Province'];
$Bee_score = $_POST['Beescore'];
$Annual_Revenue = $_POST['Annualrev'];
$Business_Age = $_POST['Companyage'];
$Employee_Count = $_POST['Headcount'];
$Industry = $_POST['Industry'];
$Coregistration = $_POST['CompanyRegistrationNumber'];
$pass1 = $_POST["password1"];
$pass2 = $_POST["password2"];
$email1 = $_SESSION["email"];


		$GETstatSQL = "EXEC support.spr_update_fnb_business '".$FirstName."','".$Contact."','".$Title."','".$Gender."','".$Address."','".$Province."','".$Bee_score."','".$Annual_Revenue."','".$Business_Age."','".$Employee_Count."','".$Industry."','".$Coregistration."','".$pass1."','".$email1."';";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);




// Set content-type header for sending HTML email 
// Set content-type header for sending HTML email 
 $headers = "MIME-Version: 1.0" . "\r\n"; 
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
  
 // Additional headers 
 $headers .= 'From: '.$FirstName.'<'.$email1.'>' . "\r\n"; 


$subject = "Your Fetola Mentor Support Account Was Successfully Created.";
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
$Message .= "<p style='font-size: 2em'>Welcome to the Mentor Hotline program!</p>";
$Message .= "<p>Please login at the link below.</p>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "<tr>";
$Message .= "<td>";
$Message .= "<p style='font-size:12px;'>You can now login to the Mentor Hotline at https://portal.fetola.co.za/</p>";
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
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}
header("Location: ../?message=4"); 
}