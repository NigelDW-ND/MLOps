<!doctype html>
<?

?>
<html>
<head>
<meta charset="utf-8">
<title>Welcome To Fetola</title>
<link href="style-css/Styles_login.css" rel="stylesheet">
<style>

	#toggle{
		position: absolute;
		top:46%;
		left: 75%;
		transform: translate(-50%);
		width: 20px;
		height: 20px;
		background: url("site-images/visibility_icons/hide.png");
		background-size: cover;
		cursor: pointer;
	}
	
	#toggle.hide{
		background: url("site-images/visibility_icons/show.png");
		background-size:cover; 
	}
</style>	
</head>	
<body>
	<div class="login">	
	<div class="login_form">
		<br>
		<img src="site-images/logo_150px.png" style="width:200px;height:75px;" alt="fetola">
		<br><br>
		<form name="login_form" method="post" action="check_login.php">
		<input type="text" class="login_username" name="txtUsername" placeholder="Username">
		<br><br>
		<input type="Password" class="login_password" name="txtPassword"  id="login_password" placeholder="Password">
		<div id="toggle" onClick="show_hide()"></div>
		<br><br>
		<input type="checkbox" class="login_rem_me" >
		<lable style="font-size:11px;color:#808080; position:relative; top:-6px;">Remember Me</lable>
			<span class="slider"></span>
		<br>
		<br>
		<div style="text-align: center;">
		<lable style="font-size:11px;font-weight: bold;color:#007197; position:relative; top:-10px;">
	  	  <?php
			if(isset($_GET["message"])){
			if($_GET["message"] == "1")
			{
				echo 'Login Credentials not Found!';
			}
			elseif($_GET["message"] == "2")
			{
				echo 'This Business Already Exists in the Campaign!';
			}
			elseif($_GET["message"] == "3")
			{
				echo 'Account InActive, Please contact Administrator!';
			}
			elseif($_GET["message"] == "4")
			{
				echo 'Registration completed successfully !!<br>Please login to continue.';
			}
			elseif($_GET["message"] == "5")
			{
				echo 'Invalid email address. Please type a valid email address!.';
			}
			else
			{
				
			};
		}		
	?></label>
		</div>

		
		<input type="submit" class="login_submit" value="Login">
		
		<br><br>
		<div class="links_regpass">
		<a class="link_fpass" href="admin/check_email.php">Forgot Password?</a>
		<br>
		<a class="link_fpass" href="Registration/regstart.php">Register</a>
	</div>
		</form>	
	</div>
</div>

	<script  type="text/javascript">
	const login_password = document.getElementById('login_password');
	const toggle = document.getElementById('toggle');
	
	
		

		
		
	function show_hide() {
		
		if (login_password.type === 'password'){
			login_password.setAttribute('type','text');
			toggle.classList.add('hide');
		}
		else {
			login_password.setAttribute('type','password');
			toggle.classList.remove('hide');
		}
	}
	</script>

</body>
</html>
