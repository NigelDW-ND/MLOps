<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = 'smtp.office365.com';
$mail->SMTPAuth   = true; 
$mail->Username   = 'No-Reply@fetola.co.za';
$mail->Password   = 'P@55w0rd#$'; 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
$mail->Port       = 587;   

?>