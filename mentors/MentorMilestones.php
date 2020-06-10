<?php
	include('../config/database_conn.php');
	session_start();

	$MSBusFil = null;
	$MSICFil = null;
	$MSMenFil = null;
	if(isset($_GET["MSBusFilter"]))
	{
		$MSBusFil = $_GET["MSBusFilter"];
	}
	if(isset($_GET["MSICFilter"]))
	{
		$MSICFil = $_GET["MSICFilter"];
	}
	$mentorID = $_SESSION["UserID"];
	$mentorRollID = $_SESSION["RollNum"];
	
	if($mentorRollID == 1){
		if(isset($_GET["MSMenFilter"]))
		{
			$MSMenFil = $_GET["MSMenFilter"];
		}
	}
	
	if($mentorRollID == 2){
		if($MSBusFil != null && $MSBusFil != "All"){
			if($MSICFil != null && $MSICFil != "All"){
				$mmsSql = "SELECT ms.MilestoneID, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID WHERE ms.MentorID = '$mentorID' AND ms.BusinessID = '$MSBusFil' AND ms.IsComplete = '$MSICFil'";
			}else{
				$mmsSql = "SELECT ms.MilestoneID, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID WHERE ms.MentorID = '$mentorID' AND ms.BusinessID = '$MSBusFil'";
			}
		}elseif($MSICFil != null && $MSICFil != "All"){
			$mmsSql = "SELECT ms.MilestoneID, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID WHERE ms.MentorID = '$mentorID' AND ms.IsComplete = '$MSICFil'";
		}else{
			$mmsSql = "SELECT ms.MilestoneID, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID WHERE ms.MentorID = '$mentorID'";
		}
	}elseif($mentorRollID == 1){
		if($MSBusFil != null && $MSBusFil != "All"){
			if($MSICFil != null && $MSICFil != "All"){
				if($MSMenFil != null && $MSMenFil != "All"){
					$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND ms.BusinessID = '$MSBusFil' AND ms.IsComplete = '$MSICFil' AND ms.MentorID ='$MSMenFil'";
				}else{
					$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND ms.BusinessID = '$MSBusFil' AND ms.IsComplete = '$MSICFil'";
				}		
			}else{
				if($MSMenFil != null && $MSMenFil != "All"){
					$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND ms.BusinessID = '$MSBusFil' AND ms.MentorID ='$MSMenFil'";
				}else{
					$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND ms.BusinessID = '$MSBusFil'";
				}
			}
		}elseif($MSICFil != null && $MSICFil != "All"){
			if($MSMenFil != null && $MSMenFil != "All"){
				$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND ms.IsComplete = '$MSICFil' AND ms.MentorID ='$MSMenFil'";
			}else{
				$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND ms.IsComplete = '$MSICFil'";
			}
		}elseif($MSMenFil != null && $MSMenFil != "All"){
			$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID = '$MSMenFil'";
		}else{
			$mmsSql = "SELECT ms.MilestoneID, ms.MentorID, ment.str_Mentor_Name, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = ms.MentorID WHERE ms.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID')";
		}
	}
		
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$objQuery = sqlsrv_query( $objCon, $mmsSql , $params, $options );
	
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
	
	$mmsSqlPages = $mmsSql . " ORDER BY ms.MilestoneID OFFSET (".$page." - 1) * ".$per_page." ROWS FETCH NEXT ".$per_page." ROWS ONLY";
	
	$mmsQuery = sqlsrv_query($objCon, $mmsSqlPages);
	$mmsHasRows = sqlsrv_has_rows($mmsQuery);
	
	#$mentorID = $_SESSION["UserID"];
	#$mmsSql = "SELECT ms.MilestoneID, bus.Bus_Name, ms.Prog, ms.MilestoneName, ms.Important, ms.IsVerified, ms.IsComplete, ms.DueDate, ms.DateCompleted FROM mentor.Milestones ms JOIN import.TP_Status_Info bus on bus.int_ID_Status = ms.BusinessID WHERE ms.MentorID = '$mentorID'";
	#$mmsQuery = sqlsrv_query($objCon, $mmsSql);
	$mmbvSql = "SELECT Bus_Name, int_ID_Status, Int_Mentor FROM import.TP_Status_Info WHERE Int_Mentor IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID')";
	$mmbvQuery = sqlsrv_query($objCon, $mmbvSql);
	$mmbvResults = array();
	while($mmbvRows = sqlsrv_fetch_array($mmbvQuery)){
		$mmbvResults[] = $mmbvRows;
	}
	$mmmvSql = "SELECT int_Mentor_ID, str_Mentor_Name FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID' ";
	$mmmvQuery = sqlsrv_query($objCon, $mmmvSql);
	$mmmvResults = array();
	while($mmmvRows = sqlsrv_fetch_array($mmmvQuery)){
		$mmmvResults[] = $mmmvRows;
	}
