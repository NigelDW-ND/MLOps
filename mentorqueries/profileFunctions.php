<?php
	include('../config/database_conn.php');
	$func = $_POST['func'];
	
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
	
	
	if($func == "getMentorProfile"){
		$mid = $_POST['mid'];
		$mentorDetailsSQL = "SELECT * FROM mentor.admin where int_Mentor_ID = '$mid'";
		$mentorDetailsQuery = sqlsrv_query($objCon, $mentorDetailsSQL);
		$mdRow = sqlsrv_fetch_array($mentorDetailsQuery, SQLSRV_FETCH_ASSOC);
		$mentorDetails = '';		    	  				
		$mentorDetails .= 
		'<table style="width: 100%; padding: 2px">
		<tr><td>Name</td><td><b>'.$mdRow["str_Mentor_Name"].'</b></td></tr>
		<tr class="RowUnderline"><td>Surname</td><td><b>'.$mdRow["str_Mentor_Surname"].'</b></td></tr>		
		<tr><td>Email Address</td><td><b>'.$mdRow["str_Mentor_Email"].'</b></td></tr>
		<tr><td>Contact Number</td><td><b>'.$mdRow["str_Mentor_Contact"].'</b></td></tr>
		</table>';		
		
		echo $mentorDetails;
	}elseif($func == "getMentorProfilePicture"){
		$mid = $_POST['mid'];
		$mentorImageSQL = "SELECT str_Mentor_image AS Image FROM mentor.admin where int_Mentor_ID = '$mid'";
		$mentorImageQuery = sqlsrv_query($objCon, $mentorImageSQL);
		$miRow = sqlsrv_fetch_array($mentorImageQuery, SQLSRV_FETCH_ASSOC);
		$mentorImagePath = '../site-images/profiles/mentor/'.$miRow["Image"];
		$mentorImage = '';
		if(file_exists($mentorImagePath)){
			$mentorImage .= '<img src="../site-images/profiles/mentor/'.$miRow["Image"].'" width="140" height="140" id="myProfileimg" style="border-radius: 10px;">';
		}else{
			$mentorImage .= '<img src="../site-images/profiles/mentor/users.png" width="140" height="140" id="myProfileimg" style="border-radius: 10px;" alt="Default image not found">';
		}	
		echo $mentorImage;
	}elseif($func == "uploadMentorProfilePicture"){
		$mid = $_POST['mid'];
		$filePathName = '../site-images/profiles/mentor/';
		$originalFileName = $_FILES['file']['name'];
		$fileName = CheckAndChangeFileName($filePathName, $originalFileName);
		$fileNameWithPath = $filePathName . $fileName;		
		move_uploaded_file($_FILES['file']['tmp_name'], $fileNameWithPath);
		
		$mentorUploadImageSQL = "UPDATE mentor.admin SET str_Mentor_image = '$fileName' WHERE int_Mentor_ID = '$mid'";
		$mentorUploadImageQuery = sqlsrv_query($objCon, $mentorUploadImageSQL);
		$returnVal = '';		
		if($mentorUploadImageQuery){
			$returnVal .= " Uploaded Image successfully ";
		}else{
			$returnVal .= " Error: " . sqlsrv_errors($objCon);
		}
		echo $returnVal;
	}elseif($func == "getMentorDescription"){
		$mid = $_POST['mid'];	
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$mentorDescriptionSQL = "SELECT mentorDescription FROM mentor.description WHERE mentorID = '$mid'";
		$mentorDescriptionQuery = sqlsrv_query($objCon, $mentorDescriptionSQL, $params, $options);
		$numRows = sqlsrv_num_rows($mentorDescriptionQuery);
		$menDescVal = '';
		if($numRows == 0){
			$menDescVal = 'No description provided';
		}else{
			$menDescRow = sqlsrv_fetch_array($mentorDescriptionQuery, SQLSRV_FETCH_ASSOC);				
			$menDescVal = $menDescRow["mentorDescription"];
		}			
		
		echo $menDescVal;
	}elseif($func == "updateMentorDescriptionBtn"){
		$mid = $_POST['mid'];	
		$mdesc = $_POST['desc'];	
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$mentorDescriptionSQL = "SELECT mentorDescription FROM mentor.description WHERE mentorID = '$mid'";
		$mentorDescriptionQuery = sqlsrv_query($objCon, $mentorDescriptionSQL, $params, $options);
		$numRows = sqlsrv_num_rows($mentorDescriptionQuery);
		$returnVal = '';
		if($numRows == 0){
			$insertMentorDescriptionSql = "INSERT INTO mentor.description (mentorID, mentorDescription) VALUES ('$mid', '$mdesc')";
			$insertMentorDescriptionQuery = sqlsrv_query($objCon, $insertMentorDescriptionSql);
			if($insertMentorDescriptionQuery){
				$returnVal .= " Uploaded description successfully ";
			}else{
				$returnVal .= " Error: " . sqlsrv_errors($objCon);
			}
		}else{
			$updateMentorDescriptionSql = "UPDATE mentor.description SET mentorDescription = '$mdesc' WHERE mentorID = '$mid'";
			$updateMentorDescriptionQuery = sqlsrv_query($objCon, $updateMentorDescriptionSql);
			if($insertMentorDescriptionQuery){
				$returnVal .= " Uploaded description successfully ";
			}else{
				$returnVal .= " Error: " . sqlsrv_errors($objCon);
			}
		}			
		
		echo $returnVal;
	}elseif($func == "getMentorExperiences"){
		$mid = $_POST['mid'];
		$mentorExperiencesSQL = "SELECT sec.SectorsID, sec.SectorsDescription, CASE WHEN mexp.mentorID = '$mid' THEN 'Yes' ELSE 'No' END AS IsChecked FROM support.Sectors sec
								LEFT JOIN (SELECT * FROM mentor.experience WHERE mentorID = '$mid' AND experienceType = 'experience') mexp ON mexp.ExperienceID = sec.SectorsID";
		$mentorExpertiseSQL = "SELECT cat.CategoryID, cat.CategoryDescription, CASE WHEN mexp.mentorID = '$mid' THEN 'Yes' ELSE 'No' END AS IsChecked FROM support.Categories cat
								LEFT JOIN (SELECT * FROM mentor.experience WHERE mentorID = '$mid' AND experienceType = 'expertise') mexp ON mexp.ExperienceID = cat.CategoryID";
		$mentorExperiencesQuery = sqlsrv_query($objCon, $mentorExperiencesSQL);
		$mentorExpertiseQuery = sqlsrv_query($objCon, $mentorExpertiseSQL);
		$experiencesTable = '';
		$expertiseTable = '';			
		$experiencesTable =
		'<div id="experienceSection">
			<table>
				<thead>
					<tr>
						<th>Majority of my experience is in the following sectors</th>					
					</tr>
				</thead>
				<tbody>';
				while($menExperienceRow = sqlsrv_fetch_array($mentorExperiencesQuery, SQLSRV_FETCH_ASSOC)){
					$experienceChecked = '';
					if($menExperienceRow["IsChecked"] == 'Yes'){
						$experienceChecked = 'Checked';
					}
					$experiencesTable .='	
					<tr>
						<td><input type="checkbox" name="experience" value="'.$menExperienceRow["SectorsID"].'" '.$experienceChecked.'>'.$menExperienceRow["SectorsDescription"].'</td>					
					</tr>';
				}
		$experiencesTable .=			
				'</tbody>
			</table>
		</div>';
		$expertiseTable =
		'<div id="expertiseSection">
			<table>
				<thead>
					<tr>
						<th>My specific areas of expertise</th>				
					</tr>
				</thead>
				<tbody>';
				while($menExpertiseRow = sqlsrv_fetch_array($mentorExpertiseQuery, SQLSRV_FETCH_ASSOC)){
					$expertiseChecked = '';
					if($menExpertiseRow["IsChecked"] == 'Yes'){
						$expertiseChecked = 'Checked';
					}
					$expertiseTable .='	
					<tr>
						<td><input type="checkbox" name="expertise" value="'.$menExpertiseRow["CategoryID"].'" '.$expertiseChecked.'>'.$menExpertiseRow["CategoryDescription"].'</td>					
					</tr>';
				}					
		$expertiseTable .='			
				</tbody>
			</table>
		</div>';
		echo $experiencesTable . $expertiseTable;
	}elseif($func == "addMentorExperience"){
		$mid = $_POST['mid'];	
		$expID = $_POST['exp'];
		$expType = $_POST['exptype'];
		$addMenExpSQL = '';
		$addMenExpSQL = "INSERT INTO mentor.experience (mentorID, experienceType, ExperienceID, experience) VALUES ('$mid', '$expType', '$expID', '')";		
		$addMenExpQuery = sqlsrv_query($objCon, $addMenExpSQL);
		$returnVal = '';
		
		if($addMenExpQuery){
			$returnVal .= " Added Experience successfully ";
		}else{
			$returnVal .= " Error: " . sqlsrv_errors($objCon);
		}					
		
		echo $returnVal;
	}elseif($func == "removeMentorExperience"){
		$mid = $_POST['mid'];	
		$exp = $_POST['exp'];
		$expType = $_POST['exptype'];
		$removeMenExpSQL = '';
		$removeMenExpSQL = "DELETE FROM mentor.experience WHERE mentorID = '$mid' AND ExperienceID = '$exp' AND experienceType = '$expType'";
		$removeMenExpQuery = sqlsrv_query($objCon, $removeMenExpSQL);
		$returnVal = '';
		
		if($removeMenExpQuery){
			$returnVal .= " Removed Experience successfully ";
		}else{
			$returnVal .= " Error: " . sqlsrv_errors($objCon);
		}					
		
		echo $returnVal;
	}elseif($func == "mentorUpdatePassword"){
		$mid = $_POST['mid'];	
		$pass = $_POST['pass'];
		$updateMenPassSQL = "UPDATE mentor.admin SET pwd_Password = '$pass' WHERE int_Mentor_ID = '$mid'";
		$updateMenPassQuery = sqlsrv_query($objCon, $updateMenPassSQL);
		$returnVal = '';
		
		if($updateMenPassQuery){
			$returnVal .= " Updated password successfully ";
		}else{
			$returnVal .= " Error: " . sqlsrv_errors($objCon);
		}					
		
		echo $returnVal;
	}
	
?>

				
		