<?php
	include('../config/database_conn.php');	
	
	$MCClaimID = filter_input(INPUT_POST, 'cID');
	$mcrSql = "SELECT c.MentorClaimID, c.BusinessID, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, CONVERT(varchar, c.DateCaptured, 23) as DateCaptured , c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c WHERE c.MentorClaimID = '$MCClaimID'";
	$mcrQuery = sqlsrv_query($objCon, $mcrSql);
	$mcrResult = sqlsrv_fetch_array($mcrQuery);
	$mcrRowToReturn = json_encode($mcrResult);
	echo $mcrRowToReturn;
?>