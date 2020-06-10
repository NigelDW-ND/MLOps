<?php 
include('../config/database_conn.php');	

	$EMCBusinessID = filter_input(INPUT_POST, 'BusID');
	$EMCDuration = filter_input(INPUT_POST, 'Dur');
	$EMCMileage = filter_input(INPUT_POST, 'Mil');
	$EMCAdminReport = filter_input(INPUT_POST, 'AR');
	$EMCCellDuration = filter_input(INPUT_POST, 'CD');
	$EMCDateCaptured = filter_input(INPUT_POST, 'DCap');
	$EMCOnSite = filter_input(INPUT_POST, 'OS');
	$EMCTollFee = filter_input(INPUT_POST, 'TF');
	$EMCAccomodation = filter_input(INPUT_POST, 'Accom');
	$EMCDescription = filter_input(INPUT_POST, 'Desc');
	$EMCClaimID = filter_input(INPUT_POST, 'mcID');	
		
	$emcSql = "UPDATE mentor.Claims SET BusinessID = '$EMCBusinessID'
	, Duration = '$EMCDuration'
	, Mileage = '$EMCMileage'
	, AdminReport = '$EMCAdminReport'
	, CellDuration = '$EMCCellDuration'
	, DateCaptured = '$EMCDateCaptured'
	, OnSite = '$EMCOnSite'
	, TollFees = '$EMCTollFee'
	, Accomodation = '$EMCAccomodation'
	, Description = '$EMCDescription'	
	WHERE MentorClaimID = '$EMCClaimID'";	
	$emcQuery = sqlsrv_query($objCon, $emcSql);
	
	
	if($emcQuery){
		echo"Updated claim successfully";
	} else {
		echo"Error: " . sqlsrv_errors($objCon);
	}



?>