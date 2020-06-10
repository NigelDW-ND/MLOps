<?php
ini_set('display_errors', 1);
error_reporting(~0);
include('../config/database_conn.php');
include('../config/mail_conn.php');
  session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fetola Registration</title>
<link href="../style-css/Styles_Register.css" rel="stylesheet">	
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> 
</head>
<body>
  <div class="reset_password">  
    <div class="email_reset">
      <img src="../site-images/fnb_logos.png" style="width:440px;height:85px;display: block; margin-left: auto; margin-right: auto; width: 50%;" alt="fetola">
      <hr>   
    <?
    if(!(isset($_SESSION["reqset"]))){
    echo "Hello World";
    }elseif(isset($_SESSION["reqset"])){
    echo "Hello You";
    }
    ?>
     </div>
  </div>
</body>
</html>