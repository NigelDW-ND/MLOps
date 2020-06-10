<?php
	include('config/database_conn.php');
	session_unset();
	session_start();
	$username=$_POST['txtUsername'];
	$password=$_POST['txtPassword'];
	
	if (!(isset($_POST['RememberMe']))){
				//set up cookie
				setcookie("username", "", time() + (86400 * 30)); 
				setcookie("password", "", time() + (86400 * 30)); 
		}

	ini_set('display_errors', 0);
	error_reporting(~0);

	$strSQL = "SELECT * FROM mentor.admin WHERE lgn_Username=? and pwd_Password=?";
	$parameters = [$_POST["txtUsername"], $_POST["txtPassword"]];
	$objQuery = sqlsrv_query($objCon, $strSQL, $parameters);
	$objResult = sqlsrv_fetch_array($objQuery,SQLSRV_FETCH_ASSOC);
	
	if(!$objResult)
	{
			$partstrSQL = "SELECT * FROM participant.admin WHERE str_participant_Email=? and pwd_participant=?";
			$partparameters = [$_POST["txtUsername"], $_POST["txtPassword"]];
			$partobjQuery = sqlsrv_query($objCon, $partstrSQL, $partparameters);
			$partobjResult = sqlsrv_fetch_array($partobjQuery,SQLSRV_FETCH_ASSOC);
			if($partobjResult["bt_accepted"] == "yes" and $partobjResult["bt_account_type"] == 1 and strcmp($_POST["txtPassword"],$partobjResult["pwd_participant"]) == 0)
			{
							$timezone = new DateTimeZone("UTC");
							$date = new DateTime("now", $timezone);
							$date = $date->format("Y-m-d\TH:i:s");
							$sql = "UPDATE participant.admin SET dt_last_login=? where int_participant_ID=?";
							$params = array("$date", $objResult["int_participant_ID"]);
							$stmt = sqlsrv_query( $objCon, $sql, $params);
							if( $stmt === false ) {
								 die( print_r( sqlsrv_errors(), true));
							}
				$_SESSION["UserID"] = $partobjResult["int_participant_ID"];
				$_SESSION["RollNum"] = 21;
				if(!($partobjResult["bt_TermConditions"] == 'yes')){
					header("location:lite/TermsConditions.php");
				}else{
					header("location:lite/Profile.php");
				}
				
			}
				elseif($partobjResult["bt_accepted"] == "yes" and $partobjResult["bt_account_type"] == 0 and strcmp($_POST["txtPassword"],$partobjResult["pwd_participant"]) == 0)
			{
							$timezone = new DateTimeZone("UTC");
							$date = new DateTime("now", $timezone);
							$date = $date->format("Y-m-d\TH:i:s");
							$sql = "UPDATE participant.admin SET dt_last_login=? where int_participant_ID=?";
							$params = array("$date", $objResult["int_participant_ID"]);
							$stmt = sqlsrv_query( $objCon, $sql, $params);
							if( $stmt === false ) {
								 die( print_r( sqlsrv_errors(), true));
							}				
				$_SESSION["UserID"] = $partobjResult["int_participant_ID"];
				$_SESSION["RollNum"] = 20;
				header("location:participant_page.php");
			}
				else
			{
				header("Location: index.php?message=1", true, 301);
			}
	}
	else
	{
			$timezone = new DateTimeZone("UTC");
			$date = new DateTime("now", $timezone);
			$date = $date->format("Y-m-d\TH:i:s");
			$sql = "UPDATE mentor.admin SET dt_last_login=? where int_Mentor_ID=?";
			$params = array("$date", $objResult["int_Mentor_ID"]);

			$stmt = sqlsrv_query( $objCon, $sql, $params);
			if( $stmt === false ) {
				 die( print_r( sqlsrv_errors(), true));
			}

			if($objResult["access_level"] == 1 and $objResult["active"] == true and strcmp($_POST["txtPassword"],$objResult["pwd_Password"]) == 0)
			{			
				if ((isset($_POST['RememberMe']))){
				//set up cookie
				setcookie("username", $username, time() + (86400 * 30)); 
				setcookie("password", $password, time() + (86400 * 30)); 
				}
				$_SESSION["UserID"] = $objResult["int_Mentor_ID"];
				$_SESSION["RollNum"] = $objResult["RollID"];
			    $_SESSION["Status"] = $objResult["access_level"];
			    $_SESSION["UserEmail"] = $objResult["str_Mentor_Email"];
			    $_SESSION["UserName"] = $objResult["str_Mentor_Name"];
				header("location:Selections/Overview_page.php");
			}
			elseif($objResult["access_level"] == 5 and $objResult["active"] == true and strcmp($_POST["txtPassword"],$objResult["pwd_Password"]) == 0)
			{			
				if ((isset($_POST['RememberMe']))){
				//set up cookie
				setcookie("username", $username, time() + (86400 * 30)); 
				setcookie("password", $password, time() + (86400 * 30)); 
				}
				$_SESSION["UserID"] = $objResult["int_Mentor_ID"];
				$_SESSION["RollNum"] = $objResult["RollID"];
			    $_SESSION["Status"] = $objResult["access_level"];
			    $_SESSION["UserEmail"] = $objResult["str_Mentor_Email"];
			    $_SESSION["UserName"] = $objResult["str_Mentor_Name"];
				header("location:mentorqueries/profile.php");
			}
			elseif($objResult["access_level"] == 0 and $objResult["active"] == true and strcmp($_POST["txtPassword"],$objResult["pwd_Password"]) == 0)
			{			
				if ((isset($_POST['RememberMe']))){
				//set up cookie
				setcookie("username", $username, time() + (86400 * 30)); 
				setcookie("password", $password, time() + (86400 * 30)); 
				}
				$_SESSION["UserID"] = $objResult["int_Mentor_ID"];
				$_SESSION["RollNum"] = $objResult["RollID"];
			    $_SESSION["Status"] = $objResult["access_level"];
			    $_SESSION["UserEmail"] = $objResult["str_Mentor_Email"];
			    $_SESSION["UserName"] = $objResult["str_Mentor_Name"];
				header("location:mentors/Home.php");
			}elseif($objResult["access_level"] == 2 and $objResult["active"] == true and strcmp($_POST["txtPassword"],$objResult["pwd_Password"]) == 0)
			{			
				if ((isset($_POST['RememberMe']))){
				//set up cookie
				setcookie("username", $username, time() + (86400 * 30)); 
				setcookie("password", $password, time() + (86400 * 30)); 
				}
				$_SESSION["UserID"] = $objResult["int_Mentor_ID"];
				$_SESSION["RollNum"] = $objResult["RollID"];
			    $_SESSION["Status"] = $objResult["access_level"];
			    $_SESSION["UserEmail"] = $objResult["str_Mentor_Email"];
			    $_SESSION["UserName"] = $objResult["str_Mentor_Name"];
				header("location:admin/admin.php");
			}else
			{
				header("Location: index.php?message=3", true, 301);
			}
	}
	sqlsrv_close($objCon);
	
?>