<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
<link href="Styles.css" rel="stylesheet">	
</head>

<body>
	
<div class="reset_password">	
	<div class="email_reset">
		<br>
		<img src="site-images/logo_150px.png" style="width:200px;height:75px; position: relative; left:30%" alt="fetola">
		<hr>
		
		<p id="msg_email">An e-mail will be sent to you with instructions on how to reset your password.</p>
		
		<form action="includes/reset-request.php" method="post">
		<input type="text" name="email" class="user_email" id="user_email" placeholder="Enter your e-mail address" required>
		<br><br>
		<input type="submit" name="reset-request-submit" class="btn_user_email" id="btn_user_email" value="Receive New Password By e-mail">
		</form>
		
		<?php
		
		if (isset($_GET["reset"])){
			if ($_GET["reset"] == "sucess"){
				echo('<p class="emailsuccess">Check your e-mail</p>');
			}
		}	
		
		?>
		
	</div>
</div>
	
</body>
</html>