<?php
	include('../config/database_conn.php');
	$GETstatSQL = "SELECT * FROM FetolaDB.participant.vw_part_view_info where part_id = ".$_POST['Part_ID'].";";
	$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
    ?>
    	<table id="part_tb">
    <?
	while($row = sqlsrv_fetch_array($GETstatQuery, SQLSRV_FETCH_ASSOC))
	{
	?>
		<tr id="part_tr"><td id="part_td">Contact Name</td><td id="part_td"><b><? echo $row['part_name']; ?></b></td><td id="part_td"></td><td id="part_td">Business Name</td><td id="part_td"><b><? echo $row['bus_name']; ?></b></td></tr>
		<tr id="part_tr"><td id="part_td">Email Address</td><td id="part_td"><b><? echo $row['part_email']; ?></b></td><td id="part_td"></td><td id="part_td">Sector</td><td id="part_td"><b><? echo $row['bus_sec']; ?></b></td></tr>
		<tr id="part_tr"><td id="part_td">Contact Number</td><td id="part_td"><b><? echo $row['part_cont']; ?></b></td><td id="part_td"></td><td id="part_td">Province</td><td id="part_td"><b><? echo $row['Prov']; ?></b></td></tr>
	<?
		if(!$row['Description'] == ""){
	?>
		<tr id="part_tr"><td colspan="5" id="part_td">Business Description</td></tr>
		<tr id="part_tr"><td colspan="5" id="part_td"><b><pre><? echo $row['Description']; ?></pre></b></td></tr>
	<?
		}
	}
	sqlsrv_close($objCon);
?>
		</table>


				
		