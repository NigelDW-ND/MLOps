<?php 
include('../config/database_conn.php');	

	$AMCBusinessID = filter_input(INPUT_POST, 'BusID');
	$AMCDuration = filter_input(INPUT_POST, 'Dur');
	$AMCMileage = filter_input(INPUT_POST, 'Mil');
	$AMCAdminReport = filter_input(INPUT_POST, 'AR');
	$AMCCellDuration = filter_input(INPUT_POST, 'CD');
	$AMCDateCaptured = filter_input(INPUT_POST, 'DCap');
	$AMCOnSite = filter_input(INPUT_POST, 'OS');
	$AMCTollFee = filter_input(INPUT_POST, 'TF');
	$AMCAccomodation = filter_input(INPUT_POST, 'Accom');
	$AMCDescription = filter_input(INPUT_POST, 'Desc');
	$AMCMentorID = filter_input(INPUT_POST, 'MentorID');
	
		
	$amcSql = "INSERT INTO mentor.Claims (BusinessID, Duration, Mileage, AdminReport, CellDuration, DateCaptured, OnSite, TollFees, Accomodation, Description, MentorID)
	VALUES('$AMCBusinessID','$AMCDuration','$AMCMileage','$AMCAdminReport','$AMCCellDuration','$AMCDateCaptured','$AMCOnSite','$AMCTollFee','$AMCAccomodation','$AMCDescription','$AMCMentorID')";	
	$amcQuery = sqlsrv_query($objCon, $amcSql);
	
	
	if($amcQuery){
		echo"New claim created successfully";
	} else {
		echo"Error: " . sqlsrv_errors($objCon);
	}



?>