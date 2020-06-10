<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
Include '../config/database_conn.php';
include '../config/mail_conn.php';
$serv_name = $_SERVER['SERVER_NAME'];	


if (isset($_GET['submit'])) {
$FirstName	= $GET['FirstName'];
$Contact = $GET['Contact'];
$BusName = $GET['Bus_Name'];
$Title	= $GET['Title'];
$Gender = $GET['Gender'];
$Address = $GET['Address'];
$Province =$GET['Province'];
$Bee_score = $GET['Bee_score'];
$Annual_Revenue = $GET['Annual_Revenue'];
$Business_Age = $GET['Business_Age'];
$Employee_Count = $GET['Employee_Count'];
$Industry = $GET['Industry'];
$Coregistration = $GET['Coregistration'];
$pass1 = $_POST["password1"];
$pass2 = $_POST["password2"];
$email1 = $_POST["email"];


var_dump($email1);

sqlsrv_query($objcon,
 "UPDATE participant.admin 
 SET pwd_participant ='".$pass1."', a.str_participant_Name = '".$FirstName."', a.str_participant_Contact = '".$Contact."'
 WHERE str_participant_Email ='".$email1."'");

sqlsrv_query($objcon,
"UPDATE import.TP_Status_Info 
SET Bus_Name = '".$BusName."', Title = '".$Title."', Gender = '".$Title."', [Address] = '".$Address."', Prov = '".$Province."'
inner join participant.admin  on  import.TP_Status_Info.Business_GUID = participant.admin.id_participant_GUID 
inner join support.CompanyDet  on import.TP_Status_Info.int_ID_Status = support.CompanyDet.Businessdet_ID
WHERE participant.admin.str_participant_Email ='".$email1."'");

sqlsrv_query($objcon,
"UPDATE support.CompanyDet 
SET Bee_score = '".$Bee_score."', Annual_Revenue = '".$Annual_Revenue."', Business_Age = '".$Business_Age."', Employee_Count = '".$Employee_Count."', Industry = '".$Industry."', CoRegistration = '".$Coregistration."'
inner join support.CompanyDet  on import.TP_Status_Info.int_ID_Status = support.CompanyDet.Businessdet_ID
inner join participant.admin  on  import.TP_Status_Info.Business_GUID = participant.admin.id_participant_GUID
WHERE participant.admin.str_participant_Email ='".$email1."'");

echo "Registration completed successfully !!";


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 


$subject = "Welcome to the Fetola Portal";
$Message = "<html> <head>";
$Message .= "<meta charset='utf-8>'";
$Message .= "<title>Welcome to Fetola</title>";
$Message .= "<style> Colour palette: Blue: #007197 Green: #799900 pastle blue : #e5f9ff; Font: font-family: Corbel; *{font-family: Corbel;} table{align:centre; border-collapse: collapse; border: none; }	#email-header{ align:center; padding: 30px 130px 30px 130px; } #email-body{border-collapse: collapse; border: none; text-align: center; } #graphic{padding: 0 130px 0 130px; } button{border: none; border-radius: 15px; background-color: #007197 ; color: white; height: 30px; width: 200px; outline: none; } button:hover{ cursor: pointer; color: white; background-color: #799900; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); } </style>";
$Message .= "</head>";
$Message .= "<body>";
$Message .= "<table align='Left' border='none' cellpadding='0' cellspacing='0' width='600'>";
$Message .= "<td style='padding: 0px 0 30px 0;'>";
$Message .= "<p>Well done and thank you for opting in, let’s start the process to get your business the support it needs. </p>";
$Message .= "</td>";
$Message .= "</tr>";
$Message .= "<tr>";
$Message .= "<td>";
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
}