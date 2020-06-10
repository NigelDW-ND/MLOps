<?php
include('../config/database_conn.php');	
session_start();

	$SelectActionProcSql = "INSERT INTO participant.tb_General_Note (memo_General_Note_Note, int_General_Note_added_By, dt_General_Note_Date, link_General_Note_Business) VALUES ('".$_POST['note']."',".$_SESSION["UserID"].", GETDATE(), '".$_POST['guid']."');";


	$SelectActionProcQuery = sqlsrv_query($objCon, $SelectActionProcSql);
	$SelectActionProcResult = sqlsrv_rows_affected($SelectActionProcQuery);
	if( !$SelectActionProcResult ) {
    die( print_r( sqlsrv_errors(), true));
	}
	else
	{
		echo $SelectActionProcSql;

	}
?>