<?php
	include('../config/database_conn.php');
	
	$adminFunction = $_POST['adminFunction'];
	
	function getOverviewPage($conn){
		$overviewSql = "SELECT Status, COUNT(*) AS Total FROM support.Queries GROUP BY Status ORDER BY Status DESC";			
		$overviewQuery = sqlsrv_query($conn, $overviewSql);
		
		$tableData = 
		'<table id="Overview-Table">
			<thead>
				<tr>
					<th style="width: 50%">Query Status</th>
					<th style="width: 50%">Total</th>
				</tr>
			</thead>
			<tbody>	'; 
		while($ovRow = sqlsrv_fetch_array($overviewQuery)){		
			$tableData .= 
			'<tr><td><div><span value="'. $ovRow["Status"] .'" class="overviewOptions">'. $ovRow["Status"] .'</span></div></td>	
			 <td><div>'. $ovRow["Total"] .'</div></td></tr>';		
		}
		$tableData .= '</tbody></thead>';
		
		return $tableData;		
	}
		
	function getUserManagementPage($conn, $mnf){
		$MenNameFil = '';
		if($mnf == "All"){
			$userManageSql = "SELECT int_Mentor_ID, str_Mentor_Name, str_Mentor_Surname, str_Mentor_Email, str_Mentor_Contact, lgn_Username, active FROM mentor.admin where RollID = 5";
			$MenNameFil = 'value="All"';
		}else{
			$userManageSql = "SELECT int_Mentor_ID, str_Mentor_Name, str_Mentor_Surname, str_Mentor_Email, str_Mentor_Contact, lgn_Username, active FROM mentor.admin where RollID = 5 AND (str_Mentor_Name LIKE '%$mnf%' OR str_Mentor_Surname LIKE '%$mnf%')";	
			$MenNameFil = 'value="'.$mnf.'"';
		}
		$userManageQuery = sqlsrv_query($conn, $userManageSql);
		
		$searchMentorsSection =
		'<div class="Filter-Option"><span>Search Mentor:</span><input type="text" id="searchMentorFilter" '.$MenNameFil.'></input></div>';
		$tableData = 
		'<table id="User-Management-Table" class="Table-Content-Section">
			<thead>
				<tr>
					<th style="width: 15%">Mentor</th>
					<th style="width: 15%">Surname</th>
					<th style="width: 15%">UserName</th>
					<th style="width: 20%">Email</th>
					<th style="width: 15%">Contact</th>
					<th style="width: 10%">Is Active</th>
					<th style="width: 10%"></th>
				</tr>
			</thead>
			<tbody>	'; 
		while($umRow = sqlsrv_fetch_array($userManageQuery)){
			$activeVal = '';
			if($umRow["active"] == 0){
				$activeVal = 'No';
			}elseif($umRow["active"] == 1){
				$activeVal = 'Yes';
			}
			$tableData .= 
			'<tr id="'. $umRow["int_Mentor_ID"] .'">
				<td><div>'. $umRow["str_Mentor_Name"] .'</div></td>	
				<td><div>'. $umRow["str_Mentor_Surname"] .'</div></td>
				<td><div>'. $umRow["lgn_Username"] .'</div></td>
				<td><div>'. $umRow["str_Mentor_Email"] .'</div></td>
				<td><div>'. $umRow["str_Mentor_Contact"] .'</div></td>				
				<td><div>'. $activeVal .'</div></td>				
				<td><div><button class="ManageCategories">Manage</button></div></td>				
			</tr>';		
		}
		$tableData .= '</tbody></table>';
		
		return $searchMentorsSection . $tableData;		
	}
	
	function getParticipantID($conn, $qid){
		$pIDSql = "SELECT BusinessID FROM support.Queries WHERE QueryID = '$qid'";
		$pIDQuery = sqlsrv_query($conn, $pIDSql);
		$pIDRow = sqlsrv_fetch_array($pIDQuery, SQLSRV_FETCH_ASSOC);
		$pIDVal = $pIDRow['BusinessID'];
		return $pIDVal;
	}
	
	function getParticipantDetails($conn, $partID){		
		$partProfileSQL = "SELECT * FROM FetolaDB.participant.vw_part_view_info where part_id = '$partID'";
		$partProfileQuery = sqlsrv_query($conn, $partProfileSQL);
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
		return $partProfTable;
	}
	
	function getMentorCategories($conn, $mid){	
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$mentorCategoriesSQL = "SELECT cat.CategoryDescription, mc.mentorCategoryID FROM mentor.Categories mc LEFT JOIN support.Categories cat on cat.CategoryID = mc.CategoryID where mc.mentorID = '$mid' ";
		$mentorCategoriesNotAssignedSQL = "SELECT CategoryID, CategoryDescription FROM support.Categories where CategoryID NOT IN (SELECT CategoryID FROM mentor.Categories WHERE mentorID = '$mid')";
		$mentorIsActiveSQL = "SELECT Active FROM mentor.admin WHERE int_Mentor_ID = '$mid'";
		$mentorCategoriesQuery = sqlsrv_query($conn, $mentorCategoriesSQL, $params, $options);
		$mentorCategoriesNotAssignedQuery = sqlsrv_query($conn, $mentorCategoriesNotAssignedSQL, $params, $options);
		$mentorIsActiveQuery = sqlsrv_query($conn, $mentorIsActiveSQL);
		$mCatNumRows = sqlsrv_num_rows($mentorCategoriesQuery);
		$mCatNANumRows = sqlsrv_num_rows($mentorCategoriesNotAssignedQuery);
		$mentorIsActiveRow = sqlsrv_fetch_array($mentorIsActiveQuery, SQLSRV_FETCH_ASSOC);
		$mentorIsActiveVal = $mentorIsActiveRow['Active'];
		$miaFilSel = '';
		$minaFilSel = '';
		if($mentorIsActiveVal == 0){
			$minaFilSel = 'selected="selected"';
		}elseif($mentorIsActiveVal == 1){
			$miaFilSel = 'selected="selected"';
		}
		$mentorActiveFilterOptions = '
		<div class="Filter-Option">
				<span>Disable/Enable Mentor:</span>
				<select id="MentorActiveFilter" class="FilterDropDownBox">
					<option value="0" '.$minaFilSel.'>No</option>
					<option value="1" '.$miaFilSel.'>Yes</option>
					</select>
				<button class="ChangeMentorActive" value="'.$mid.'">Change</button>
			</div>
		';
		$mentorCatFilterOptions = '';
		
		
		
		if($mCatNANumRows != 0){
			$mentorCatFilterOptions = 
			'<div class="Filter-Option" id="mentorCategoryFilterBox">
				<span>Category:</span>
				<select id="MentorCategoryFilter" class="FilterDropDownBox">';				
			while($mCatNARows = sqlsrv_fetch_array($mentorCategoriesNotAssignedQuery)){
				$mentorCatFilterOptions .= '<option value="'.$mCatNARows["CategoryID"].'">'. $mCatNARows["CategoryDescription"] .'</option>';
			}
			$mentorCatFilterOptions .= 		
				'</select>
				<button class="SubmitMentorCategory" value="'.$mid.'">Add</button>
			</div>';
		}else{
			$mentorCatFilterOptions ='<div class="Filter-Option">No category to assign</div>';
		}
		
		$mentorCategoriesTable = 
		'<table id="User-Management-Table" class="Modal-Table-Content-Section">
			<thead>
				<tr>
					<th style="width: 80%">Category</th>					
					<th style="width: 20%"></th>
				</tr>
			</thead>
			<tbody>';
		if($mCatNumRows != 0){
			while($row = sqlsrv_fetch_array($mentorCategoriesQuery, SQLSRV_FETCH_ASSOC)){
				$mentorCategoriesTable .=
				'<tr id="'.$row['mentorCategoryID'].'">				
					<td>'.$row['CategoryDescription'].'</td>
					<td><span class="removeMentorCategorySpan" id="'.$mid.'">X</span></td>
				</tr>';			
			}
		}else{
			$mentorCategoriesTable .=
				'<tr class="tableNoRows">				
					<td colspan="2">No categories assigned!</td>
				</tr>';
		}
		
		$mentorCategoriesTable .= '</table>';
		return $mentorActiveFilterOptions . $mentorCatFilterOptions . $mentorCategoriesTable;
	}
	
	function assignMentorCategory($conn, $mid, $mCat){
		$aMenCatSql = "INSERT INTO mentor.Categories (MentorID, CategoryID)
		VALUES('$mid','$mCat')";		
		$aMenCatQuery = sqlsrv_query($conn, $aMenCatSql);		
		
		if($aMenCatQuery){
			$returnVal .= " Added new comment successfully ";
		} else {
			$returnVal .= " Error: " . $aMenCatQuery . "</br>" . sqlsrv_errors($conn);
		}
		
		echo $returnVal;
	}
	
	function changeMentorActive($conn, $mid, $mav){
		$changeMenActSql = "UPDATE mentor.admin SET Active = '$mav' WHERE int_Mentor_ID = '$mid'";		
		$changeMenActQuery = sqlsrv_query($conn, $changeMenActSql);		
		
		if($changeMenActQuery){
			$returnVal .= " Added new comment successfully ";
		} else {
			$returnVal .= " Error: " . $changeMenActQuery . "</br>" . sqlsrv_errors($conn);
		}
		
		echo $returnVal;
	}
	
	function removeMentorCategories($conn, $mcid){
		$rMenCatSql = "DELETE FROM mentor.Categories WHERE mentorCategoryID = '$mcid'";				
		$rMenCatQuery = sqlsrv_query($conn, $rMenCatSql);		
		
		if($rMenCatQuery){
			$returnVal .= " Added new comment successfully ";
		} else {
			$returnVal .= " Error: " . $rMenCatQuery . "</br>" . sqlsrv_errors($conn);
		}
		
		echo $returnVal;
	}
	
	function getQueriesPage($conn, $statusFil, $partFil, $menFil, $catFil){
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$queriesSql = "SELECT 
					  q.QueryID
					, part.int_participant_ID AS ParticipantID
					, part.str_participant_Name AS ParticipantName
					, men.int_Mentor_ID as MentorID
					, men.str_Mentor_Name AS MentorName
					, qn.ClientRating
					, qn.MentorRating
					, cat.CategoryDescription
					, q.Status
					, q.DateCreated 
					, CASE WHEN datediff(hour, q.DateCreated , getdate()) > 24 AND q.Status = 'Open' THEN 'OpenQueryFlag' 
					WHEN datediff(hour, q.DateClaimed , getdate()) > 24 AND q.Status = 'New Claim' THEN 'NewClaimQueryFlag' 
					ELSE '' END AS Flag
					FROM support.Queries q 
					LEFT JOIN mentor.admin men ON men.int_Mentor_ID = q.MentorID
					LEFT JOIN participant.admin part ON part.int_participant_ID = q.BusinessID
					LEFT JOIN support.QueryNotes qn ON qn.QueryID = q.QueryID
					LEFT JOIN support.Categories cat on cat.CategoryID = q.CategoryID";
		
		if($partFil != "All" || $menFil != "All" || $catFil != "All" || $statusFil != "All"){
			$queriesSql .= " WHERE ";
			if($partFil != "All"){
				$queriesSql .= "q.BusinessID = '$partFil'";
			}
			if($menFil != "All"){
				if($partFil != "All"){
					$queriesSql .= " AND q.MentorID = '$menFil'";
				}else{
					$queriesSql .= "q.MentorID = '$menFil'";
				}
			}
			if($catFil != "All"){
				if($partFil != "All" || $menFil != "All"){
					$queriesSql .= " AND q.CategoryID = '$catFil'";
				}else{
					$queriesSql .= "q.CategoryID = '$catFil'";
				}
			}
			if($statusFil != "All"){
				if($partFil != "All" || $menFil != "All" || $catFil != "All"){
					$queriesSql .= " AND q.Status = '$statusFil'";
				}else{
					$queriesSql .= "q.Status = '$statusFil'";
				}
			}
		}
		
		$queriesPSql = 
		"SELECT DISTINCT			 
		  part.str_participant_Name AS ParticipantName
		, part.int_participant_ID AS ParticipantID	
		FROM support.Queries q 
		JOIN participant.admin part ON part.int_participant_ID = q.BusinessID";
		$queriesMSql = 
		"SELECT DISTINCT			 
		  men.str_Mentor_Name AS MentorName
		, men.int_Mentor_ID as MentorID			
		FROM support.Queries q 
		LEFT JOIN mentor.admin men ON men.int_Mentor_ID = q.MentorID
		WHERE q.MentorID IS NOT NULL";
		$queriesCSql = 
		"SELECT DISTINCT		 
		  cat.CategoryDescription
		, q.CategoryID			
		FROM support.Queries q 
		JOIN support.Categories cat on cat.CategoryID = q.CategoryID";
		$queriesSSql = 
		"SELECT DISTINCT		 
		Status		
		FROM support.Queries ";
		$queriesQuery = sqlsrv_query($conn, $queriesSql, $params, $options);
		$qPFQuery = sqlsrv_query($conn, $queriesPSql);
		$qMFQuery = sqlsrv_query($conn, $queriesMSql);
		$qCFQuery = sqlsrv_query($conn, $queriesCSql);
		$qSFCQuery = sqlsrv_query($conn, $queriesSSql);
		$queriesRowNum = sqlsrv_num_rows($queriesQuery);	
			
		$tableToReturn = 
		'<table id="Admin-Mentor-Lite-Queries-Table" class="Table-Content-Section">
		<thead>
			<tr>
				<th style="width: 10%">Business</th>
				<th style="width: 10%">Mentor</th>
				<th style="width: 10%">Business Rating</th>
				<th style="width: 10%">Mentor Rating</th>
				<th style="width: 10%">Category</th>
				<th style="width: 10%">Status</th>
				<th style="width: 10%">Date</th>
				<th style="width: 10%">Action</th>
				<th style="width: 10%">Flag</th>
			</tr>
		</thead>
		<tbody>	';
		
		$FilterSelectionsToReturn = '<div id="Queries-Filters-Section">';		
					
		$FilterOptions = 
		'<div class="Filter-Option">
			<span>Business:</span>
			<select id="QParticipantFilter" class="QueriesFilterDropDownBox">
				<option value="All">All</option>';
				
		while($qPFRows = sqlsrv_fetch_array($qPFQuery)){
			$partFilSel = '';
			if($qPFRows['ParticipantID'] == $partFil){ $partFilSel = "selected='selected'";}
			$FilterOptions .= '<option value="'.$qPFRows["ParticipantID"].'" '. $partFilSel .'>'. $qPFRows["ParticipantName"] .'</option>';
		}
		$FilterOptions .= 		
			'</select>
		</div>';
		
		$FilterOptions .= 
		'<div class="Filter-Option">
			<span>Mentor:</span>
			<select id="QMentorFilter" class="QueriesFilterDropDownBox">
				<option value="All">All</option>';
		while($qMFRows = sqlsrv_fetch_array($qMFQuery)){
			$mentorFilSel = '';
			if($qMFRows['MentorID'] == $menFil){ $mentorFilSel = "selected='selected'";}
			$FilterOptions .= '<option value="'.$qMFRows["MentorID"].'" '. $mentorFilSel .'>'. $qMFRows["MentorName"] .'</option>';
		}
		$FilterOptions .= 		
			'</select>
		</div>';
		
		$FilterOptions .= 
		'<div class="Filter-Option">
			<span>Category:</span>
			<select id="QCategoryFilter" class="QueriesFilterDropDownBox">
				<option value="All">All</option>';
		while($qCFRows = sqlsrv_fetch_array($qCFQuery)){
			$catFilSel = '';
			if($qCFRows['CategoryID'] == $catFil){ $catFilSel = "selected='selected'";}
			$FilterOptions .= '<option value="'.$qCFRows["CategoryID"].'" '. $catFilSel .'>'. $qCFRows["CategoryDescription"] .'</option>';
		}
		$FilterOptions .= 		
			'</select>
		</div>';
		
		$FilterOptions .= 
		'<div class="Filter-Option">
			<span>Status:</span>
			<select id="QStatusFilter" class="QueriesFilterDropDownBox">
				<option value="All">All</option>';
		while($qSFRows = sqlsrv_fetch_array($qSFCQuery)){
			$statusFilSel = '';
			if($qSFRows['Status'] == $statusFil){ $statusFilSel = "selected='selected'";}
			$FilterOptions .= '<option value="'.$qSFRows["Status"].'" '. $statusFilSel .'>'. $qSFRows["Status"] .'</option>';
		}
		$FilterOptions .= 		
			'</select>
		</div>';
		$FilterSelectionsToReturn .= $FilterOptions;
		$FilterSelectionsToReturn .= '</div>';
		
		if($queriesRowNum > 0){
			while($queriesRows = sqlsrv_fetch_array($queriesQuery)){
				$flagClass = "";
				$flagVal = "";
				$flagTootTipVal = "";
				if($queriesRows["Flag"] == "OpenQueryFlag"){
					$flagClass = 'class="FlagAlert"';
					$flagVal = "⚠";
					$flagTootTipVal = "Query has not been claimed in 24 hours";
				}elseif($queriesRows["Flag"] == "NewClaimQueryFlag"){
					$flagClass = 'class="FlagAlert"';
					$flagVal = "⚠";
					$flagTootTipVal = "Query has not been responded to in 24 hours";
				}	
				$clientRating = '';
				if($queriesRows["ClientRating"] === NULL){
					$clientRating = '<span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span>';
				}elseif($queriesRows["ClientRating"] == 1){					
					$clientRating = '<span class="selectedStar">★</span><span class="selectedStar">☆</span><span class="blankStar">☆</span><span class="blankStar">☆</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["ClientRating"] == 2){					
					$clientRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span><span class="blankStar">☆</span><span class="blankStar">☆</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["ClientRating"] == 3){					
					$clientRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="blankStar">☆</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["ClientRating"] == 4){					
					$clientRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span class="selectedStar"><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["ClientRating"] == 5){					
					$clientRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span>';
				}
				
				$mentorRating = '';
				if($queriesRows["MentorRating"] === NULL){
					$mentorRating = '<span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span><span class="noRatingProvided">☆</span>';
				}elseif($queriesRows["MentorRating"] == 1){					
					$mentorRating = '<span class="selectedStar">★</span><span class="selectedStar">☆</span><span class="blankStar">☆</span><span class="blankStar">☆</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["MentorRating"] == 2){					
					$mentorRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span><span class="blankStar">☆</span><span class="blankStar">☆</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["MentorRating"] == 3){					
					$mentorRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="blankStar">☆</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["MentorRating"] == 4){					
					$mentorRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span class="selectedStar"><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="blankStar">☆</span>';
				}elseif($queriesRows["MentorRating"] == 5){					
					$mentorRating = '<span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span><span class="selectedStar">★</span>';
				}
				
				$tableToReturn .=
				'<tr id="'.$queriesRows["QueryID"].'">
					<td>
						<div id="qParticipantVal"><span class="queryParticipantSpan">'. $queriesRows["ParticipantName"] .'</span></div>
					</td>
					<td>
						<div id="qMentorVal">'. $queriesRows["MentorName"] .'</div>
					</td>
					<td>
						<div id="qParticipantRatingVal">'.$clientRating.'</div>
					</td>
					<td>
						<div id="qMentorRatingVal">'.$mentorRating.'</div>
					</td>
					<td>
						<div id="qCategoryVal">'. $queriesRows["CategoryDescription"] .'</div>
					</td>
					<td>
						<div id="qStatusVal">'. $queriesRows["Status"] .'</div>
					</td>
					<td>
						<div id="qDateVal">';
							 
								if($queriesRows["DateCreated"] === NULL){
									$tableToReturn .= $queriesRows["DateCreated"];
								} else {
									$tableToReturn .= $queriesRows["DateCreated"]->format("d/m/Y");
								}	
								
					$tableToReturn .=		
						'</div>
					</td>						
					<td>					
						<div id="opView">
							<input type="button" class="viewCommentsBtn" value="View">
						</div>
					</td>						
					<td>						
						<div id="qStatusVal" '.$flagClass.'>'. $flagVal .'<span class="FlagAlertToolTip">'.$flagTootTipVal.'</span></div>						
					</td>
				</tr>';
				
			}
		} else {
			$tableToReturn .=
			'<tr class="tableNoRows">
				<td colspan="10">No records found!</td>
			</tr>';
		}
		
		$tableToReturn .=
			'</tbody>
		</table>';
		
		return $FilterSelectionsToReturn . $tableToReturn;
	}
	
	function getComments($conn,$queryID){
		$comSql = "SELECT c.QueryID, c.UserID, c.UserType, c.Comment, c.CommentNo, c.CommentType, c.DateCreated, c.CommentSubType
		, CASE 
		WHEN c.UserType = 'Participant' THEN part.str_participant_Name
		WHEN c.UserType = 'Mentor' THEN a.str_Mentor_Name
		ELSE NULL
		END AS UserName
		FROM support.Comments c 
		LEFT OUTER JOIN mentor.admin a on ( a.int_Mentor_ID = c.UserID AND c.UserType = 'Mentor') 
		LEFT OUTER JOIN participant.admin part on ( part.int_participant_ID = c.UserID AND c.UserType = 'Participant')
		WHERE c.QueryID = '$queryID' ORDER BY c.DateCreated DESC";			
		$comQuery = sqlsrv_query($conn, $comSql);
		
		$commentData = '<div id="comment-section">'; 
		while($comRow = sqlsrv_fetch_array($comQuery)){		
			$commentData .= 
			'<div id="'. $comRow["UserType"] .'-comment" class="comment-data-display">
				<div id="Comment-Top"><div id="Comment-User-Name">'. $comRow["UserName"] .'</div><div id="Comment-Date-Time">'. $comRow["DateCreated"]->format('d/m/Y H:i') .'</div></div>	
				<div id="Comment-Content">'. $comRow["Comment"] .'</div>	
			</div>';		
		}
		$commentData .= '</div>';
		
		return $commentData;
	}
	
	
	#----------------------------------------------------------------------------------------------------------------
	#----------------------------------------------- End Of Functions -----------------------------------------------
	#----------------------------------------------------------------------------------------------------------------
	
	if($adminFunction == "getOverviewPage"){
		$tableResult = getOverviewPage($objCon);
		
		echo $tableResult;
			
	}elseif($adminFunction == "getUserManagementPage"){
		$mnf = $_POST['mnf'];
		$tableResult = getUserManagementPage($objCon, $mnf);
		
		echo $tableResult;
	}elseif($adminFunction == "getQueriesPage"){
		$partFil = $_POST['partFil'];
		$menFil = $_POST['menFil'];
		$catFil = $_POST['catFil'];
		$statusFil = $_POST['statFil'];
		$tableResult = getQueriesPage($objCon, $statusFil, $partFil, $menFil, $catFil);
		
		echo $tableResult;
	}elseif($adminFunction == "getParticipantDetails"){
		$qid = $_POST['qid'];
		$partID = getParticipantID($objCon, $qid);
		$tableResult = getParticipantDetails($objCon, $partID);
		
		echo $tableResult;
	}elseif($adminFunction == "getQueryComments"){
		$qid = $_POST['qid'];
		$tableResult = getComments($objCon, $qid);
		
		echo $tableResult;
	}elseif($adminFunction == "getMentorCategories"){
		$mid = $_POST['mid'];
		$tableResult = getMentorCategories($objCon, $mid);
		
		echo $tableResult;
	}elseif($adminFunction == "assignMentorCategory"){
		$mid = $_POST['mid'];
		$mCat = $_POST['mCat'];
		$Result = assignMentorCategory($objCon, $mid, $mCat);
		
		echo $Result;
	}elseif($adminFunction == "removeMentorCategories"){
		$mcid = $_POST['mcid'];
		$Result = removeMentorCategories($objCon, $mcid);
		
		echo $Result;
	}elseif($adminFunction == "changeMentorActive"){
		$mid = $_POST['mid'];
		$mav = $_POST['mav'];
		$Result = changeMentorActive($objCon, $mid, $mav);
		
		echo $Result;
	}
	
	
	
?>	