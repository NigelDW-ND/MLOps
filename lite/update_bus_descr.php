<?php
	include('../config/database_conn.php');
	$GETstatSQL = "EXEC support.update_lite_descr ".$_POST['UserID'].", '".$_POST['Bus_Desc']."';";
	  $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
      $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
      echo "<b>".$GETstatSQL."</b>";
?>

				
		