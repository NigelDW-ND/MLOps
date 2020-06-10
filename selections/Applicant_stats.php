<?php
	session_start();
	include('config/database_conn.php');
?>

<table>
	<tr>
		<th style=" border-top-left-radius: 15px;">Stats</th>
		<th style=" border-top-right-radius: 15px;">Value</th>
	</tr>
	<?
		$strSQL = "SELECT * FROM FetolaDB.metrics.vw_participant_stats;";
		$objQuery = sqlsrv_query($objCon, $strSQL);
		if( $objQuery === false) {
			die( print_r( sqlsrv_errors(), true) );
		}
		while( $row = sqlsrv_fetch_array( $objQuery, SQLSRV_FETCH_ASSOC) ) {
			echo "<tr>
				<td>".$row['Stats']."</td>
				<td>".$row['Value']."</td></tr>";
		}
		sqlsrv_free_stmt( $objQuery);
		
		
		$perstrSQL = "SELECT * FROM FetolaDB.metrics.vw_participant_stats_perc;";
		$perobjQuery = sqlsrv_query($objCon, $perstrSQL);
		if( $perobjQuery === false) {
			die( print_r( sqlsrv_errors(), true) );
		}
		while( $row = sqlsrv_fetch_array( $perobjQuery, SQLSRV_FETCH_ASSOC) ) {
			echo "<tr>
				<td>".$row['Stats']."</td>
				<td>".$row['Value']."</td></tr>";
		}
		sqlsrv_free_stmt( $perobjQuery);
		
	?>
</table>
