<?php
	include('../config/database_conn.php');
	session_start();
	
	
	$CBusFil = null;
	$COSFil = null;
	$CMenFil = null;
	if(isset($_GET["CBusFilter"]))
	{
		$CBusFil = $_GET["CBusFilter"];
	}
	if(isset($_GET["COSFilter"]))
	{
		$COSFil = $_GET["COSFilter"];
	}
	$mentorID = $_SESSION["UserID"];
	$mentorRollID = $_SESSION["RollNum"];
	
	if($mentorRollID == 1){
		if(isset($_GET["CMenFilter"]))
		{
			$CMenFil = $_GET["CMenFilter"];
		}
	}
	
	if($mentorRollID == 2){
		if($CBusFil != null && $CBusFil != "All"){
			if($COSFil != null && $COSFil != "All"){
				$mcSql = "SELECT c.MentorClaimID, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID WHERE c.MentorID = '$mentorID' AND c.BusinessID = '$CBusFil' AND c.OnSite = '$COSFil'";
			}else{
				$mcSql = "SELECT c.MentorClaimID, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID WHERE c.MentorID = '$mentorID' AND c.BusinessID = '$CBusFil'";
			}
		}elseif($COSFil != null && $COSFil != "All"){
			$mcSql = "SELECT c.MentorClaimID, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID WHERE c.MentorID = '$mentorID' AND c.OnSite = '$COSFil'";
		}else{
			$mcSql = "SELECT c.MentorClaimID, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID WHERE c.MentorID = '$mentorID'";
		}
	}elseif($mentorRollID == 1){
		if($CBusFil != null && $CBusFil != "All"){
			if($COSFil != null && $COSFil != "All"){
				if($CMenFil != null && $CMenFil != "All"){
					$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID ='$CMenFil' AND c.BusinessID = '$CBusFil' AND c.OnSite = '$COSFil'";
				}else{
					$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND c.BusinessID = '$CBusFil' AND c.OnSite = '$COSFil'";
				}		
			}else{
				if($CMenFil != null && $CMenFil != "All"){
					$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID ='$CMenFil' AND c.BusinessID = '$CBusFil'";
				}else{
					$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND c.BusinessID = '$CBusFil'";
				}
			}
		}elseif($COSFil != null && $COSFil != "All"){
			if($CMenFil != null && $CMenFil != "All"){
				$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID ='$CMenFil' AND c.OnSite = '$COSFil'";
			}else{
				$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID') AND c.OnSite = '$COSFil'";
			}
		}elseif($CMenFil != null && $CMenFil != "All"){
			$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID ='$CMenFil'";
		}else{
			$mcSql = "SELECT c.MentorClaimID, c.MentorID, ment.str_Mentor_Name, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID JOIN mentor.admin ment on ment.int_Mentor_ID = c.MentorID WHERE c.MentorID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID')";
		}
	}
		
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$objQuery = sqlsrv_query( $objCon, $mcSql , $params, $options );
	
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
	
	$mcSqlPages = $mcSql . " ORDER BY c.MentorClaimID OFFSET (".$page." - 1) * ".$per_page." ROWS FETCH NEXT ".$per_page." ROWS ONLY";
	
	$mcQuery = sqlsrv_query($objCon, $mcSqlPages);
	$mcHasRows = sqlsrv_has_rows($mcQuery);

	
	#$mcSql = "SELECT c.MentorClaimID, bus.Bus_Name, c.Duration, c.Mileage, c.AdminReport, c.CellDuration, c.DateCaptured, c.OnSite, c.TollFees, c.Accomodation, c.Description FROM mentor.Claims c JOIN import.TP_Status_Info bus on bus.int_ID_Status = c.BusinessID WHERE c.MentorID = '$mentorID'";
	#$mcQuery = sqlsrv_query($objCon, $mcSql);
	$mcbvSql = "SELECT Bus_Name, int_ID_Status FROM import.TP_Status_Info WHERE Int_Mentor = '$mentorID'";
	$mcbvQuery = sqlsrv_query($objCon, $mcbvSql);
	$mcbvResults = array();
	while($mcbvRows = sqlsrv_fetch_array($mcbvQuery)){
		$mcbvResults[] = $mcbvRows;
	}
	$mcmvSql = "SELECT int_Mentor_ID, str_Mentor_Name FROM mentor.admin WHERE MentorLiaisonID = '$mentorID' OR int_Mentor_ID = '$mentorID' ";
	$mcmvQuery = sqlsrv_query($objCon, $mcmvSql);
	$mcmvResults = array();
	while($mcmvRows = sqlsrv_fetch_array($mcmvQuery)){
		$mcmvResults[] = $mcmvRows;
	}
