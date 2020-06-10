<?php
	include('../config/database_conn.php');
	session_start();
	
	$SBusFil = null;
	$SICFil = null;
	$SMenFil = null;
	if(isset($_GET["SBusFilter"]))
	{
		$SBusFil = $_GET["SBusFilter"];
	}
	if(isset($_GET["SICFilter"]))
	{
		$SICFil = $_GET["SICFilter"];
	}
	
	$mentorID = $_SESSION["UserID"];
	$mentorRollID = $_SESSION["RollNum"];
	
	if($mentorRollID == 1){
		if(isset($_GET["SMenFilter"]))
		{
			$SMenFil = $_GET["SMenFilter"];
		}
	}
	
	
	if($mentorRollID == 2){
		if($SBusFil != null && $SBusFil != "All"){
			if($SICFil != null && $SICFil != "All"){
				$msSql = "SELECT s.SessionID, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete  FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID WHERE s.MentorID = '$mentorID' AND s.BusinessID = '$SBusFil' AND s.IsComplete = '$SICFil'";
			}else{
				$msSql = "SELECT s.SessionID, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete  FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID WHERE s.MentorID = '$mentorID' AND s.BusinessID = '$SBusFil'";
			}
		}elseif($SICFil != null && $SICFil != "All"){
			$msSql = "SELECT s.SessionID, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete  FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID WHERE s.MentorID = '$mentorID' AND s.IsComplete = '$SICFil'";
		}else{
			$msSql = "SELECT s.SessionID, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete  FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID WHERE s.MentorID = '$mentorID'";
		}
	}elseif($mentorRollID == 1){
		if($SBusFil != null && $SBusFil != "All"){
			if($SICFil != null && $SICFil != "All"){
				if($SMenFil != null && $SMenFil != "All"){
					$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID in (select int_Mentor_ID from mentor.admin where MentorLiaisonID = '$mentorID' or int_Mentor_ID = '$mentorID') AND s.BusinessID = '$SBusFil' AND s.IsComplete = '$SICFil' AND s.MentorID ='$SMenFil'";
				}else{
					$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID in (select int_Mentor_ID from mentor.admin where MentorLiaisonID = '$mentorID' or int_Mentor_ID = '$mentorID') AND s.BusinessID = '$SBusFil' AND s.IsComplete = '$SICFil'";
				}		
			}else{
				if($SMenFil != null && $SMenFil != "All"){
					$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID in (select int_Mentor_ID from mentor.admin where MentorLiaisonID = '$mentorID' or int_Mentor_ID = '$mentorID') AND s.BusinessID = '$SBusFil' AND s.MentorID ='$SMenFil'";
				}else{
					$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID in (select int_Mentor_ID from mentor.admin where MentorLiaisonID = '$mentorID' or int_Mentor_ID = '$mentorID') AND s.BusinessID = '$SBusFil'";
				}
			}
		}elseif($SICFil != null && $SICFil != "All"){
			if($SMenFil != null && $SMenFil != "All"){
				$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID in (select int_Mentor_ID from mentor.admin where MentorLiaisonID = '$mentorID' or int_Mentor_ID = '$mentorID') AND s.IsComplete = '$SICFil' AND s.MentorID ='$SMenFil'";
			}else{
				$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID in (select int_Mentor_ID from mentor.admin where MentorLiaisonID = '$mentorID' or int_Mentor_ID = '$mentorID') AND s.IsComplete = '$SICFil'";
			}
		}elseif($SMenFil != null && $SMenFil != "All"){
			$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID = '$SMenFil'";
		}else{
			$msSql = "SELECT s.SessionID, s.MentorID, ment.str_Mentor_Name, bus.Bus_Name, s.Subject, s.Description, s.Date, s.IsComplete FROM mentor.Session s JOIN import.TP_Status_Info bus on bus.int_ID_Status = s.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = s.MentorID WHERE s.MentorID in (select int_Mentor_ID from mentor.admin where MentorLiaisonID = '$mentorID' or int_Mentor_ID = '$mentorID')";
		}
	}
	
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$objQuery = sqlsrv_query( $objCon, $msSql , $params, $options );
	
	$num_rows = sqlsrv_num_rows($objQuery);

	$per_page = 6;   // Per Page
	$page  = 1;
	
	if(isset($_GET["Page"]))
	{
		$page = $_GET["Page"];
	}

	$prev_page = $page-1;
	$next_page = $page+1;

	$row_start = (($per_page*$page)-$per_page);
	if($num_rows<=$per_page)
	{
		$num_pages =1;
	}
	else if(($num_rows % $per_page)==0)
	{
		$num_pages =($num_rows/$per_page) ;
	}
	else
	{
		$num_pages =($num_rows/$per_page)+1;
		$num_pages = (int)$num_pages;
	}
	$row_end = $per_page * $page;
	if($row_end > $num_rows)
	{
		$row_end = $num_rows;
	}
	
	$msSqlPages = $msSql . " ORDER BY s.SessionID OFFSET (".$page." - 1) * ".$per_page." ROWS FETCH NEXT ".$per_page." ROWS ONLY";
	
	$msQuery = sqlsrv_query($objCon, $msSqlPages);
	$msHasRows = sqlsrv_has_rows($msQuery);
	
	
	#$msQuery = sqlsrv_query($objCon, $msSql);
	$msbvSql = "SELECT Bus_Name, int_ID_Status FROM import.TP_Status_Info WHERE Int_Mentor = '$mentorID'";
	$msbvQuery = sqlsrv_query($objCon, $msbvSql);
	$msbvResults = array();
	while($msbvRows = sqlsrv_fetch_array($msbvQuery)){
		$msbvResults[] = $msbvRows;
	}
	$msmvSql = "SELECT int_Mentor_ID, str_Mentor_Name FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID' ";
	$msmvQuery = sqlsrv_query($objCon, $msmvSql);
	$msmvResults = array();
	while($msmvRows = sqlsrv_fetch_array($msmvQuery)){
		$msmvResults[] = $msmvRows;
	}
