<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);


?>
<!DOCTYPE html>
<!-- saved from url=(0045)http://thedw.azurewebsites.net/email_link.php -->
<html><head><meta charset="utf-8">

<title>Reset Password</title>
<link href="../style-css/Styles_login.css" rel="stylesheet">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> 
	


<?php
Include '../config/database_conn.php';
$serv_name = $_SERVER['SERVER_NAME'];	




$error="";
$expdate=""; 
$Result1="";
$OTP="";
$email="";
$sq1="";
$row="";
$pass1="";
$OTP1="";


  
  //if (isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $email1 = $_SESSION["email"] ;
  //$email1 = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $sqlerrorcheck = "SELECT count(*) AS [ErrorCount] FROM admin.OTP_expire WHERE EMail = '".$email1."' and expire = 0"; 
  $sq1 = "SELECT [Created_At] FROM admin.OTP_expire WHERE EMail = '".$email1."' and expire = 0" ; 
  $sqlerrorquery = sqlsrv_query($objCon,$sqlerrorcheck);
  $row6 = sqlsrv_fetch_array($sqlerrorquery,SQLSRV_FETCH_ASSOC);
  $exp6 = $row6['ErrorCount'];
  if ($exp6 === 0){
	$error .='<p>An invalid OTP is generated. Please follow the reset password option below again.</p>
	<br /><a href="https://".$serv_name."/Admin/check_email.php">Click here to reset password</a>';}
	if($error!=""){
		
	   echo "<div class='error'>".$error."</div><br />";
   
	   
      }else{
 
	
  $query1 = sqlsrv_query($objCon,$sq1);
  $row9 = sqlsrv_fetch_array($query1,SQLSRV_FETCH_ASSOC);
  $expdate = $row9['Created_At']->format('Y-m-d H:i:s');
  //echo $expdate;}
  //$Result1 = $query1('expdate')
 //print $Result1;

   //$expDate = $query1['expDate'];

   //echo $query1;
     
  if ($expdate >= $curDate){
  ?>

</head>
<script src="https://kit.fontawesome.com/a012f76b8f.js" crossorigin="anonymous"></script>
<style type="text/css">
	.login {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%,-50%);
    background-color: #e5f9ff;
    width: 300px;
    height: 500px;
    border-radius: 30px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#msgforotp{
	color: darkgrey;
	font-size: 11px;
	font-weight: bold;
}

#errorsmsg {
	color: #007197;
	font-size: 11px;
	font-weight: bold;
}
.btn_reset_pass {
    position: absolute;
    left: 24%;
    border-radius: 25px;
    height: 30px;
    width: 150px;
    border: none;
    background-color: #007197;
    color: white;
    outline: none;
    text-align: center;
    padding: 5px;
    text-decoration: none;
}
.error {
	text-align: center;
	color: #007197;
	font-size: 15px;
	font-weight: bold;
}
</style>
<body>
<div class="login">	
	<div class="password_reset">
	<br>
		<img src="../site-images/logo_150px.png" style="width:200px;height:70px;" alt="fetola">
		<hr>
		<form action="Reset-Password.php" method="post">
          <br />
              <form method="post" action="" name="update">
             <input type="hidden" name="action" value="update" />
             <br />
             <div id="msgforotp">
             <i class='fas fa-exclamation-circle'></i> Copy & Paste has been disabled on OTP
             </div><br />  
			 <input type="text" class = "pass_reset" id = "otp_pass" placeholder = "Enter OTP" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" name="otp1" maxlength="6" required />
             <br /><br />
             <input type="password" class = "pass_reset" id = "new_pass" placeholder = "Enter New Password" name="pass1" maxlength="15"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
             <br /><br />
             <input type="password" class = "pass_reset" id = "re_new_pass" placeholder = "Re-Enter New Password" name="pass2" maxlength="15" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
             <br /><br />
             <input type="hidden" name="email" value="<?php echo $email1;?>"/>
			 <input type="submit" class="btn_reset_pass" value="Update"  style="visibility: hidden;" id="SubmitPWChange" />
              <br /><div id="errorsmsg" class="well"><br />     <script type="text/javascript" src="../js-script/jquery.password-validation.js"></script>
          
          </form>
        
              
     </div>
  </div>
      <script>
        $(document).ready(function() {
          $("#new_pass").passwordValidation({"confirmField": "#re_new_pass"}, function(element, valid, match, failedCases) {

              $("#errorsmsg").html("<div>" + failedCases.join("\n") + "</div>");
            
               if(valid) $(element).css("border","2px solid #799900");
               if(!valid) $(element).css("border","2px solid #007197");
               if(valid && match) $("#re_new_pass").css("border","2px solid #799900");
               if(valid && match) $("#SubmitPWChange").css("visibility","visible");
               if(!valid || !match) $("#re_new_pass").css("border","2px solid #007197");
               if(!valid || !match) $("#SubmitPWChange").css("visibility","hidden");
          });
        });
      </script> 
 <?php
 
}else{
	
$error .='<p>The OTP Code expired. Please rerun the process?</p>
<br /><a href="https://".$serv_name."/Admin/check_email.php">Go Back</a>';}

if($error!=""){
  echo "<div class='error'>".$error."</div><br />";}

if(isset($_POST["email"]) && isset($_POST["action"]) &&
($_POST["action"]=="update")){
$error="";
$OTP1 = $_POST["otp1"];
$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];
$email1 = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
$OTPC = "SELECT count(*) AS [ErrorCount] FROM admin.OTP_expire where OTP = '".$OTP1."'";
$queryc = sqlsrv_query($objCon,$OTPC);
$rowAgain = sqlsrv_fetch_array($queryc,SQLSRV_FETCH_ASSOC);
$rowc = $rowAgain['ErrorCount'];
if ($rowc === 0){
	echo '<div class="error"><p>An invalid OTP code entered. Please re-enter the Code or follow the reset password option below.</p>
    <br /><a href="https://"'.$serv_name.'"/Admin/check_email.php">Click here</a> to Login.</p></div><br />';
} else {
  	$pass1 = ($pass1);
sqlsrv_query($objCon,
"UPDATE participant.admin SET pwd_participant ='".$pass1."'
WHERE str_participant_Email ='".$email1."'");
 
sqlsrv_query($objCon,"Update admin.OTP_expire set expire = 1 WHERE OTP='".$OTP1."'");
echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="https://'.$serv_name.'">Click here</a> to Login.</p></div><br />';
   } 
}
}
?>
</body>
</html>