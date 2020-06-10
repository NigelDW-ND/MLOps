<?php

if(isset($_POST["reset-request-submit"])){
	
	// Token generator _____________________________
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);
	
#insert url	
	$url = "   /reset_password.php?selector=" . $selector . "&validator=" .  bin2hex($token);
	
	
	// token expire_________________
	$expire = date("U") + 3600;

	require();// database connection 
	
	$userEmail = $_POST["email"]; // email from 'email link'
		
	//Deleting token >> if one has already been generated within the hour______ 
	$sql = "DELETE FROM _pwdReset_ WHERE _pwdResetEmail_ =?; ";
	$statement = mysqli_stmt_init() //$conn   
    if (!mysqli_stmt_prepare($statment,$sql)) {
		echo("error");
	}else {
	   mysqli_stmt_bind_param($statement, "s" , $userEmail);
	   mysqli_stmt_execute($statement);
	   
	}
	
	$sql = "INSERT INTO _pwdreset_ (_pwdResetEmail_, _pwdResetSelector_, _pwdResetToken_ , _pwdResetExpires_) VALUES (?,?,?,?)"
	$statement = mysqli_stmt_init() //$conn   
    if (!mysqli_stmt_prepare($statment,$sql)) {
		echo("error");
	}else {	
	   $hashedToken = password_hash($token, PASSWORD_DEFAULT);
	   mysqli_stmt_bind_param($statement, "ssss" , $userEmail, $selector, $hashedToken, $expire);
	   mysqli_stmt_execute($statement);
	   
	}
	
	mysqli_stmt_close($statement);
	mysqli_close();//$conn
	
	
	// email recipient
	$recipient = $userEmail;
	
	$subject = 'Fetola password reset';
	
	$msg = '<p>Password reset request.Click on link to reset password</p>';
	$msg .= '<a href=" ' . $url . ' "></a>';	
	
	mail($recipient,$subject,$msg);
	header("Location:../email_link.php?reset=success");
	
}else{
	header("Location: ../index.php");
	
}
 


?>