?>

<html>
	<head>
		<title>Mentor Sessions</title>
		<link href="../style-css/styles-mentors.css" rel="stylesheet">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	</head>
	<body>	

	<div id="sessionModal" class="modal">

	  <div class="modal-content">
		<div class="modal-header">
		  <h2 id="smodalta">Add Session</h2>
		  <h2 id="smodalte">Edit Session</h2>
		</div>
		<div class="modal-body">
		  
			<form >
				<table id="Add-Mentor-Sessions-Table" class="Modal-Content-Section">
					<tr>
						<td style="width:50%">Business</td>
						<td style="width:50%">
							<select name="SBusInput" id="MSBusInput" class="mentorDropDownBox">
								<?php 
									foreach($msbvResults as $busRow){ 									 
								?>
									<option value="<?php echo $busRow['int_ID_Status'] ?>"><?php echo $busRow['Bus_Name'] ?></option>
								<?php							
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Subject</td>
						<td><input type="TEXT" name="SSubjectInput" id="MSSubjectInput" class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Description</td>
						<td><input type="TEXT" name="SDescriptionInput" id="MSDescriptionInput" class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Date</td>
						<td><input type="DATE" name="SDateInput" id="MSDateInput" value="<?php echo date('Y-m-d'); ?>" class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Is Complete</td>
						<td>Yes<input id="MSICYES" type="RADIO" name="MSICInput" value="Yes">No<input id="MSICNO" type="RADIO" name="MSICInput" value="No" checked class="modal-body-input"></td>
					</tr>
					<tr>
						<td class="modal-submit-section">
							<input type="submit" value="submit" class="addsubmit" name="submit-c-mentor-session" id="submit-create-mentor-session">
							<input type="submit" value="update" class="upsubmit" name="submit-u-mentor-session" id="submit-update-mentor-session">
						</td>
					</tr>					
				</table>				
			</form>	
		  
			<div class="ms-model-button-group">
				<button id="mcCloseModalBtn">Cancel</button>
			</div>
		</div>
	  </div>
	</div>	
		
	
	<div class="container" id="mscontainer">	
		
	<?php include('nav.php'); ?>
	<hr>		
		<div id="Mentor-Sessions" class="data-table-display">
			<div id="Mentor-Sessions-Top"><b>My Sessions</b><div class="addBtnGroup">
					<form action='' method='GET'>
					Business:<select name="SBusFilter" id="MSBusFilter" class="mentorDropDownBox">
						<option value="All">All</option>
						<?php 
							foreach($msbvResults as $busRow){ 									 
						?>
							<option value="<?php echo $busRow['int_ID_Status'] ?>" <?php if($busRow['int_ID_Status'] == $SBusFil){ echo "selected='selected'";}?>><?php echo $busRow['Bus_Name'] ?></option>
						<?php							
							}
						?>
					</select>
					Is Complete:<select name="SICFilter" id="MSICFilter" class="mentorDropDownBox">						
							<option value="All">All</option>
							<option value="Yes" <?php if($SICFil == "Yes"){ echo "selected='selected'";}?>>Yes</option>
							<option value="No" <?php if($SICFil == "No"){ echo "selected='selected'";}?>>No</option>						
					</select>
					<?php if($mentorRollID == 1){ ?>
					Mentor:<select name="SMenFilter" id="MSMenFilter" class="mentorDropDownBox">
						<option value="All">All</option>
						<?php 
							foreach($msmvResults as $menRow){ 									 
						?>
							<option value="<?php echo $menRow['int_Mentor_ID'] ?>" <?php if($menRow['int_Mentor_ID'] == $SMenFil){ echo "selected='selected'";}?>><?php echo $menRow['str_Mentor_Name'] ?></option>
						<?php							
							}
						?>
					</select>
					<?php } ?>
					<input type="submit" value="Filter" class="FilterBtn">
					</form>
					<button id="addModalMSBtn">Add Session</button>
				</div>
			</div>
			<table id="Mentor-Sessions-Table" class="Table-Content-Section">
				<?php if($mentorRollID == 2){ ?>
				<thead>
					<tr class="tableHeaderRow">
						<th class="SBusCol">Business</th>
						<th class="SSubCol">Subject</th>
						<th class="SDescCol">Description</th>
						<th class="SICCol">Is Complete</th>
						<th class="SDateCol">Date</th>
						<th class="SActionCol"></th>
					</tr>
				</thead>
				<?php }else{ ?>
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 10%">Mentor</th>
						<th style="width: 14%">Business</th>
						<th style="width: 10%">Subject</th>
						<th style="width: 45%">Description</th>
						<th style="width: 8%">Is Complete</th>
						<th style="width: 8%">Date</th>
						<th style="width: 5%"></th>
					</tr>
				</thead>
				<?php } ?>
				<tbody>					
					<?php
						if($msHasRows === true){
						while($msObj = sqlsrv_fetch_object($msQuery)) {							
						
					?>
					<tr id="<?php echo $msObj->SessionID ?>" class="tableBodyRow">
						<?php if($mentorRollID == 1){ ?>
						<td class="SMenCol">
							<div id="msMenVal"><?php echo $msObj->str_Mentor_Name ?></div>
						</td>
						<?php } ?>
						<td class="SBusCol">
							<div id="msBusVal"><?php echo $msObj->Bus_Name ?></div>
						</td>
						<td class="SSubCol">
							<div id="msSubVal"><?php echo $msObj->Subject ?></div>
						</td>
						<td class="SDescCol">
							<div id="msDescVal"><?php echo $msObj->Description ?></div>
						</td>
						<td class="SICCol">
							<div id="msICVal"><?php echo $msObj->IsComplete ?></div>
						</td>
						<td class="SDateCol">
							<div id="msDateVal">
							<?php 
								if($msObj->Date === NULL){
									echo $msObj->Date;
								} else {
									echo $msObj->Date->format('d/m/Y');
								}	
							?>
							</div>
						</td>
						<td class="SActionCol">
							<button type="button" class="<?php  if($mentorRollID == 1){if($msObj->MentorID == $mentorID){echo "editMSBtn";}else{echo "editMSBtnDis";}}else{echo "editMSBtn";} ?>"  <?php  if($mentorRollID == 1){if($msObj->MentorID !== $mentorID){echo "disabled";}} ?>>Edit</button>
						</td>
					</tr>
					<?php
							}
						}else{ echo "<tr><td colspan='100%' class='tableNoRows'>There are no sessions associated with this mentor.</td></tr>"; }	
					?>					
				</tbody>
			</table>
			<div class="pagination">
				Page :
				<?php
				if($prev_page)
				{
					echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$prev_page&SBusFilter=$SBusFil&SICFilter=$SICFil&SMenFilter=$SMenFil' class='PageButton'>&nbsp; Back &nbsp;</a> ";
				}

				for($i=1; $i<=$num_pages; $i++){
					if($i != $page)
					{
						echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$i&SBusFilter=$SBusFil&SICFilter=$SICFil&SMenFilter=$SMenFil' class='PageButton'>&nbsp; $i &nbsp;</a> ";
					}
					else
					{
						echo "<b class='PageButtonSelected'>&nbsp; $i &nbsp;</b>";
					}
				}
				if($page!=$num_pages)
				{
					echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$next_page&SBusFilter=$SBusFil&SICFilter=$SICFil&SMenFilter=$SMenFil' class='PageButton'>&nbsp;Next&nbsp;</a class='PageButton'> ";
				}
				sqlsrv_close($objCon);
				?>
			</div>		
		</div>		
	</div>
		
	<script>
	$(document).ready(function(){
		//insert section
		var msmodal = document.getElementById("sessionModal");
		var mscontainer = document.getElementById("mscontainer");
		var msmodalCreateBtn = document.getElementById("submit-create-mentor-session");
		var msmodalUpdateBtn = document.getElementById("submit-update-mentor-session");
		var msTCBtn = document.getElementById("smodalta");
		var msTUBtn = document.getElementById("smodalte");
		//insert section
		$(document).on('click', '#addModalMSBtn', function(){	
			msmodalCreateBtn.style.display = "block";
			msmodalUpdateBtn.style.display = "none";
			msTCBtn.style.display = "block";
			msTUBtn.style.display = "none";
			msmodal.style.display = "block";
			mscontainer.style.filter = "blur(10px)";
			$(document).on('click', '#submit-create-mentor-session', function(){
				var saBusID = $('#MSBusInput').val();
				var saSubj = $('#MSSubjectInput').val();
				var saDesc = $('#MSDescriptionInput').val();
				var saDate = $('#MSDateInput').val();
				var saIC = $("input:radio[name='MSICInput']:checked").val();				
				$.ajax({					
					url: "addMentorSession.php",
					type: "POST",
					data: {
						"BusID":saBusID,
						"Subj":saSubj,
						"Desc":saDesc,
						"Date":saDate,
						"IC":saIC,
						"MentorID":<?php echo $mentorID?>,
						},
					success: function(response){
						alert(response);
					}
				});
				
			});
		});
		// edit section
		$(document).on('click', '.editMSBtn', function(){			
			msmodalUpdateBtn.style.display = "block";
			msmodalCreateBtn.style.display = "none";
			msTUBtn.style.display = "block";	
			msTCBtn.style.display = "none";
			mscontainer.style.filter = "blur(10px)";
			$trID = $(this).closest('tr').attr('id');
						
			$.ajax({					
				url: "getSessionRow.php",
				type: "POST",
				data: {	"sID":$trID	},
				success: function(data){
					var datarow = JSON.parse(data);
					$('#MSBusInput').val(datarow.BusinessID);
					$('#MSSubjectInput').val(datarow.Subject);
					$('#MSDescriptionInput').val(datarow.Description);
					$('#MSDateInput').val(datarow.Date);
					if(datarow.IsComplete === 'Yes'){
						$("#MSICYES").prop("checked", true);
					} else {
						$("#MSICNO").prop("checked", true);
					}
				}
			});
			msmodal.style.display = "block";
			$(document).on('click', '#submit-update-mentor-session', function(){
				var seBusID = $('#MSBusInput').val();
				var seSubj = $('#MSSubjectInput').val();
				var seDesc = $('#MSDescriptionInput').val();
				var seDate = $('#MSDateInput').val();
				var seIC = $("input:radio[name='MSICInput']:checked").val();				
				$.ajax({					
					url: "editMentorSession.php",
					type: "POST",
					data: {
						"BusID":seBusID,
						"Subj":seSubj,
						"Desc":seDesc,
						"Date":seDate,
						"IC":seIC,
						"sesID":$trID,
						},
					success: function(response){
						alert(response);
					}
				});
			
			});
			
		});
		
		$(document).on('click', '#mcCloseModalBtn', function(){
			msmodal.style.display = "none";
			mscontainer.style.filter = "blur(0px)";
		});
		
	});
	</script>
	
	</body>
</html>