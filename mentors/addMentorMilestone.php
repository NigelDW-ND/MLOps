<?php 
include('../config/database_conn.php');	

	$AMMSBusinessID = filter_input(INPUT_POST, 'BusID');
	$AMMSProg = filter_input(INPUT_POST, 'Prog');
	$AMMSMilestone = filter_input(INPUT_POST, 'Milestone');
	$AMMSImportant = filter_input(INPUT_POST, 'Important');
	$AMMSIsVerified = filter_input(INPUT_POST, 'IV');
	$AMMSIsComplete = filter_input(INPUT_POST, 'IC');
	$AMMSDateDue = filter_input(INPUT_POST, 'DDue');
	$AMMSDateCompleted = filter_input(INPUT_POST, 'DCom');
	$AMMSMentorID = filter_input(INPUT_POST, 'MentorID');
	
		
	$ammsSql = "INSERT INTO mentor.Milestones (BusinessID, Prog, MilestoneName, Important, IsVerified, IsComplete, DueDate, DateCompleted, MentorID)
	VALUES('$AMMSBusinessID','$AMMSProg','$AMMSMilestone','$AMMSImportant','$AMMSIsVerified','$AMMSIsComplete','$AMMSDateDue','$AMMSDateCompleted','$AMMSMentorID')";	
	$ammsQuery = sqlsrv_query($objCon, $ammsSql);
	
	
	if($ammsQuery){
		echo"New milestone created successfully";
	} else {
		echo"Error: " . sqlsrv_errors($objCon);
	}



?>