?>

<html>
	<head>
		<title>Mentor Claims</title>
		<link href="../style-css/styles-mentors.css" rel="stylesheet">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	</head>
	<body>
	
	<!-- The Insert Modal -->
	<div id="claimsModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
		<div class="modal-header">
		  <h2 id="cmodalta">Add Claim</h2>
		  <h2 id="cmodalte">Edit Claim</h2>
		</div>
		<div class="modal-body">
		  
			<form >
				<table id="Mentor-Claims-Form-Table" class="Modal-Content-Section">
					<tr>
						<td style="width:50%">Business</td>
						<td style="width:50%">
						<!--<input type="TEXT" name="SBusInput">-->
							<select name="CBusInput" id="MCBusInput" class="mentorDropDownBox">
								<?php 
									foreach($mcbvResults as $cbusRow){ 									 
								?>
									<option value="<?php echo $cbusRow['int_ID_Status'] ?>"><?php echo $cbusRow['Bus_Name'] ?></option>
								<?php							
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Duration</td>
						<td><input type="NUMBER" name="CDurationInput" id="MCDurationInput" value=0 class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Mileage</td>
						<td><input type="NUMBER" name="CMileageInput" id="MCMileageInput" value=0 class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Admin Report</td>
						<td><input type="NUMBER" name="CARInput" id="MCARInput" value=0 class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Cell Duration</td>
						<td><input type="NUMBER" name="CCDInput" id="MCCDInput" value=0 class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Date Captured</td>
						<td><input type="DATE" name="CDCInput" id="MCDCInput" value="<?php echo date('Y-m-d'); ?>" class="modal-body-input"></td>
					</tr>
					<tr>
						<td>On Site</td>
						<td>Yes<input id="MCOSYES" type="RADIO" name="MCOSInput" value="Yes" class="modal-body-input">No<input id="MCOSNO" type="RADIO" name="MCOSInput" value="No" checked class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Toll Fees</td>
						<td><input type="NUMBER" name="CTFInput" id="MCTFInput" value=0 class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Accomodation</td>
						<td><input type="NUMBER" name="CAccomInput" id="MCAccomInput" value=0 class="modal-body-input"></td>
					</tr>
					<tr>
						<td>Description</td>
						<td><input type="TEXT" name="CDescInput" id="MCDescInput" class="modal-body-input"></td>
					</tr>										
				</table>
				<input type="submit" value="submit" class="addsubmit" name="submit-c-mentor-claim" id="submit-create-mentor-claim">
				<input type="submit" value="update" class="upsubmit" name="submit-u-mentor-claim" id="submit-update-mentor-claim">
			</form>	
		  
			<div class="mc-model-button-group">
				<button id="mcCloseModalBtn">Cancel</button>
			</div>
		</div>
	  </div>

	</div>	
	<!-- End Of Insert Modal -->
	
	<div class="container" id="mccontainer">	
	<?php include('nav.php'); ?>
	<hr>
		<div id="Mentor-Claims" class="data-table-display">
			<div id="Mentor-Claims-Top"><b>My Claims</b><div class="addBtnGroup">
					<form action='' method='GET'>
					Business:<select name="CBusFilter" id="MCBusFilter" class="mentorDropDownBox">
						<option value="All">All</option>
						<?php 
							foreach($mcbvResults as $busRow){ 									 
						?>
							<option value="<?php echo $busRow['int_ID_Status'] ?>" <?php if($busRow['int_ID_Status'] == $CBusFil){ echo "selected='selected'";}?>><?php echo $busRow['Bus_Name'] ?></option>
						<?php							
							}
						?>
					</select>
					On Site:<select name="COSFilter" id="MCOSFilter" class="mentorDropDownBox">						
							<option value="All">All</option>
							<option value="Yes" <?php if($COSFil == "Yes"){ echo "selected='selected'";}?>>Yes</option>
							<option value="No" <?php if($COSFil == "No"){ echo "selected='selected'";}?>>No</option>						
					</select>
					<?php if($mentorRollID == 1){ ?>
					Mentor:<select name="CMenFilter" id="MCMenFilter" class="mentorDropDownBox">
						<option value="All">All</option>
						<?php 
							foreach($mcmvResults as $menRow){ 									 
						?>
							<option value="<?php echo $menRow['int_Mentor_ID'] ?>" <?php if($menRow['int_Mentor_ID'] == $CMenFil){ echo "selected='selected'";}?>><?php echo $menRow['str_Mentor_Name'] ?></option>
						<?php							
							}
						?>
					</select>
					<?php } ?>
					<input type="submit" value="Filter" class="FilterBtn">
					</form>
					<button id="addModalMCBtn">Add Claim</button>
				</div>
			</div>
			<table id="Mentor-Claims-Table" class="Table-Content-Section">
				<?php if($mentorRollID == 2){ ?>
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 20%">Business</th>
						<th style="width: 5%">Duration</th>
						<th style="width: 5%">Mileage</th>
						<th style="width: 5%">Admin Report</th>
						<th style="width: 5%">Cell Duration</th>
						<th style="width: 5%">Date Captured</th>
						<th style="width: 5%">On Site</th>
						<th style="width: 5%">Toll Fees</th>
						<th style="width: 10%">Accomodation</th>
						<th style="width: 30%">Description</th>
						<th style="width: 5%"></th>
					</tr>
				</thead>
				<?php }else{ ?>
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 10%">Mentor</th>
						<th style="width: 10%">Business</th>
						<th style="width: 5%">Duration</th>
						<th style="width: 5%">Mileage</th>
						<th style="width: 5%">Admin Report</th>
						<th style="width: 5%">Cell Duration</th>
						<th style="width: 5%">Date Captured</th>
						<th style="width: 5%">On Site</th>
						<th style="width: 5%">Toll Fees</th>
						<th style="width: 10%">Accomodation</th>
						<th style="width: 30%">Description</th>
						<th style="width: 5%"></th>
					</tr>
				</thead>
				<?php } ?>
				<tbody>					
					<?php
					if($mcHasRows === true){
						while($mcObj = sqlsrv_fetch_object($mcQuery)) {							
						
					?>
					<tr id="<?php echo $mcObj->MentorClaimID ?>" class="tableBodyRow">
						<?php if($mentorRollID == 1){ ?>
						<td>
							<?php echo $mcObj->str_Mentor_Name ?>
						</td>
						<?php } ?>
						<td>
							<?php echo $mcObj->Bus_Name ?>
						</td>
						<td>
							<?php echo $mcObj->Duration ?>
						</td>
						<td>
							<?php echo $mcObj->Mileage ?>
						</td>
						<td>
							<?php echo $mcObj->AdminReport ?>
						</td>
						<td>
							<?php echo $mcObj->CellDuration ?>
						</td>
						<td>
							<?php 
								if($mcObj->DateCaptured === NULL){
									echo $mcObj->DateCaptured;
								} else {
									echo $mcObj->DateCaptured->format('d/m/Y'); 
								}
							?>
									
						</td>
						<td>
							<?php echo $mcObj->OnSite ?>
						</td>
						<td>
							<?php echo $mcObj->TollFees ?>
						</td>
						<td>
							<?php echo $mcObj->Accomodation ?>
						</td>
						<td>
							<?php echo $mcObj->Description ?>
						</td>
						<td>
							<button type="button" class="<?php  if($mentorRollID == 1){if($mcObj->MentorID == $mentorID){echo "editMCBtn";}else{echo "editMCBtnDis";}}else{echo "editMCBtn";} ?>" <?php  if($mentorRollID == 1){if($mcObj->MentorID !== $mentorID){echo "disabled";}} ?> >Edit</button>
						</td>
					</tr>
					<?php
						}
					}else{ echo "<tr><td colspan='100%' class='tableNoRows'>There are no claims associated with this mentor.</td></tr>"; }
					?>
				</tbody>
			</table>
			<div class="pagination">
				Page :
				<?php
				if($prev_page)
				{
					echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$prev_page&CBusFilter=$CBusFil&COSFilter=$COSFil&CMenFilter=$CMenFil' class='PageButton'>&nbsp; Back &nbsp;</a> ";
				}

				for($i=1; $i<=$num_pages; $i++){
					if($i != $page)
					{
						echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$i&CBusFilter=$CBusFil&COSFilter=$COSFil&CMenFilter=$CMenFil' class='PageButton'>&nbsp; $i &nbsp;</a> ";
					}
					else
					{
						echo "<b class='PageButtonSelected'>&nbsp; $i &nbsp;</b>";
					}
				}
				if($page!=$num_pages)
				{
					echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$next_page&CBusFilter=$CBusFil&COSFilter=$COSFil&CMenFilter=$CMenFil' class='PageButton'>&nbsp;Next&nbsp;</a class='PageButton'> ";
				}
				sqlsrv_close($objCon);
				?>
			</div>		
		</div>		
	</div>


	<script>
	$(document).ready(function(){
		
		var mcmodal = document.getElementById("claimsModal");
		var mccontainer = document.getElementById("mccontainer");
		var mcmodalCreateBtn = document.getElementById("submit-create-mentor-claim");
		var mcmodalUpdateBtn = document.getElementById("submit-update-mentor-claim");
		var mcTCBtn = document.getElementById("cmodalta");
		var mcTUBtn = document.getElementById("cmodalte");
		//insert section
		$(document).on('click', '#addModalMCBtn', function(){	
			mcmodalCreateBtn.style.display = "block";
			mcmodalUpdateBtn.style.display = "none";
			mcTCBtn.style.display = "block";
			mcTUBtn.style.display = "none";
			mcmodal.style.display = "block";
			mccontainer.style.filter = "blur(10px)";
			$(document).on('click', '#submit-create-mentor-claim', function(){
				var caBusID = $('#MCBusInput').val();
				var caDur = $('#MCDurationInput').val();
				var caMil = $('#MCMileageInput').val();
				var caAR = $('#MCARInput').val();
				var caCD = $('#MCCDInput').val();
				var caDCap = $('#MCDCInput').val();
				var caOS = $("input:radio[name='MCOSInput']:checked").val();
				var caTF = $('#MCTFInput').val();
				var caAccom = $('#MCAccomInput').val();
				var caDesc = $('#MCDescInput').val();			
				$.ajax({					
					url: "addMentorClaim.php",
					type: "POST",
					data: {
						"BusID":caBusID,
						"Dur":caDur,
						"Mil":caMil,
						"AR":caAR,
						"CD":caCD,
						"DCap":caDCap,
						"OS":caOS,
						"TF":caTF,
						"Accom":caAccom,
						"Desc":caDesc,
						"MentorID":<?php echo $mentorID?>,
						},
					success: function(response){
						alert(response);
					}
				});
				
			});
		});
		// edit section
		$(document).on('click', '.editMCBtn', function(){
			mcmodalUpdateBtn.style.display = "block";
			mcmodalCreateBtn.style.display = "none";
			mcTUBtn.style.display = "block";	
			mcTCBtn.style.display = "none";	
			mccontainer.style.filter = "blur(10px)";			
			$mctrID = $(this).closest('tr').attr('id');
					
			$.ajax({					
				url: "getClaimsRow.php",
				type: "POST",
				data: {	"cID":$mctrID	},
				success: function(data){
					var datarow = JSON.parse(data);
					$('#MCBusInput').val(datarow.BusinessID);
					$('#MCDurationInput').val(datarow.Duration);
					$('#MCMileageInput').val(datarow.Mileage);
					$('#MCARInput').val(datarow.AdminReport);
					$('#MCCDInput').val(datarow.CellDuration);					
					$('#MCDCInput').val(datarow.DateCaptured);					
					if(datarow.OnSite === 'Yes'){
						$("#MCOSYES").prop("checked", true);
					} else {
						$("#MCOSNO").prop("checked", true);
					}					
					$('#MCTFInput').val(datarow.TollFees);
					$('#MCAccomInput').val(datarow.Accomodation);
					$('#MCDescInput').val(datarow.Description);
					
				}
			});
			mcmodal.style.display = "block";
			$(document).on('click', '#submit-update-mentor-claim', function(){
				var ceBusID = $('#MCBusInput').val();
				var ceDur = $('#MCDurationInput').val();
				var ceMil = $('#MCMileageInput').val();
				var ceAR = $('#MCARInput').val();
				var ceCD = $('#MCCDInput').val();
				var ceDCap = $('#MCDCInput').val();
				var ceOS = $("input:radio[name='MCOSInput']:checked").val();
				var ceTF = $('#MCTFInput').val();
				var ceAccom = $('#MCAccomInput').val();
				var ceDesc = $('#MCDescInput').val();
				$.ajax({					
					url: "editMentorClaim.php",
					type: "POST",
					data: {
						"BusID":ceBusID,
						"Dur":ceDur,
						"Mil":ceMil,
						"AR":ceAR,
						"CD":ceCD,
						"DCap":ceDCap,
						"OS":ceOS,
						"TF":ceTF,
						"Accom":ceAccom,
						"Desc":ceDesc,
						"mcID":$mctrID,
						},
					success: function(response){
						alert(response);
					}
				});
			
			});
			
		});
		
		$(document).on('click', '#mcCloseModalBtn', function(){
			mcmodal.style.display = "none";
			mccontainer.style.filter = "blur(0px)";
		});
		
	});
	</script>
	
	</body>
</html>