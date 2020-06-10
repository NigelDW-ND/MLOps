<?php
	include('../config/database_conn.php');
	session_start();

	$mentorID = $_SESSION["UserID"];	
	
	$partFil = $_POST['PartFilter'];
	$catFil = $_POST['CatFilter'];
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$soqSql = "SELECT 
			  q.QueryID
			, bus.Bus_Name AS BusName
			, part.str_participant_Name AS PartName
			, q.Status
			, q.DateCreated 
			, q.Subject
			, cat.CategoryDescription
			FROM support.Queries q 
			JOIN participant.admin part ON part.int_participant_ID = q.BusinessID
			JOIN import.TP_Status_Info bus ON bus.Business_GUID = part.id_participant_Guid
			JOIN support.Categories cat on cat.CategoryID = q.CategoryID
			WHERE q.Status = 'Open'";
	if($partFil != "All"){
		if($catFil != "All"){
			$soqSql .= " AND part.int_participant_ID = '$partFil' AND q.CategoryID = '$catFil'";
		}else{
			$soqSql .= " AND part.int_participant_ID = '$partFil'";
		}
	}elseif($catFil != "All"){
		$soqSql .= " AND q.CategoryID = '$catFil'";
	}		
	$soqPSql = "SELECT DISTINCT			 
			  part.str_participant_Name AS PartName
			, part.int_participant_ID			
			FROM support.Queries q 
			JOIN participant.admin part ON part.int_participant_ID = q.BusinessID
			WHERE q.Status = 'Open'";
	$soqCSql = "SELECT DISTINCT		 
			  cat.CategoryDescription
			, q.CategoryID			
			FROM support.Queries q 
			JOIN support.Categories cat on cat.CategoryID = q.CategoryID
			WHERE q.Status = 'Open'";
	$soqQuery = sqlsrv_query($objCon, $soqSql, $params, $options);
	$soqPQuery = sqlsrv_query($objCon, $soqPSql, $params, $options);
	$soqCQuery = sqlsrv_query($objCon, $soqCSql, $params, $options);
	$num_rows = sqlsrv_num_rows($soqQuery);	
		
	$tableToReturn = 
	'<table id="Open-Queries-Table" class="Table-Content-Section">
	<thead>
		<tr>
			<th style="width: 15%">Name</th>
			<th style="width: 30%">Category</th>
			<th style="width: 25%">Subject</th>
			<th style="width: 10%">Status</th>
			<th style="width: 10%">Date</th>
			<th style="width: 10%" colspan=2>Actions</th>
		</tr>
	</thead>
	<tbody>	';
	
	$FilterSelectionsToReturn = '<div id="Open-Queries-Filters-Section">';		
				
	$FilterOptions = 
	'<div class="Filter-Option">
		<span>Name:</span>
		<select id="OQParticipantFilter" class="FilterDropDownBox">
			<option value="All">All</option>';
			
	while($soqPRows = sqlsrv_fetch_array($soqPQuery)){
		$partFilSel = '';
		if($soqPRows['int_participant_ID'] == $partFil){ $partFilSel = "selected='selected'";}
		$FilterOptions .= '<option value="'.$soqPRows["int_participant_ID"].'" '. $partFilSel .'>'. $soqPRows["PartName"] .'</option>';
	}
	$FilterOptions .= 		
		'</select>
	</div>';
	
	$FilterOptions .= 
	'<div class="Filter-Option">
		<span>Category:</span>
		<select id="OQCategoryFilter" class="FilterDropDownBox">
			<option value="All">All</option>';
	while($soqCRows = sqlsrv_fetch_array($soqCQuery)){
		$catFilSel = '';
		if($soqCRows['CategoryID'] == $catFil){ $catFilSel = "selected='selected'";}
		$FilterOptions .= '<option value="'.$soqCRows["CategoryID"].'" '. $catFilSel .'>'. $soqCRows["CategoryDescription"] .'</option>';
	}
	$FilterOptions .= 		
		'</select>
	</div>';
	$FilterSelectionsToReturn .= $FilterOptions;
	$FilterSelectionsToReturn .= '</div>';
	
	if($num_rows > 0){
		while($soqRows = sqlsrv_fetch_array($soqQuery)){
			
			$tableToReturn .=
			'<tr id="'.$soqRows["QueryID"].'">
				<td class="oqBusCol">
					<div id="opBusVal">'. $soqRows["PartName"] .'</div>
				</td>
				<td class="oqCatCol">
					<div id="opCat">'. $soqRows["CategoryDescription"] .'</div>
				</td>
				<td class="oqSubCol">
					<div id="opStatus">'. $soqRows["Subject"] .'</div>
				</td>
				<td class="oqStatCol">
					<div id="opStatus">'. $soqRows["Status"] .'</div>
				</td>
				<td class="oqDateCol">
					<div id="opDate">';
						 
							if($soqRows["DateCreated"] === NULL){
								$tableToReturn .= $soqRows["DateCreated"];
							} else {
								$tableToReturn .= $soqRows["DateCreated"]->format("d/m/Y");
							}	
							
				$tableToReturn .=		
					'</div>
				</td>						
				<td>					
					<div id="opView">
						<input type="button" class="vqBtn" value="View">
					</div>
				</td>						
				<td>
					<div id="opAction">
						<input type="button" class="cqBtn" value="Claim">
					</div>
				</td>
			</tr>';
			
		}
	} else {
		$tableToReturn .=
		'<tr class="tableNoRows">
			<td colspan="7">No records found!</td>
		</tr>';
	}
	
	$tableToReturn .=
		'</tbody>
	</table>';
	
	echo $FilterSelectionsToReturn . $tableToReturn;
?>