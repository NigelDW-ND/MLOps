<?php
	include('../config/database_conn.php');	
	
	$queryID = $_POST["qid"];
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$qdSql = "SELECT 
			  Comment
			, DateCreated		
			FROM support.Comments  
			WHERE QueryID = '$queryID'
			AND CommentNo = 1";				
	$qdQuery = sqlsrv_query($objCon, $qdSql, $params, $options);
	$num_rows = sqlsrv_num_rows($qdQuery);
		
	$partIDSql = "SELECT BusinessID FROM support.Queries WHERE QueryID = '$queryID'";			
	$partIDQuery = sqlsrv_query($objCon, $partIDSql);
	$partID = '';
	$partRow = sqlsrv_fetch_array($partIDQuery, SQLSRV_FETCH_ASSOC);
	$partID .= $partRow['BusinessID'];
	
	$partProfileSQL = "SELECT * FROM FetolaDB.participant.vw_part_view_info where part_id = '$partID'";
	$partProfileQuery = sqlsrv_query($objCon, $partProfileSQL);
	
	$partProfTable = '<table id="part_tb">';
	
	while($row = sqlsrv_fetch_array($partProfileQuery, SQLSRV_FETCH_ASSOC)){
		$partProfTable .=
		'<tr><td>Contact Name:</td><td><b>'.$row['part_name'].'</b></td><td></td><td>Business Name:</td><td><b>'.$row['bus_name'].'</b></td></tr>
		<tr><td>Email Address:</td><td><b>'.$row['part_email'].'</b></td><td></td><td>Sector:</td><td><b>'.$row['bus_sec'].'</b></td></tr>
		<tr><td>Contact Number:</td><td><b>'.$row['part_cont'].'</b></td><td></td><td>Province:</td><td><b>'.$row['Prov'].'</b></td></tr>';
		
		if(!$row['Description'] == ""){
			$partProfTable .=
			'<tr><td colspan="5">Business Description</td></tr>
			<tr><td colspan="5">'.$row['Description'].'</td></tr>';
		}
		
	}
	
	$partProfTable .= '</table>';
	
	$tableToReturn = 
	'<table id="Query-Description-Table" class="Modal-Table-Content-Section">
	<thead>
		<tr>
			<th style="width: 85%; text-align:left;">Query Description</th>
			<th style="width: 15%">Date</th>			
		</tr>
	</thead>
	<tbody>	';
	
	if($num_rows > 0){
		$qdArr = sqlsrv_fetch_array($qdQuery);
			
		$tableToReturn .=
		'<tr>
			<td>
				<div id="opBusVal">'. $qdArr["Comment"] .'</div>
			</td>				
			<td>
				<div id="opDate">';
					 
		if($qdArr["DateCreated"] === NULL){
			$tableToReturn .= $qdArr["DateCreated"];
		} else {
			$tableToReturn .= $qdArr["DateCreated"]->format("d/m/Y");
		}	
						
		$tableToReturn .=		
				'</div>
			</td>				
		</tr>';			
		
	} else {
		$tableToReturn .=
		'<tr class="tableNoRows">
			<td colspan="2">No description found!</td>
		</tr>';
	}
	
	$tableToReturn .=
		'</tbody>
	</table>';
	
	$contentToReturn = $partProfTable . $tableToReturn;
	
	echo $contentToReturn;
?>