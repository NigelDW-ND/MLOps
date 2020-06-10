<?php
	include('../config/database_conn.php');
	session_start();


	$mentorID = $_SESSION["UserID"];
	/*To update later 
	$mhalSql = "SELECT 
	al.AlertID
	, bus.Bus_Name
	, al.Description
	, al.TP 
	FROM mentor.Alerts al 
	JOIN import.TP_Status_Info bus on bus.int_ID_Status = al.UserID 
	WHERE al.UserType = 'Participant'
	and al.UserID in (
	SELECT int_ID_Status FROM import.TP_Status_Info WHERE Int_Mentor = '$mentorID'
	)";
	*/
	$mhalSql = "SELECT al.AlertID, bus.Bus_Name, al.Description, al.TP FROM mentor.Alerts al JOIN import.TP_Status_Info bus on bus.int_ID_Status = al.UserID WHERE al.UserType = 'Participant'";
	$mhalQuery = sqlsrv_query($objCon, $mhalSql);
	$mhanSql = "SELECT an.AnnouncementID, an.TP, an.Subject, andet.Description, CONVERT(varchar, andet.Date, 23) AS Date FROM mentor.Announcements an JOIN [mentor].[AnnouncementDetails] andet on andet.AnnouncementID = an.AnnouncementID";
	$mhanQuery = sqlsrv_query($objCon, $mhanSql);
	$mhalResults = array();
	$mhanResults = array();
	while($mhalRows = sqlsrv_fetch_array($mhalQuery)){
		$mhalResults[] = $mhalRows;
	}
	while($mhanRows = sqlsrv_fetch_array($mhanQuery)){
		$mhanResults[] = $mhanRows;
	}
	
?>

<html>
	<head>
		<title>Home</title>

		<link href="../style-css/styles-mentors.css" rel="stylesheet">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	</head>
	<body>
		
	<div id="alertsAndAnnouncementsModal" class="modal">
	  <div class="modal-content">
		<div class="modal-header">
		  <h2 id="malertModal">Alerts</h2>
		  <h2 id="mannouncementModal">Announcements</h2>
		</div>
		<div class="modal-body">
			<div id="aaContentDetails">					
			</div>
			<div class="mh-model-button-group">
				<button id="mhCloseModalBtn">Cancel</button>
			</div>
		</div>
	  </div>
	</div>		

	<div class="container">	
		
	<?php include('nav.php'); ?>
	<hr>
		<div id="Mentor-Alerts" class="data-table-display">
			<img src="../site-images/exclamation.png" style="width:30px;height:30px;position: relative; top:36.5%" alt="!">
			<div id="Mentor-Alerts-Top">
				<b>My Alerts</b>
			</div>
			<table id="Mentor-Alerts-Table" class="Table-Content-Section">
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 30%">Business</th>
						<th style="width: 10%">TP</th>
						<th style="width: 60%">Description</th>
					</tr>
				</thead>
				<tbody>					
					<?php
						foreach($mhalResults as $mhalRows) {							
						
					?>
					<tr id="<?php echo $mhalRows['AlertID'] ?>" class="tableBodyRow">
						<td>
							<div id="mmsB"><?php echo $mhalRows['Bus_Name'] ?></div>
						</td>
						<td>
							<div id="mmsP"><?php echo $mhalRows['TP'] ?></div>
						</td>
						<td>
							<div id="mmsMN"><?php echo $mhalRows['Description'] ?></div>
						</td>						
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		</br>		
		<div id="Mentor-Announcements" class="data-table-display">
			<img src="../site-images/megaphone.png" style="width:40px;height:40px;transform: rotate(-25deg);" alt="megaphone">
			<div id="Mentor-Announcements-Top">
				<b>My Announcements</b>
			</div>
			<table id="Mentor-Announcements-Table" class="Table-Content-Section">
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 20%">TP</th>
						<th style="width: 70%">Announcement</th>
						<th style="width: 10%"></th>
					</tr>
				</thead>
				<tbody>					
					<?php
						$mhanRNum = 0;
						foreach($mhanResults as $mhanRows) {							
						
					?>
					<tr id="<?php echo $mhanRNum ?>" class="tableBodyRow">
						<td>
							<div id="mhanTP"><?php echo $mhanRows['TP'] ?></div>
						</td>
						<td>
							<div id="mhanAnn"><?php echo $mhanRows['Subject'] ?></div>
						</td>
						<td>
							<div id="mhanView"><button type="button" class="viewANBtn" >View</button></div>
						</td>						
					</tr>
					<?php
						$mhanRNum++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>


	<script>
	

	$(document).ready(function(){
		
		var mhmodal = document.getElementById("alertsAndAnnouncementsModal");
		var mhalt = document.getElementById("malertModal");
		var mhant = document.getElementById("mannouncementModal");	

		var annArray = <?php echo json_encode($mhanResults); ?>;
		
		var content = "<table id='mhanModalTable' class='Modal-Content-Section'>"
		content += '<thead><tr><th>Description</th><th>Date</th></tr></thead>';
		content += '<tbody><tr><td><div id="mhanMTDescCol"></div></td><td><div id="mhanMTDateCol"></div></td></tr></tbody>';			
		content += "</table>"

		$('#aaContentDetails').append(content);
		
		// view section
		$(document).on('click', '.viewANBtn', function(){
			mhant.style.display = "block";	
			mhalt.style.display = "none";			
			$mhantrID = $(this).closest('tr').attr('id');
			document.getElementById("mhanMTDescCol").innerHTML = annArray[$mhantrID][3];				
			document.getElementById("mhanMTDateCol").innerHTML = annArray[$mhantrID][4];				
			
			mhmodal.style.display = "block";			
						
		});
		
		$(document).on('click', '#mhCloseModalBtn', function(){
			mhmodal.style.display = "none";
		});
		
		window.onclick = function(event) {
		  if (event.target == mhmodal) {
			mhmodal.style.display = "none";
		  }
		}
		
	});
	</script>
	
	</body>
</html>