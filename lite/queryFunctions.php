<?php
	include('../config/database_conn.php');
	
	$qType = $_POST['qType'];
	
	function getComments($conn,$queryID){
		$params = array();
		$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
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
		$comQuery = sqlsrv_query($conn, $comSql, $params, $options);
		return $comQuery;
	}
	
	function getMentorAccount($conn, $qid){
		$accSql = "SELECT CONCAT(str_Mentor_Name,  ' ',  str_Mentor_Surname) AS Mentor, str_Mentor_Email AS Email, str_Mentor_Contact AS Contact, str_Mentor_image AS ImageURL FROM mentor.admin where int_Mentor_ID = (SELECT MentorID FROM support.Queries WHERE QueryID ='$qid')";
		$accQuery = sqlsrv_query($conn, $accSql);
		return $accQuery;
	}
	
	function getParticipantAccount($conn, $qid){
		$accSql = "SELECT str_participant_Name AS Participant, str_participant_Email AS Email, str_participant_Contact AS Contact, str_participant_image AS ImageURL FROM participant.admin where int_participant_ID = (SELECT BusinessID FROM support.Queries WHERE QueryID ='$qid')";
		$accQuery = sqlsrv_query($conn, $accSql);
		return $accQuery;
	}
	
	function getUploadedFiles($conn, $queryID){
		$comUpFileSql = "SELECT Comment FROM support.Comments WHERE QueryID = '$queryID' AND CommentSubType='FileUpload'";			
		$comUpFiletQuery = sqlsrv_query($conn, $comUpFileSql);
		return $comUpFiletQuery;
	}
	
	function getCategories($conn){
		$catSql = "SELECT * FROM [support].[Categories]";			
		$catQuery = sqlsrv_query($conn, $catSql);
		return $catQuery;
	}
	
	function getContactType($conn){
		$contpSql = "SELECT * FROM [support].[ContactType]";			
		$contpQuery = sqlsrv_query($conn, $contpSql);
		return $contpQuery;
	}
	/*
	function getParticipantID($conn, $queryID){
		$params = array();
		$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$partIDSql = "SELECT BusinessID FROM support.Queries WHERE QueryID = '$queryID'";			
		$partIDQuery = sqlsrv_query($conn, $partIDSql, $params, $options);
		return $partIDQuery;
	}
	*/
	function getCommentNo($conn, $queryID){
		$comNumSql = "SELECT MAX(c.CommentNo) AS CommentNo FROM support.Comments c WHERE c.QueryID = '$queryID'";
		$comNumQuery = sqlsrv_query($conn, $comNumSql);
		$comNumRow = sqlsrv_fetch_array($comNumQuery, SQLSRV_FETCH_ASSOC);
		$comNumVal = $comNumRow['CommentNo'];
		return $comNumVal;
	}
	
	function doesFirstReplyCommentExist($conn,$queryID){
		$params = array();
		$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$comFRSql = "SELECT c.QueryID, c.UserID, c.UserType, c.Comment, c.CommentNo, c.CommentType FROM support.Comments c WHERE c.QueryID = '$queryID' AND c.CommentSubType = 'First Reply'";			
		$comFRQuery = sqlsrv_query($conn, $comFRSql, $params, $options);
		$comFRQueryResult = sqlsrv_has_rows($comFRQuery);
		return $comFRQueryResult;
	}
	
	function getQueryStatus($conn, $queryID){
		$qStatusSql = "SELECT Status FROM support.Queries WHERE QueryID = '$queryID'";
		$qStatusQuery = sqlsrv_query($conn, $qStatusSql);
		$qStatusRow = sqlsrv_fetch_array($qStatusQuery, SQLSRV_FETCH_ASSOC);
		$qStatusVal = $qStatusRow['Status'];
		return $qStatusVal;
	}
	
	function CheckAndChangeFileName($path, $filename){
		$FileNameNoExtension = pathinfo($filename, PATHINFO_FILENAME);
		$FileExtension = '.' . pathinfo($filename, PATHINFO_EXTENSION);
		
		$newpath = $path . $filename;
		$newname = $filename;
		$counter = 0;
		while(file_exists($newpath)){
			$newname = $FileNameNoExtension . '-' . $counter . $FileExtension;
			$newpath = $path . $newname;
			$counter++;
		}
		
		return $newname;
	}
	
	#----------------------------------------------------------------------------------------------------------------
	#----------------------------------------------- End Of Functions -----------------------------------------------
	#----------------------------------------------------------------------------------------------------------------
	
	if($qType == "getComments"){
		$qid = $_POST['qid'];
		$commResults = getComments($objCon, $qid);
		
		$commentData = ''; 
		while($comRow = sqlsrv_fetch_array($commResults)){
			$commentValue = '';
			if($comRow["CommentSubType"] == 'FileUpload'){
				$commentValue = "<b>Uploaded: </b>". $comRow["Comment"];
			}else{
				$commentValue = $comRow["Comment"];
			}
			$commentData .= 
			'<div id="'. $comRow["UserType"] .'-comment" class="comment-data-display">
				<div id="Comment-Top"><div id="Comment-User-Name">'. $comRow["UserName"] .'</div><div id="Comment-Date-Time">'. $comRow["DateCreated"]->format('d/m/Y H:i') .'</div></div>	
				<div id="Comment-Content">'. $commentValue .'</div>	
			</div>';		
		}
		
		echo $commentData;
			
	}elseif($qType == "addComment"){
		$qid = $_POST['qid'];
		$commentVal = $_POST['commentVal'];
		$userID = $_POST['userID'];
		$userRollID = $_POST['userRollID'];
		$returnVal = "";
						
		$comNumVal = getCommentNo($objCon, $qid);
		$comNewNumVal = $comNumVal + 1;
		$comSubTypeVal = "comment";
		$queryStatusVal = "In Progress";
		$queryUserTypeVal = "None";		
		if($userRollID == 5){			
			$queryUserTypeVal = "Mentor";
			$frExists = doesFirstReplyCommentExist($objCon,$qid);
			if(!$frExists){
				$comSubTypeVal = "First Reply";
			}else{
				//$queryStatusVal = "New Claim";
				$uqsSql = "UPDATE support.Queries SET Status = '$queryStatusVal' WHERE QueryID = '$qid'";
				$uqStatusOpen = sqlsrv_query($objCon, $uqsSql);
				
				if($uqStatusOpen){
					$returnVal .= " Updated comment successfully";
				} else {
					$returnVal .= " Error: " . $uqStatusOpen . "</br>" . sqlsrv_errors($objCon);
				}
			}	
		}elseif($userRollID == 21){
			$queryUserTypeVal = "Participant";
			
		}
		$addComSql = "INSERT INTO support.Comments (QueryID, Comment, UserType, CommentNo, CommentType, CommentSubType, UserID)
		VALUES('$qid','$commentVal','$queryUserTypeVal','$comNewNumVal','Comment','$comSubTypeVal','$userID')";		
		$addComQuery = sqlsrv_query($objCon, $addComSql);		
		
		if($addComQuery){
			$returnVal .= " Added new comment successfully ";
		} else {
			$returnVal .= " Error: " . $addComQuery . "</br>" . sqlsrv_errors($objCon);
		}
		
		echo $returnVal;
		
	}elseif($qType == "addAdminComment"){
		//code for admin adding comments
	}elseif($qType == "addMentorFinalComment"){
		$qid = $_POST['qid'];
		$mid = $_POST['mid'];
		$NoteDesc = $_POST['NoteDesc'];
		$ConType = $_POST['ConType'];
		$hoursSpent = $_POST['HoursSpent'];
		$minutesSpent = $_POST['MinutesSpent'];
		$queryRatingNum = $_POST['MentorQueryRating'];
		$queryRatingComment = $_POST['MentorQueryRatingComment'];
		$returnVal = "";		
		$addNoteSql = "INSERT INTO support.QueryNotes (QueryID, MentorID, Description, ContactID, HoursSpent, MinutesSpent, MentorRating, MentorRatingComment)
		VALUES('$qid','$mid','$NoteDesc','$ConType', '$hoursSpent', '$minutesSpent', '$queryRatingNum', '$queryRatingComment')";			
		
		$addNoteQuery = sqlsrv_query($objCon, $addNoteSql);	
		$closeQuerySql = "UPDATE support.Queries SET Status = 'Closed' WHERE QueryID = '$qid'";
		$closeQuery = sqlsrv_query($objCon, $closeQuerySql);
		
		if($addNoteQuery){
			$returnVal .= " Added new comment successfully ";
		} else {
			$returnVal .= " Error: " . $addNoteQuery . "</br>" . sqlsrv_errors($objCon);
		}
		
		echo $returnVal;
	}elseif($qType == "unclaimMentorQuery"){
		$qid = $_POST['qid'];
		$reasonVal = $_POST['reasonVal'];
		$categoryProvided = $_POST['categoryProvided'];
		if($categoryProvided == "Yes"){
			$categoryVal = $_POST['categoryVal'];
			$ucqSql = "UPDATE support.Queries SET Status = 'Open', MentorID = NULL, CategoryID = '$categoryVal' WHERE QueryID = '$qid'";
		}else{		
			$ucqSql = "UPDATE support.Queries SET Status = 'Open', MentorID = NULL WHERE QueryID = '$qid'";
		}
		$ucReasonSql = "INSERT INTO support.unclaimReasons (unclaimReason, unclaimQueryID) VALUES ('$reasonVal', '$qid')";
		$ucqQuery = sqlsrv_query($objCon, $ucqSql);
		$ucReasonQuery = sqlsrv_query($objCon, $ucReasonSql);
		$returnVal = "";
		if($ucqQuery){
			$returnVal .= " Unclaimed Query successfully";
		} else {
			$returnVal .= " Error: " . $ucqQuery . "</br>" . sqlsrv_errors($objCon);
		}
		if($ucReasonQuery){
			$returnVal .= " Added Reason for unclaim successfully";
		} else {
			$returnVal .= " Error: " . $ucReasonQuery . "</br>" . sqlsrv_errors($objCon);
		}
		echo $returnVal;
		
	}elseif($qType == "getCategories"){
		$catResult = getCategories($objCon);		
		
		$categoryData = '<option value="-1">Select Category</option>';
		while($catRow = sqlsrv_fetch_object($catResult)){ 									 
	
			$categoryData .= '<option value="'. $catRow->CategoryID .'">' .$catRow->CategoryDescription .'</option>';
								
		}
		echo $categoryData;
	}elseif($qType == "getContactTypes"){
		$contpResult = getContactType($objCon);
		
		$contactData = '<option value="-1">Select ContactType</option>';
		while($contpRow = sqlsrv_fetch_object($contpResult)){ 									 
	
		$contactData .= '<option value="'. $contpRow->ContactTypeID .'">'. $contpRow->ContactTypeDescription .'</option>';
								
		}
		echo $contactData;
	}elseif($qType == "getRecepientDetails"){
		$userID = $_POST['urid'];
		$qid = $_POST['qid'];
		$userType = "unknown";
		$recepientDetails = '';
		if($userID == 5){
			$recipResult = getParticipantAccount($objCon, $userID);
			$recipRow = sqlsrv_fetch_array($recipResult, SQLSRV_FETCH_ASSOC);
			$recepientDetails = '
			<div id="recepientProfilePic">
				<img src="../site-images/profiles/business/'.$recipRow["ImageURL"].'" style="width:100px;height:100px; border-radius:50%" alt="fetola">
			</div>
			<div id="recepientProfileData">
				<span>'.$recipRow["Participant"].'</span>
				<span>'.$recipRow["Email"].'</span>
				<span>'.$recipRow["Contact"].'</span>
			</div>
			';
		}elseif($userID == 21){			
			$recipResult = getMentorAccount($objCon, $qid);
			$recipRow = sqlsrv_fetch_array($recipResult, SQLSRV_FETCH_ASSOC);
			$recepientDetails = '
			<div id="recepientProfilePic">
				<img src="../site-images/profiles/mentor/'.$recipRow["ImageURL"].'" style="width:100px;height:100px;" alt="fetola">
			</div>
			<div id="recepientProfileData">
				<span>'.$recipRow["Mentor"].'</span>
				<span>'.$recipRow["Email"].'</span>
				<span>'.$recipRow["Contact"].'</span>
			</div>
			';
		}		
		echo $recepientDetails;
	}elseif($qType == "uploadFile"){
		$qid = $_POST['qid'];
		$userID = $_POST['uid'];
		$userRollID = $_POST['userRollID'];	
		$comNumVal = getCommentNo($objCon, $qid);
		$comNewNumVal = $comNumVal + 1;		
		$filePathName = '../site-uploads/queryUploadedFiles/';
		$originalFileName = $_FILES['file']['name'];
		$fileName = CheckAndChangeFileName($filePathName, $originalFileName);
		$fileNameWithPath = $filePathName . $fileName;		
		move_uploaded_file($_FILES['file']['tmp_name'], $fileNameWithPath);		
		$commentVal = '<a href="'.$fileNameWithPath.'">'.$fileName.'</a>';
		$userType = "unknown";
		$returnVal = '';
		if($userRollID == 5){
			$uploadFileCommentSql = "INSERT INTO support.Comments (QueryID, Comment, UserType, CommentNo, CommentType, CommentSubType, UserID)
			VALUES('$qid','$commentVal','Mentor', '$comNewNumVal', 'Comment', 'FileUpload', '$userID')";			
			$uploadFileCommentQuery = sqlsrv_query($objCon, $uploadFileCommentSql);
			if($uploadFileCommentQuery){
				$returnVal .= " Added new comment successfully ";
			} else {
				$returnVal .= " Error: " . sqlsrv_errors($objCon);
			}			
		}elseif($userRollID == 21){			
			$uploadFileCommentSql = "INSERT INTO support.Comments (QueryID, Comment, UserType, CommentNo, CommentType, CommentSubType, UserID)
			VALUES('$qid','$commentVal','Participant', '$comNewNumVal', 'Comment', 'FileUpload', '$userID')";			
			$uploadFileCommentQuery = sqlsrv_query($objCon, $uploadFileCommentSql);
			if($uploadFileCommentQuery){
				$returnVal .= " Added new comment successfully ";
			} else {
				$returnVal .= " Error: " .  sqlsrv_errors($objCon);
			}
		}		
		echo $returnVal;
	}elseif($qType == "getUploadedFiles"){
		$qid = $_POST['qid'];
		$uploadedFiles = getUploadedFiles($objCon, $qid);
		$uploadedFilesReturn = '';			
		while($upfRow = sqlsrv_fetch_array($uploadedFiles, SQLSRV_FETCH_ASSOC)){ 		
			$uploadedFilesReturn .= '<span class="queryFileUploaded">'.$upfRow["Comment"].'</span>';								
		}							
				
		echo $uploadedFilesReturn;
	}
	
	
	
?>	