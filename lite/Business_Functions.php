<?php
	include('../config/database_conn.php');

	if($_POST['func'] == 'Get_profileimage'){
          $GETstatSQL = "SELECT str_participant_image FROM participant.admin WHERE int_participant_ID = ".$_POST['Part_ID'];
          $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
          while($row = sqlsrv_fetch_array($GETstatQuery, SQLSRV_FETCH_ASSOC))
			{
	          $defaultimage = "../site-images/profiles/business/".$row['str_participant_image'];
	          echo "$defaultimage";
	      }
	}

	if($_POST['func'] == 'New_Query'){
		$GETstatSQL = "EXEC support.spr_add_query ".$_POST['UserID'].", ".$_POST['CatID'].", '".$_POST['Comment']."', '".$_POST['Subject']."';";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
	    echo "New Query Submitted";
	  }

	if($_POST['func'] == 'Update_Desc'){
		$GETstatSQL = "EXEC support.update_lite_descr ".$_POST['UserID'].", '".$_POST['Bus_Desc']."';";
		  $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	      $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
	  }

	if($_POST['func'] == 'Accept_Terms'){
		$GETstatSQL = "UPDATE participant.admin SET bt_TermConditions = 'yes' WHERE int_participant_ID = ".$_POST['UserID'].";";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }	
	if($_POST['func'] == 'Update_Business_Contact_Number'){
		$GETstatSQL = "UPDATE participant.admin SET str_participant_Contact = '".$_POST['ContactNum']."' WHERE int_participant_ID = ".$_POST['UserID'].";";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }	
	if($_POST['func'] == 'Update_Business_Sector'){
		$GETstatSQL = "UPDATE import.TP_Status_Info SET Sector = '".$_POST['BusinessSector']."' WHERE Business_GUID = (SELECT id_participant_Guid FROM participant.admin  WHERE int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }	
	 if($_POST['func'] == 'Update_SA_Province'){
		$GETstatSQL = "UPDATE import.TP_Status_Info SET Prov = '".$_POST['ProvinceSel']."' WHERE Business_GUID = (SELECT id_participant_Guid FROM participant.admin  WHERE int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }
	 if($_POST['func'] == 'Update_Business_Registration_Number'){
		$GETstatSQL = "UPDATE support.CompanyDet SET CoRegistration = '".$_POST['Registration_Number']."' WHERE Businessdet_id = (SELECT t.int_ID_Status FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid WHERE a.int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }	
	  if($_POST['func'] == 'Update_BEE_Score'){
		$GETstatSQL = "UPDATE support.CompanyDet SET BEE_Score = '".$_POST['BEE_Score']."' WHERE Businessdet_id = (SELECT t.int_ID_Status FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid WHERE a.int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }
	  if($_POST['func'] == 'Update_Business_Age'){
		$GETstatSQL = "UPDATE support.CompanyDet SET Business_Age = '".$_POST['Business_Age']."' WHERE Businessdet_id = (SELECT t.int_ID_Status FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid WHERE a.int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }	
	  if($_POST['func'] == 'Update_Employee_Count'){
		$GETstatSQL = "UPDATE support.CompanyDet SET Employee_Count = '".$_POST['Employee_Count']."' WHERE Businessdet_id = (SELECT t.int_ID_Status FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid WHERE a.int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }	
	  if($_POST['func'] == 'Update_Annual_Revenue'){
		$GETstatSQL = "UPDATE support.CompanyDet SET Annual_Revenue = '".$_POST['Annual_Revenue']."' WHERE Businessdet_id = (SELECT t.int_ID_Status FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid WHERE a.int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
	   }

	  if($_POST['func'] == 'Update_Business_Description'){
	  	$GETstatSQL = "UPDATE import.TP_Status_Info SET Description = '".$_POST['Description']."' WHERE Business_GUID = (SELECT id_participant_Guid FROM participant.admin  WHERE int_participant_ID = ".$_POST['UserID'].");";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);

	  }		    

	if($_POST['func'] == 'Update_Password'){
		if(!($_POST['Password'] == '')){
		  $GETstatSQL = "UPDATE participant.admin SET pwd_participant = '".$_POST['Password']."' WHERE int_participant_ID = ".$_POST['UserID'].";";
		  $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	      $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
	      echo "Password successfully updated.";
	  }
	}


	if($_POST['func'] == 'Kill_Welcome'){
		  $GETstatSQL = "UPDATE participant.admin SET bt_Welcome = 'no' WHERE int_participant_ID = ".$_POST['UserID'].";";
		  $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	      $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
	      echo "Removed Welcome successfully.";
	}

	if($_POST['func'] == 'Get_Business_Details'){
		$GETstatSQL = "SELECT * FROM FetolaDB.participant.vw_part_view_info where part_id = ".$_POST['Part_ID'].";";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    ?>
	    	<table style="width: 100%; padding: 2px">
	    <?
		while($row = sqlsrv_fetch_array($GETstatQuery, SQLSRV_FETCH_ASSOC))
		{
		?>
			<tr><td>Contact Name</td><td><b><? echo $row['part_name']; ?></b></td></tr>
			<tr class="tr_underline"><td colspan="2"></td></tr>
			<tr><td>Business Name</td><td><b><? echo $row['bus_name']; ?></b></td></tr>
			<tr class="tr_underline"><td colspan="2"></td></tr>
			<tr><td>Email Address</td><td><b><? echo $row['part_email']; ?></b></td></tr>
			<tr><td>Contact Number</td><td><b><? echo $row['part_cont']; ?></b></td></tr>
			</table>
		<?
		}
	}

		if($_POST['func'] == 'Get_Business_Info'){
		$GETstatSQL = "SELECT * FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid INNER JOIN FetolaDB.support.CompanyDet cd ON t.int_ID_Status = cd.Businessdet_id  WHERE a.int_participant_ID = ".$_POST['Part_ID'].";";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    ?>
	    	<table style="width: 100%; padding: 2px">
	    <?
		while($row = sqlsrv_fetch_array($GETstatQuery, SQLSRV_FETCH_ASSOC))
		{
		?>
			<tr><td>Business Name</td><td><b><? echo $row['Bus_Name']; ?></b></td></tr>
			<tr class="tr_underline"><td colspan="2"></td></tr>
			<tr><td>Sector</td><td><b><? echo $row['Sector']; ?></b></td></tr>
			<tr><td>Province</td><td><b><? echo $row['Prov']; ?></b></td></tr>
			<tr><td>Location</td><td><b><? echo $row['Urban/ Rural']; ?></b></td></tr>
			<tr class="tr_underline"><td colspan="2"></td></tr>
			<tr><td>BEE Score</td><td><b><? echo $row['BEE_Score']; ?></b></td></tr></b></td></tr>

			<tr><td>Annual Revenue</td><td><b>R <? echo $row['Annual_Revenue']; ?></b></td></tr>
			<?
				if(!($row['Description'] == '')){?>
			<tr class="tr_underline"><td colspan="2"></td></tr>		
			<tr><td colspan="2">Description:</td></tr>
			<tr><td colspan="2"><pre><? echo $row['Description']; ?></pre></td></tr>
					<?}
			?>
			</table><?


		}
	}
    	if($_POST["func"] == 'image_file2'){

			    if($_SERVER["REQUEST_METHOD"] == "POST"){
			    // Check if file was uploaded without errors
			    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
			        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			        $filename = $_FILES["photo"]["name"];
			        $filetype = $_FILES["photo"]["type"];
			        $filesize = $_FILES["photo"]["size"];
			        $file_ext = substr($filename, strripos($filename, '.')); // get file name
			        $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
			        $timestamp = gmdate("_Ymd_Hms");
					$newfilename = $file_basename . $timestamp . $file_ext;
			    
			        // Verify file extension
			        $ext = pathinfo($filename, PATHINFO_EXTENSION);
			        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
			    
			        // Verify file size - 5MB maximum
			        $maxsize = 5 * 1024 * 1024;
			        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
			    
			        // Verify MYME type of the file
			        if(in_array($filetype, $allowed)){
			            // Check whether file exists before uploading it
			            if(file_exists("../site-images/profiles/business/" . $newfilename)){
			                echo $newfilename . " is already exists.";
			            } else{
			                move_uploaded_file($_FILES["photo"]["tmp_name"], "../site-images/profiles/business/" . $newfilename);
			                $UploadSQL = "UPDATE participant.admin SET str_participant_image = '".$newfilename."' WHERE int_participant_ID = ".$_POST['UserID'].";";
							$UploadQuery = sqlsrv_query($objCon, $UploadSQL);
							$UploadResult = sqlsrv_fetch_array($UploadQuery);


			                echo "Your file was uploaded successfully.";
			            } 
			        } else{
			            echo "Error: There was a problem uploading your file. Please try again."; 
			        }
			    } else{
			        echo "Error: " . $_FILES["photo"]["error"];
			    }
			}

    }
?>

				
		