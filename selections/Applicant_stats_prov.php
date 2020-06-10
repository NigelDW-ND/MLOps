<?php
	session_start();
	include('config/database_conn.php');
?>

<table>
	<tr>
		<th style=" border-top-left-radius: 15px;">Province</th>
		<th style=" border-top-right-radius: 15px;">Amount</th>
	</tr>
	<?
		$strSQL = "SELECT province[Province], COUNT(province)[Amount] FROM forms.tb_signup_update GROUP BY thischampaige, province ORDER BY thischampaige, province ASC;";
		$objQuery = sqlsrv_query($objCon, $strSQL);
		if( $objQuery === false) {
			die( print_r( sqlsrv_errors(), true) );
		}
		while( $row = sqlsrv_fetch_array( $objQuery, SQLSRV_FETCH_ASSOC) ) {
			echo "<tr>

				<td>".$row['Province']."</td>
				<td>".$row['Amount']."</td></tr>";
		}
		sqlsrv_free_stmt( $objQuery);
	?>
</table>
