<?php
include('../config/database_conn.php');	
session_start();


	$SelectActionProcSql = "UPDATE import.TP_Status_Info SET signon = ".$_POST['status']." WHERE Business_GUID = '".$_POST['guid']."'";


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