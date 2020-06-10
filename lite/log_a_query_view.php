<?php
	include('../config/database_conn.php');
	$GETstatSQL = "EXEC support.spr_add_query ".$_POST['UserID'].", ".$_POST['CatID'].", '".$_POST['Comment']."', '".$_POST['Subject']."';";
	  $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
      $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
      echo "<b>".$GETstatSQL."</b>";
      header("Location: participant_support_page.php"); 




?>

				
		