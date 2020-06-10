<?php
	include('../config/database_conn.php');	
	
	$MMSMilestoneID = filter_input(INPUT_POST, 'mID');
	$mmsrSql = "SELECT ms.MilestoneID, ms.BusinessID, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, CONVERT(varchar, ms.DueDate, 23) AS DueDate, CONVERT(varchar, ms.DateCompleted, 23) AS DateCompleted FROM mentor.Milestones ms WHERE ms.MilestoneID = '$MMSMilestoneID'";
	$mmsrQuery = sqlsrv_query($objCon, $mmsrSql);
	$mmsrResult = sqlsrv_fetch_array($mmsrQuery);
	$mmsrRowToReturn = json_encode($mmsrResult);
	echo $mmsrRowToReturn;
?>