
<?php
    ini_set('display_errors', 1);
    error_reporting(~0);
	session_start();
	include('config/database_conn.php');
    use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = 'smtp.office365.com';
$mail->SMTPAuth   = true; 
$mail->Username   = 'No-Reply@fetola.co.za';
$mail->Password   = 'P@55w0rd#$'; 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
$mail->Port       = 587;   
    
try {
    $mail->setFrom('No-Reply@fetola.co.za', 'Mailer');
    $mail->addAddress('nigel@thedw.co.za', 'Joe User');     
    $mail->addReplyTo('No-Reply@fetola.co.za', 'Information');
    $mail->isHTML(true);                                  
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
