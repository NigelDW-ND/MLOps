<?php

if (isset($_POST["reset-password-submit"])){
	
	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$passRepeat = $_POST["pwd-repeat"];
	
	if (empty($password) || empty($passRepeat)){
		header("Location: ../reset_password.php?newpwd=empty");
			exit();
	}else if($password != $pwdRepeat){
	header("Location: ../reset_password.php?newpwd=notmatch");
	exit();
}
	$currentDate = date("U");
	
	require();// bd connector
	
	$sql = "SELECT * FROM __ WHERE __=? And __ pwd >=?";
	
	$statement = mysqli_stmt_init() //$conn   
    if (!mysqli_stmt_prepare($statment,$sql)) {
		echo("error");
	}else {
	   mysqli_stmt_bind_param($statement, "s" , $selector,  $currentDate);
	   mysqli_stmt_execute($statement);
		
	   $result = mtsqli_stmt_get_result($statement);
	   if (!$row = mysqli_fetch_assoc($result)){
		   echo("Please re-submit your reset request.");
		   exit();
	   }else{
		   
		   $tokenBin = hex2bin($validator);
		   $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);//change
		   
		   if ($tokenCheck === false){
			   echo("Please re-submit your reset request.")
			exit();	   
		   }else if ($tokenCheck === true){
			   
			   $tokenEmail = $row['pwdResetEmail'];//change
			   $sql = "SELECT * FROM __ WHERE __=?;";
			   $statement = mysqli_stmt_init($conn);//connection
			   if (!mysqli_stmt_prepare($statement,$sql)){
				   echo("There was an error");
				   exit();
			   }else{
				   mysqli_stmt_bind_param($statement,"s",$tokenEmail);
				   mysqli_stmt_execute($statement);
				   $result = mysqli_stmt_get_result($statement);
				   
				   if(!$row = mysqli_fetch_assoc($result)){
					   echo("There was an error.");
					   exit();
				   }else{
					 
					   $sql = "UPDATE _ SET _=? WHERE _=?";
					   $statement = mysqli_stmt_init($conn);//connection
			   			if (!mysqli_stmt_prepare($statement,$sql)){
				   			echo("There was an error");
							exit();
			   			}else{
							$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($statement,"ss",$newPwdHash,$tokenEmail);
							mysqli_stmt_execute($statement);
							
							$sql = "DELETE FROM _pwdReset_ WHERE _pwdResetEmail_ =?; ";
							$statement = mysqli_stmt_init() //$conn   
							if (!mysqli_stmt_prepare($statment,$sql)) {
								echo("error");
							}else {
							   mysqli_stmt_bind_param($statement, "s" , $tokenEmail);
							   mysqli_stmt_execute($statement);
							   header("Location: ../index.php?newpwd=passwordupdated")

	}
					   
					   
				   }
				   
				   
			   }
			   
		   }
	   }	
	   
	}
	
	}else{
	header("Location: ../reset_password.php?newpwd=notmatch");
	exit();
	
}

?>