?>

<html>
	<head>
		<title>Mentor Milestones</title>
		<link href="../style-css/styles-mentors.css" rel="stylesheet">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	</head>
	<body>
	
	
	<!-- The Insert Modal -->
	<div id="milestoneModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
		<div class="modal-header">
		  <h2 id="msmodalta">Add Milestone</h2>
		  <h2 id="msmodalte">Edit Milestone</h2>
		</div>
		<div class="modal-body">
		  
			<form >
				<table id="Add-Mentor-Sessions-Table" class="Modal-Content-Section">
					<tr>
						<td style="width:50%">Business</td>
						<td style="width:50%">
						<!--<input type="TEXT" name="SBusInput">-->
							<select name="MBusInput" id="MMBusInput" class="mentorDropDownBox">
								<?php 
									foreach($mmbvResults as $mbusRow){ 
										if($mbusRow['Int_Mentor'] == $mentorID){
								?>
									<option value="<?php echo $mbusRow['int_ID_Status'] ?>"><?php echo $mbusRow['Bus_Name'] ?></option>
								<?php
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Prog</td>
						<td><input type="TEXT" name="MProgInput" id="MMProgInput" class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Milestone</td>
						<td><input type="TEXT" name="MMilestoneInput" id="MMMilestoneInput" class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Important</td>
						<td>Yes<input id="MMIYES" type="RADIO" name="MIInput" value="Yes" class="modal-body-input">No<input id="MMINO" type="RADIO" name="MIInput" value="No" checked class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Is Verified</td>
						<td>Yes<input id="MMIVYES" type="RADIO" name="MIVInput" value="Yes" class="modal-body-input">No<input id="MMIVNO" type="RADIO" name="MIVInput" value="No" checked class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Is Complete</td>
						<td>Yes<input id="MMICYES" type="RADIO" name="MICInput" value="Yes" class="modal-body-input">No<input id="MMICNO" type="RADIO" name="MICInput" value="No" checked class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Date Due</td>
						<td><input type="DATE" name="MDDueInput" id="MMDDueInput" value="<?php echo date('Y-m-d'); ?>" class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Date Completed</td>
						<td><input type="DATE" name="MDComInput" id="MMDComInput" value="<?php echo date('Y-m-d'); ?>" class="modal-body-input"></td>
					</tr>
					<tr>
						<td class="modal-submit-section">
							<input type="submit" value="submit" class="addsubmit" name="submit-c-mentor-milestone" id="submit-create-mentor-milestone">
							<input type="submit" value="update" class="upsubmit" name="submit-u-mentor-milestone" id="submit-update-mentor-milestone">
						</td>
					</tr>					
				</table>				
			</form>	
		  
			<div class="mms-model-button-group">
				<button id="mmsCloseModalBtn">Cancel</button>
			</div>
		</div>
	  </div>

	</div>	
	<!-- End Of Insert Modal -->
	
	
	<div class="container" id="mmscontainer">	
	<?php include('nav.php'); ?>
	<hr>
		<div id="Mentor-Milestones" class="data-table-display">
			<div id="Mentor-Milestones-Top"><b>My Milestones</b><div class="addBtnGroup">
					<form action='' method='GET'>
					Business:<select name="MSBusFilter" id="MMSBusFilter" class="mentorDropDownBox">
						<option value="All">All</option>
						<?php 
							foreach($mmbvResults as $busRow){ 									 
						?>
							<option value="<?php echo $busRow['int_ID_Status'] ?>" <?php if($busRow['int_ID_Status'] == $MSBusFil){ echo "selected='selected'";}?>><?php echo $busRow['Bus_Name'] ?></option>
						<?php							
							}
						?>
					</select>
					Is Complete:<select name="MSICFilter" id="MMSICFilter" class="mentorDropDownBox">						
							<option value="All">All</option>
							<option value="Yes" <?php if($MSICFil == "Yes"){ echo "selected='selected'";}?>>Yes</option>
							<option value="No" <?php if($MSICFil == "No"){ echo "selected='selected'";}?>>No</option>						
					</select>
					<?php if($mentorRollID == 1){ ?>
					Mentor:<select name="MSMenFilter" id="MMSMenFilter" class="mentorDropDownBox">
						<option value="All">All</option>
						<?php 
							foreach($mmmvResults as $menRow){ 									 
						?>
							<option value="<?php echo $menRow['int_Mentor_ID'] ?>" <?php if($menRow['int_Mentor_ID'] == $MSMenFil){ echo "selected='selected'";}?>><?php echo $menRow['str_Mentor_Name'] ?></option>
						<?php							
							}
						?>
					</select>
					<?php } ?>
					<input type="submit" value="Filter" class="FilterBtn">
					</form>
					<button id="addModalMMSBtn">Add Milestone</button>					
				</div>
			</div>	
			<table id="Mentor-Milestones-Table" class="Table-Content-Section">
				<?php if($mentorRollID == 2){ ?>
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 20%">Business</th>
						<th style="width: 4%">Prog</th>
						<th style="width: 40%">Milestone</th>
						<th style="width: 6%">Important</th>
						<th style="width: 6%">Is Verified</th>
						<th style="width: 6%">Is Complete</th>
						<th style="width: 7%">Due Date</th>
						<th style="width: 7%">Completed Date</th>
						<th style="width: 4%"></th>
					</tr>
				</thead>
				<?php }else{ ?>
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 10%">Mentor</th>
						<th style="width: 10%">Business</th>
						<th style="width: 4%">Prog</th>
						<th style="width: 40%">Milestone</th>
						<th style="width: 6%">Important</th>
						<th style="width: 6%">Is Verified</th>
						<th style="width: 6%">Is Complete</th>
						<th style="width: 7%">Due Date</th>
						<th style="width: 7%">Completed Date</th>
						<th style="width: 4%"></th>
					</tr>
				</thead>
				<?php } ?>
				<tbody>					
					<?php
						if($mmsHasRows === true){
							while($mmsObj = sqlsrv_fetch_object($mmsQuery)) {							
						
					?>
					<tr id="<?php echo $mmsObj->MilestoneID ?>" class="tableBodyRow">
						<?php if($mentorRollID == 1){ ?>
						<td>
							<?php echo $mmsObj->str_Mentor_Name ?>
						</td>
						<?php } ?>
						<td>
							<div id="mmsB"><?php echo $mmsObj->Bus_Name ?></div>
						</td>
						<td>
							<div id="mmsP"><?php echo $mmsObj->Prog ?></div>
						</td>
						<td>
							<div id="mmsMN"><?php echo $mmsObj->MilestoneName ?></div>
						</td>
						<td>
							<div id="mmsI"><?php echo $mmsObj->Important ?></div>
						</td>
						<td>
							<div id="mmsIV"><?php echo $mmsObj->IsVerified ?></div>
						</td>
						<td>
							<div id="mmsIC"><?php echo $mmsObj->IsComplete ?></div>
						</td>
						<td>
							<div id="mmsDD"><?php 
								if($mmsObj->DueDate === NULL){
									echo $mmsObj->DueDate;
								} else {
									echo $mmsObj->DueDate->format('d/m/Y'); 
								}	
							?>
							</div>
						</td>
						<td>
							<div id="mmsDC">
							<?php 
								if($mmsObj->DateCompleted === NULL){
									echo $mmsObj->DateCompleted;
								} else {
									echo $mmsObj->DateCompleted->format('d/m/Y');
								}
							?>
							</div>
						</td>
						<td>
							<button type="button" class="<?php  if($mentorRollID == 1){if($mmsObj->MentorID == $mentorID){echo "editMMSBtn";}else{echo "editMMSBtnDis";}}else{echo "editMMSBtn";} ?>" <?php  if($mentorRollID == 1){if($mmsObj->MentorID !== $mentorID){echo "disabled";}} ?> >Edit</button>							
						</td>
					</tr>
					<?php
							}
						}else{ echo "<tr><td colspan='100%' class='tableNoRows'>There are no milestones associated with this mentor.</td></tr>"; }
					?>
				</tbody>
			</table>
			<div class="pagination">
				Page :
				<?php
				if($prev_page)
				{
					echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$prev_page&MSBusFilter=$MSBusFil&MSICFilter=$MSICFil' class='PageButton'>&nbsp; Back &nbsp;</a> ";
				}

				for($i=1; $i<=$num_pages; $i++){
					if($i != $page)
					{
						echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$i&MSBusFilter=$MSBusFil&MSICFilter=$MSICFil' class='PageButton'>&nbsp; $i &nbsp;</a> ";
					}
					else
					{
						echo "<b class='PageButtonSelected'>&nbsp; $i &nbsp;</b>";
					}
				}
				if($page!=$num_pages)
				{
					echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$next_page&MSBusFilter=$MSBusFil&MSICFilter=$MSICFil' class='PageButton'>&nbsp;Next&nbsp;</a class='PageButton'> ";
				}
				sqlsrv_close($objCon);
				?>
			</div>		
		</div>		
	</div>


	<script>
	

	$(document).ready(function(){
		
		var mmsmodal = document.getElementById("milestoneModal");
		var mmscontainer = document.getElementById("mmscontainer");
		var mmsmodalCreateBtn = document.getElementById("submit-create-mentor-milestone");
		var mmsmodalUpdateBtn = document.getElementById("submit-update-mentor-milestone");
		var mmsTCBtn = document.getElementById("msmodalta");
		var mmsTUBtn = document.getElementById("msmodalte");
		//insert section
		$(document).on('click', '#addModalMMSBtn', function(){	
			mmsmodalCreateBtn.style.display = "block";
			mmsmodalUpdateBtn.style.display = "none";
			mmsTCBtn.style.display = "block";
			mmsTUBtn.style.display = "none";
			mmsmodal.style.display = "block";
			mmscontainer.style.filter = "blur(10px)";
			$(document).on('click', '#submit-create-mentor-milestone', function(){
				var maBusID = $('#MMBusInput').val();
				var maProg = $('#MMProgInput').val();
				var maMS = $('#MMMilestoneInput').val();
				var maI = $("input:radio[name='MIInput']:checked").val();
				var maIV = $("input:radio[name='MIVInput']:checked").val();				
				var maIC = $("input:radio[name='MICInput']:checked").val();	
				var maDDue = $('#MMDDueInput').val();
				var maDCom = $('#MMDComInput').val();				
				$.ajax({					
					url: "addMentorMilestone.php",
					type: "POST",
					data: {
						"BusID":maBusID,
						"Prog":maProg,
						"Milestone":maMS,
						"Important":maI,
						"IV":maIV,
						"IC":maIC,
						"DDue":maDDue,
						"DCom":maDCom,
						"MentorID":<?php echo $mentorID?>,
						},
					success: function(response){
						alert(response);
					}
				});
				
			});
		});
		// edit section
		$(document).on('click', '.editMMSBtn', function(){
			mmsmodalUpdateBtn.style.display = "block";
			mmsmodalCreateBtn.style.display = "none";
			mmsTUBtn.style.display = "block";	
			mmsTCBtn.style.display = "none";
			mmscontainer.style.filter = "blur(10px)";			
			$mmstrID = $(this).closest('tr').attr('id');

						
			$.ajax({					
				url: "getMilestoneRow.php",
				type: "POST",
				data: {	"mID":$mmstrID	},
				success: function(data){
					var datarow = JSON.parse(data);					
					$('#MMBusInput').val(datarow.BusinessID);
					$('#MMProgInput').val(datarow.Prog);
					$('#MMMilestoneInput').val(datarow.MilestoneName);
					if(datarow.Important === 'Yes'){
						$("#MMIYES").prop("checked", true);
					} else {
						$("#MMINO").prop("checked", true);
					}
					if(datarow.IsVerified === 'Yes'){
						$("#MMIVYES").prop("checked", true);
					} else {
						$("#MMIVNO").prop("checked", true);
					}
					if(datarow.IsComplete === 'Yes'){
						$("#MMICYES").prop("checked", true);
					} else {
						$("#MMICNO").prop("checked", true);
					}
					
					$('#MMDDueInput').val(datarow.DueDate);
					if(datarow.DateCompleted === null){
						var dateNow = new Date().toISOString().split('T')[0];
						$('#MMDComInput').val(dateNow);
					} else {
						$('#MMDComInput').val(datarow.DateCompleted);
					}
				}
			});
			mmsmodal.style.display = "block";
			$(document).on('click', '#submit-update-mentor-milestone', function(){
				var meBusID = $('#MMBusInput').val();
				var meProg = $('#MMProgInput').val();
				var meMS = $('#MMMilestoneInput').val();
				var meI = $("input:radio[name='MIInput']:checked").val();
				var meIV = $("input:radio[name='MIVInput']:checked").val();
				var meIC = $("input:radio[name='MICInput']:checked").val();
				var meDDue = $('#MMDDueInput').val();
				var meDCom = $('#MMDComInput').val();
								
				$.ajax({					
					url: "editMentorMilestone.php",
					type: "POST",
					data: {
						"BusID":meBusID,
						"Prog":meProg,
						"Milestone":meMS,
						"Important":meI,
						"IV":meIV,
						"IC":meIC,
						"DDue":meDDue,
						"DCom":meDCom,						
						"msID":$mmstrID,
						},
					success: function(response){
						alert(response);
					}
				});
			
			});
			
		});
		
		$(document).on('click', '#mmsCloseModalBtn', function(){
			mmsmodal.style.display = "none";
			mmscontainer.style.filter = "blur(0px)";
		});
		
	});
	</script>
	
	</body>
</html>