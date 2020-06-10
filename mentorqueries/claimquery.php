<?php 
	include('../config/database_conn.php');
	
	$mentorID= $_POST['mid'];
	$qid = $_POST['qid'];
		
	$cqSql = "UPDATE support.Queries SET MentorID = '$mentorID', Status = 'New Claim', DateClaimed = getDate() WHERE QueryID = '$qid'";	
	$claimQuery = sqlsrv_query($objCon, $cqSql);
	
	
	if($claimQuery){
		echo"claimed query successfully";
	} else {
		echo"Error: " . $claimQuery . "</br>" . sqlsrv_errors($objCon);
	}	
	
?>