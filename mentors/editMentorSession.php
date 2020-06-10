<?php 
include('../config/database_conn.php');	



	$EMSBusinessID = filter_input(INPUT_POST, 'BusID');
	$EMSSubject = filter_input(INPUT_POST, 'Subj');
	$EMSDescription = filter_input(INPUT_POST, 'Desc');
	$EMSDate = filter_input(INPUT_POST, 'Date');
	$EMSIsComplete = filter_input(INPUT_POST, 'IC');
	$EMSessionID = filter_input(INPUT_POST, 'sesID');
	
		
	$emsSql = "UPDATE mentor.Session SET Description = '$EMSDescription'
	, Subject = '$EMSSubject'
	, IsComplete = '$EMSIsComplete'
	, Date = '$EMSDate'
	, BusinessID = '$EMSBusinessID'
	WHERE SessionID = '$EMSessionID'";	
	$emsQuery = sqlsrv_query($objCon, $emsSql);
	
	
	if($emsQuery){
		echo"Updated session successfully";
	} else {
		echo"Error: " . $emsQuery . "</br>" . sqlsrv_errors($objCon);
	}



?>