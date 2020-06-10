<?php
	include('../config/database_conn.php');
	session_start();

	$mentorID = $_SESSION["UserID"];	
	
	$functionToRun = $_POST['funcTR'];	
	
	if($functionToRun == "getMyQueries"){		
		$partFil = $_POST['PartFilter'];
		$catFil = $_POST['CatFilter'];
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$mqSql = "SELECT 
				q.QueryID
				, bus.Bus_Name AS BusName
				, part.str_participant_Name AS PartName
				, cat.CategoryDescription
				, q.Status
				, q.DateCreated 
				, q.Subject
				FROM support.Queries q 
				JOIN participant.admin part ON part.int_participant_ID = q.BusinessID
				JOIN import.TP_Status_Info bus ON bus.Business_GUID = part.id_participant_Guid
				JOIN support.Categories cat ON cat.CategoryID = q.CategoryID
				WHERE q.MentorID = '$mentorID'";
		if($partFil != "All"){
			if($catFil != "All"){
				$mqSql .= " AND part.int_participant_ID = '$partFil' AND q.CategoryID = '$catFil'";
			}else{
				$mqSql .= " AND part.int_participant_ID = '$partFil'";
			}
		}elseif($catFil != "All"){
			$mqSql .= " AND q.CategoryID = '$catFil'";
		}		
		$mqPSql = "SELECT DISTINCT			 
				  part.str_participant_Name AS PartName
				, part.int_participant_ID			
				FROM support.Queries q 
				JOIN participant.admin part ON part.int_participant_ID = q.BusinessID
				WHERE q.MentorID = '$mentorID'";
		$mqCSql = "SELECT DISTINCT		 
				  cat.CategoryDescription
				, q.CategoryID			
				FROM support.Queries q 
				JOIN support.Categories cat on cat.CategoryID = q.CategoryID
				WHERE q.MentorID = '$mentorID'";
		$mqSql .= "ORDER BY q.Status DESC, q.DateClaimed DESC";
		$mqQuery = sqlsrv_query($objCon, $mqSql, $params, $options);
		$mqPQuery = sqlsrv_query($objCon, $mqPSql, $params, $options);
		$mqCQuery = sqlsrv_query($objCon, $mqCSql, $params, $options);
		$num_rows = sqlsrv_num_rows($mqQuery);	
			
		$tableToReturn = 
		'<form method="POST" action="query.php"><table id="Open-Queries-Table" class="Table-Content-Section">
		<thead>
			<tr>
				<th style="width: 15%">Business</th>
				<th style="width: 30%">Category</th>
				<th style="width: 20%">Subject</th>
				<th style="width: 10%">Status</th>
				<th style="width: 10%">Date</th>
				<th style="width: 15%; text-align:center;" colspan = 3>Actions</th>
			</tr>
		</thead>
		<tbody>	';
		
		$FilterSelectionsToReturn = '<div id="Open-Queries-Filters-Section">';		
					
		$FilterOptions = 
		'<div class="Filter-Option">
			<span>Name:</span>
			<select id="MQParticipantFilter" class="FilterDropDownBox">
				<option value="All">All</option>';
				
		while($mqPRows = sqlsrv_fetch_array($mqPQuery)){
			$partFilSel = '';
			if($mqPRows['int_participant_ID'] == $partFil){ $partFilSel = "selected='selected'";}
			$FilterOptions .= '<option value="'.$mqPRows["int_participant_ID"].'" '. $partFilSel .'>'. $mqPRows["PartName"] .'</option>';
		}
		$FilterOptions .= 		
			'</select>
		</div>';
		
		$FilterOptions .= 
		'<div class="Filter-Option">
			<span>Category:</span>
			<select id="MQCategoryFilter" class="FilterDropDownBox">
				<option value="All">All</option>';
		while($mqCRows = sqlsrv_fetch_array($mqCQuery)){
			$catFilSel = '';
			if($mqCRows['CategoryID'] == $catFil){ $catFilSel = "selected='selected'";}
			$FilterOptions .= '<option value="'.$mqCRows["CategoryID"].'" '. $catFilSel .'>'. $mqCRows["CategoryDescription"] .'</option>';
		}
		$FilterOptions .= 		
			'</select>
		</div>';
		$FilterSelectionsToReturn .= $FilterOptions;
		$FilterSelectionsToReturn .= '</div>';
		
		if($num_rows > 0){
			while($mqRows = sqlsrv_fetch_array($mqQuery)){
				$unclaimDis = "";
				$closeDis = "";
				if($mqRows["Status"] == "Closed"){
					$unclaimClass = "unclaimQueryDisabledBtn";
					$closeClass = "closeQueryDisabledBtn";
					$unclaimDis = "disabled";
					$closeDis = "disabled";
				}else{
					$unclaimClass ="unclaimQueryBtn";
					$closeClass ="closeQueryBtn";
				}
				$tableToReturn .=
				'<tr id="'.$mqRows["QueryID"].'">
					<td class="mqBusCol">
						<div id="mpBusVal">'. $mqRows["PartName"] .'</div>
					</td>
					<td class="mqCatCol">
						<div id="mpCat">'. $mqRows["CategoryDescription"] .'</div>
					</td>
					<td class="mqSubCol">
						<div id="mpSub">'. $mqRows["Subject"] .'</div>
					</td>
					<td class="mqStatCol">
						<div id="mpStatus">'. $mqRows["Status"] .'</div>
					</td>
					<td class="mqDateCol">
						<div id="mpDate">';
							 
								if($mqRows["DateCreated"] === NULL){
									$tableToReturn .= $mqRows["DateCreated"];
								} else {
									$tableToReturn .= $mqRows["DateCreated"]->format("d/m/Y");
								}	
								
					$tableToReturn .=		
						'</div>
					</td>						
					<td>					
						<div id="mpView">
							<button type="submit" class="viewQueryBtn" name="queryID" value="'.$mqRows["QueryID"].'">View</button>
						</div>
					</td>						
					<td>
						<div id="mpUnclaim">
							<input type="button" class="'.$unclaimClass.'" value="Unclaim" '.$unclaimDis.'>
						</div>
					</td>
					<td>
						<div id="mpClose">
							<input type="button" class="'.$closeClass.'" value="Close" '.$closeDis.'>
						</div>
					</td>
				</tr>';
				
			}
		} else {
			$tableToReturn .=
			'<tr class="tableNoRows">
				<td colspan="8">No records found!</td>
			</tr>';
		}
		
		$tableToReturn .=
			'</tbody>
		</table></form>';
		
		echo $FilterSelectionsToReturn . $tableToReturn;
	}elseif($functionToRun == "getUnclaimForm"){
		$qid = $_POST['qid'];
		$catSql = "SELECT * FROM [support].[Categories]";			
		$catQuery = sqlsrv_query($objCon, $catSql);		
		$unclaimForm = '
		<div id="unclaim-query-form">			
			<div id="unclaimCat">
				Update Query Category
				<select name="catInput" id="qCategory" class="commentsDropDownBox">	
					<option value="-1">Select Category</option>';
		while($catRow = sqlsrv_fetch_object($catQuery)){ 									 
			$unclaimForm .= '<option value="'. $catRow->CategoryID .'">' .$catRow->CategoryDescription .'</option>';					
		}			
		$unclaimForm .= 		
				'</select>
			</div>
			<div id="unclaimText">					
				<textarea name="unclaimVal" id="unclaim-reason-comment-text" rows="4" cols="60" maxlength="500" placeholder="To notify the mentee and the next mentor, please provide a reason for unclaiming this request" spellcheck="true"></textarea>
			</div>	
			<div id="unclaimSubmit">
				<button type="submit" id="USubBtn" value="'.$qid.'" name="submit-unclaim">Submit</button>
			</div>			
		</div>
		';
		echo $unclaimForm;
	}elseif($functionToRun == "getCloseQueryForm"){
		$qid = $_POST['qid'];
		$contpSql = "SELECT * FROM [support].[ContactType]";			
		$contpQuery = sqlsrv_query($objCon, $contpSql);		
		$closeQueryForm = '
		<div id="final-comment-form">
		<span>Primary communication platform</span>
			<div id="contactType">
				Type of Contact:
				<select name="contactInput" id="qContactType" class="commentsDropDownBox">
					<option value="-1">Select ContactType</option>';
		while($contpRow = sqlsrv_fetch_object($contpQuery)){ 									 
			$closeQueryForm .= '<option value="'. $contpRow->ContactTypeID .'">'. $contpRow->ContactTypeDescription .'</option>';					
		}			
		$closeQueryForm .=	'
				</select>
			</div>
			<span>Time Spent</span>
			<div id="timeSpent">
				Hours:
				<select name="timeSpentHours" id="qtsHours" class="commentsDropDownBox">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
				Minutes:
				<select name="timeSpentHours" id="qtsMinutes" class="commentsDropDownBox">
					<option value="0">0</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
					<option value="35">35</option>
					<option value="40">40</option>
					<option value="45">45</option>
					<option value="50">50</option>
					<option value="55">55</option>
				</select>
			</div>
			<span>Rating</span>
			<div id="finalMentorRatingSection">
				<div id="RatingBox">
					Please rate your overall engagement with the business:
					<input type="radio" id="star1" name="QueryRating" value="1">
					<input type="radio" id="star2" name="QueryRating" value="2">
					<input type="radio" id="star3" name="QueryRating" value="3">
					<input type="radio" id="star4" name="QueryRating" value="4">
					<input type="radio" id="star5" name="QueryRating" value="5">
					
					<div class="RatingStars">
						<label for="star1" title="1 star"></label>
						<label for="star2" title="2 stars"></label>
						<label for="star3" title="3 stars"></label>
						<label for="star4" title="4 stars"></label>
						<label for="star5" title="5 stars"></label>
					</div>
				</div>			
				<div id="RatingCommentBox">
					<textarea name="RatingCommentVal" id="add-rating-comment-text" rows="3" cols="60" maxlength="200" placeholder="Would you like to provide further details of your rating here. Comments are not visible to the mentee" spellcheck="true"></textarea>
				</div>
			</div>
			<span>Final Comment</span>
			<div id="finalCommentText">
				<textarea name="finalCommentVal" id="add-final-comment-text" rows="4" cols="60" maxlength="300" placeholder="Would you like to add any final comments about this request here. Comments are not visible to the mentee" spellcheck="true"></textarea>
			</div>
			<div id="finalCommentSubmit">
				<button type="submit" id="FSubBtn" value="'.$qid.'" name="submit-final-comment">Close Query</button>
			</div>			
		</div>
		';
	echo $closeQueryForm;
	}
?>