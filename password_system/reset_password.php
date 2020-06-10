<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset password</title>
<link href="Styles.css" rel="stylesheet">
<style>	
	#toggle{
		position: absolute;
		top:39.2%;
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
	
	#toggle2{
		position: absolute;
		top:52.5%;
		left: 75%;
		transform: translate(-50%);
		width: 20px;
		height: 20px;
		background: url("site-images/visibility_icons/hide.png");
		background-size: cover;
		cursor: pointer;
	}
	
	#toggle2.hide{
		background: url("site-images/visibility_icons/show.png");
		background-size:cover; 
	}
	
	#message {
   
    background: #f1f1f1;
    color: #000;
    position: relative;
	top:70%;	
    padding:10px 20px;
	width:90%;
	margin:auto;
	margin-top:-20px;
	border-radius: 	15px;
	}
	
	#message p {
		padding: 0px 35px;
		font-size: 18px;
	}
	

	
</style>	
	
</head>

<body>

		
<div class="login">	
	<div class="password_reset">
		
		<?php
		
			$selector = $_GET["selector"];
		    $validator = $_GET["validator"];
		
			if (empty($selector) || empty($validator)){
				echo("Could not validate your request");
			}else {
				if (ctype_xdigit($selector) !== false && ctype_xdigit($validator)!== false)
			}
		
		?>
		
		<br>
		<img src="site-images/logo_150px.png" style="width:200px;height:75px;" alt="fetola">
		<hr>
		<br>
		<form action="config/password-reset.php" method="post">
		<input type="hidden" name="selector" value="<?php echo $selector?>">	
		<input type="hidden" name="validator" value="<?php echo $validator?>">	
			
		<input type="password" name="pwd" class="pass_reset" id="new_pass" placeholder="New Password">
		<div id="toggle" onClick="show_hide()"></div>
		<br><br>
		<input type="password" name="pwd-repeat" class="pass_reset" id="re_new_pass" placeholder="Re-enter New Password">
		<div id="toggle2" onClick="show_hide2()"></div>
		<br><br><br>
		<a class="btn_reset_pass" name="reset-password-submit" href="Fetola_login.html" onClick="MatchCheck()">Reset Password</a>
		
	</div>
</div>
	
	<script type="text/javascript">	
	
	const new_pass = document.getElementById('new_pass');
	const re_new_pass = document.getElementById('re_new_pass')
	const toggle = document.getElementById('toggle');
	const toggle2 = document.getElementById('toggle2');
	
		
	// visibility function
		
		
	function show_hide() {
		
		if (new_pass.type === 'password'){
			new_pass.setAttribute('type','text');
			toggle.classList.add('hide');
		}
		else {
			new_pass.setAttribute('type','password');
			toggle.classList.remove('hide');
		}
	}
	function show_hide2() {
		
		if (re_new_pass.type === 'password'){
			re_new_pass.setAttribute('type','text');
			toggle2.classList.add('hide');
		}
		else {
			re_new_pass.setAttribute('type','password');
			toggle2.classList.remove('hide');
		}
	}
	//-----------------------------------------------------------------
		
	//	match check
		
		function MatchCheck(){
		
		 if (new_pass.value == "" || re_new_pass.value == "" ) {
			alert("Please fill out required field.");
			return false ;
		  }
			
		 else if (document.getElementById('new_pass').value ==
			document.getElementById('re_new_pass').value) {
			alert("Password sucessful.")
		  } else {
			alert("Passwords do not match.")
		  }
		}
	
	//-----------------------------------------------------------------	
		
	// Messages-------------------------------------------------------
		
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		
		
	</script>
	
</body>
</html>
