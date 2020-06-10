<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
<link href="style-css/Styles_login.css" rel="stylesheet">
<script type="text/javascript" src="./js-script/jquery-3.5.1.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js-script/email-link.js"></script>

</head>

<body>

<div class="reset_password">
	<div class="email_reset">
		<br>
		<img src="site-images/logo_150px.png" style="width:200px;height:75px; position: relative; left:30%" alt="fetola">
		<hr>

		<p id="msg_email">An e-mail will be sent to you with instructions on how to reset your password.</p>

		<!-- <form action="password_system/reset-request.php" method="post"> -->
		<div>
			<form>
				<input type="email" name="email" class="user_email" id="user_email" placeholder="Enter your e-mail address" required>
				<br><br>
				<input type="submit" name="reset-request-submit" class="btn_user_email" id="btn_user_email" value="Receive New Password By E-mail">
			</form>
		</div>

		<?php

			if (isset($_GET["reset"])){
				if ($_GET["reset"] == "sucess"){
					echo('<p class="emailsuccess">Check your e-mail</p>');
				}
			}

		?>

	</div>
</div>
<?php include("./htmlmodals.php"); ?>
</body>
</html>



