<?php
	include('./config/database_conn.php');
	session_start();

?>
<html>
<head>
<meta charset="utf-8">
<title>Welcome To Fetola</title>
<link href="../style-css/Styles.css" rel="stylesheet">
<script>
    $(document).ready(function(){
        $("#ConfirmPassword").keyup(function(){
             if ($("#Password").val() != $("#ConfirmPassword").val()) {
                 $("#msg").html("Password do not match").css("color","red");
             }else{
                 $("#msg").html("Password matched").css("color","green");
            }
      });
});
</script> 	
</head>	
<body>
	
<div class="login">	
	<div class="login_form">
		<br>
		<img src="../site-images/logo_150px.png" style="width:200px;height:75px;" alt="fetola">


	<h4>Create your password.</h4>

<form method="post" action="register.php">
	
		<label>Email</label><br><br>
	
	
		<input type="password" id="Password" class="login_password" name="Password" placeholder="Password">
		 <br><br>

		<input type="password" id="ConfirmPassword" class="login_password" name="ConfirmPassword"  placeholder="Confirm password">
		<br><br>

		<input type="submit"  class="login_submit" name="register_btn" text="Save">
		<div id="msg"></div>

		</form>
<br>
	</div>
</div>	

</body>
</html>


