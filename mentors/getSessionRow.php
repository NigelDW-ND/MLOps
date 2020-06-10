<?php
	include('../config/database_conn.php');	
	
	$MSSessionID = filter_input(INPUT_POST, 'sID');
	$msrSql = "SELECT s.SessionID, s.BusinessID, s.Subject, s.Description, CONVERT(varchar, s.Date, 23) as Date, s.IsComplete  FROM mentor.Session s WHERE s.SessionID = '$MSSessionID'";
	$msrQuery = sqlsrv_query($objCon, $msrSql);
	$msrResult = sqlsrv_fetch_array($msrQuery);
	$msrRowToReturn = json_encode($msrResult);
	echo $msrRowToReturn;
?>