<?php

include('../config/database_conn.php');	
session_start();



	$SelectActionProcSql = "EXECUTE participant.sp_insert_part_gen_comment '" . $_POST['Memo'] . " - Sample Comment' ,'" . $_POST['Business'] . "'," . $_POST['By'] ."," . $_POST['Action'] . ";";
	$SelectActionProcQuery = sqlsrv_query($objCon, $SelectActionProcSql);
	$SelectActionProcResult = sqlsrv_rows_affected($SelectActionProcQuery);
	if( !$SelectActionProcResult ) {
    die( print_r( sqlsrv_errors(), true));
	}
	else
	{
	
	    	echo "<br> Action: ".$_POST['Action'];
    		echo "<br> Memo: ".$_POST['Memo'];
    		echo "<br> By: ".$_POST['By'];
    		echo "<br> Business: ".$_POST['Business'];

	}
?>
<br><br><button onClick="window.location.reload();">OK</button>