<?php 
	include('../config/database_conn.php');
	$func = $_POST["func"];
	if($func == "getWelcomeVal"){
		$mid = $_POST["mid"];
		$getWelcomeStatSql = "SELECT showWelcome FROM mentor.admin WHERE int_Mentor_ID = '$mid'";
		$getWelcomeStatQuery = sqlsrv_query($objCon, $getWelcomeStatSql);
		$getWelcomeStatRow = sqlsrv_fetch_array($getWelcomeStatQuery, SQLSRV_FETCH_ASSOC);
		$getWelcomeStatVal = $getWelcomeStatRow['showWelcome'];
		echo $getWelcomeStatVal;
	}elseif($func == "disableWelcome"){
		$mid = $_POST["mid"];
		$returnVal = "";
		$updateWelcomeValSQL = "UPDATE mentor.admin SET showWelcome = 'No' WHERE int_Mentor_ID = '$mid'";
		$updateWelcomeValQuery = sqlsrv_query($objCon, $updateWelcomeValSQL);
		if($updateWelcomeValQuery){
			$returnVal .= " Removed welcome status successfully ";
		} else {
			$returnVal .= " Error: " . sqlsrv_errors($objCon);
		}	
		echo $returnVal;
	}
?>