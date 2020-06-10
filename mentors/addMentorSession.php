<?php 
include('../config/database_conn.php');	



	$AMSBusinessID = filter_input(INPUT_POST, 'BusID');
	$AMSSubject = filter_input(INPUT_POST, 'Subj');
	$AMSDescription = filter_input(INPUT_POST, 'Desc');
	$AMSDate = filter_input(INPUT_POST, 'Date');
	$AMSIsComplete = filter_input(INPUT_POST, 'IC');
	$AMSMentorID = filter_input(INPUT_POST, 'MentorID');
	
		
	$amsSql = "INSERT INTO mentor.Session (Description, Subject, IsComplete, Date, BusinessID, MentorID)
	VALUES('$AMSDescription','$AMSSubject','$AMSIsComplete','$AMSDate','$AMSBusinessID','$AMSMentorID')";	
	$amsQuery = sqlsrv_query($objCon, $amsSql);
	
	
	if($amsQuery){
		echo"New session created successfully";
	} else {
		echo"Error: " . $amsSql . "</br>" . sqlsrv_errors($objCon);
	}



?>