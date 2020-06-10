<?php 
include('../config/database_conn.php');	

	$EMMSBusinessID = filter_input(INPUT_POST, 'BusID');
	$EMMSProg = filter_input(INPUT_POST, 'Prog');
	$EMMSMilestone = filter_input(INPUT_POST, 'Milestone');
	$EMMSImportant = filter_input(INPUT_POST, 'Important');
	$EMMSIsVerified = filter_input(INPUT_POST, 'IV');
	$EMMSIsComplete = filter_input(INPUT_POST, 'IC');	
	$EMMSDateDue = filter_input(INPUT_POST, 'DDue');
	$EMMSDateCompleted = filter_input(INPUT_POST, 'DCom');
	$EMMSMilestoneID = filter_input(INPUT_POST, 'msID');	
		
	$emmsSql = "UPDATE mentor.Milestones SET BusinessID = '$EMMSBusinessID'
	, Prog = '$EMMSProg'
	, MilestoneName = '$EMMSMilestone'
	, Important = '$EMMSImportant'
	, IsVerified = '$EMMSIsVerified'
	, IsComplete = '$EMMSIsComplete'
	, DueDate = '$EMMSDateDue'
	, DateCompleted = '$EMMSDateCompleted'	
	WHERE MilestoneID = '$EMMSMilestoneID'";	
	$emmsQuery = sqlsrv_query($objCon, $emmsSql);
	
	
	if($emmsQuery){
		echo"Updated Milestone successfully";
	} else {
		echo"Error: " . sqlsrv_errors($objCon);
	}



?>