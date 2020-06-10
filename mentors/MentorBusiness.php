<?php
	include('../config/database_conn.php');
	session_start();


	$mentorID = $_SESSION["UserID"];
	$mentorRollID = $_SESSION["RollNum"];
	$mbSql = "SELECT * FROM import.TP_Status_Info WHERE Int_Mentor = '$mentorID'";
	$mbQuery = sqlsrv_query($objCon, $mbSql);
	$mbHasRows = sqlsrv_has_rows($mbQuery);
	$mpSql = "SELECT str_Mentor_Name AS Name, lgn_Username AS UName, str_Mentor_Email AS Email, str_Mentor_Contact AS Contact, CONVERT(varchar, dt_last_login, 23) AS LastLogon, MentorLiaisonID FROM mentor.admin WHERE int_Mentor_ID = '$mentorID'";
	$mpQuery = sqlsrv_query($objCon, $mpSql);
	$mpResult = array();
	$mpResult[] = sqlsrv_fetch_array($mpQuery);
	$mpmlid = $mpResult[0]['MentorLiaisonID'];
	if($mpmlid === null){
		#echo "value is null";
		
	}else{
		#echo "value is: ".$mpmlid;
		$mlpSql = "SELECT str_Mentor_Name AS Name, lgn_Username AS UName, str_Mentor_Email AS Email, str_Mentor_Contact AS Contact, CONVERT(varchar, dt_last_login, 23) AS LastLogon, MentorLiaisonID FROM mentor.admin WHERE int_Mentor_ID = '$mpmlid'";
		$mlpQuery = sqlsrv_query($objCon, $mlpSql);
		$mlpResult = array();
		$mlpResult[] = sqlsrv_fetch_array($mlpQuery);
	}
	
	
	
	if($mentorRollID == 1){
		$mprofilesSql = "SELECT int_Mentor_ID, str_Mentor_Name FROM mentor.admin WHERE MentorLiaisonID = '$mentorID'";
		$mprofilesQuery = sqlsrv_query($objCon, $mprofilesSql);
		
		$mprofileBusSql = "SELECT bus.Bus_Name, bus.TP, bus.Status, men.int_Mentor_ID FROM import.TP_Status_Info bus JOIN mentor.admin men ON men.int_Mentor_ID = bus.Int_Mentor WHERE men.int_Mentor_ID IN (SELECT int_Mentor_ID FROM mentor.admin WHERE MentorLiaisonID = '$mentorID') ORDER BY men.int_Mentor_ID";
		$mprofileBusQuery = sqlsrv_query($objCon, $mprofileBusSql);		
		$mprofileBusResults = array();
		while($mpBusRows = sqlsrv_fetch_array($mprofileBusQuery)){
			$mprofileBusResults[] = $mpBusRows;
		}
	}
?>

<html>
	<head>
		<title>Mentor Business</title>
		<link href="../style-css/styles-mentors.css" rel="stylesheet">
	</head>
	<body>
	<div class="container">	
	<?php include('nav.php'); ?>
	<hr>
		<div id="Mentor-Businesses" class="business-table-display">
			<?php if($mbHasRows === true){ ?>
			<div id="Mentor-Businesses-Top">
				<b>My Businesses</b>
			</div>
			<table id="Mentor-Businesses-Table" class="Table-Content-Section">
				<thead>
					<tr class="tableHeaderRow">
						<th style="width: 65%">Business</th>
						<th style="width: 10%">TP</th>
						<th style="width: 10%">Status</th>						
					</tr>
				</thead>
				<tbody>					
					<?php
						while($mbObj = sqlsrv_fetch_object($mbQuery)) {							
						
					?>
					<tr class="tableBodyRow">
						<td style="width: 65%">
							<?php echo $mbObj->Bus_Name ?>
						</td>
						<td style="width: 10%">
							<?php echo $mbObj->TP ?>
						</td>
						<td style="width: 150px">
							<?php echo $mbObj->Status ?>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			<?php
				}else{ echo "There are no businesses associated with this mentor."; }
			?>
		</div>
		<div id="profiles-section">
			<div id="mentor-profile">
				My Profile
				<hr>
				<table id="mentor-profile-section">
					<tbody>
						<tr>
							<td>Name:</td>
							<td><?php echo $mpResult[0]['Name']?></td>
						</tr>
						<tr>
							<td>User Name:</td>
							<td><?php echo $mpResult[0]['UName']?></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><?php echo $mpResult[0]['Email']?></td>
						</tr>
						<tr>
							<td>Contact:</td>
							<td><?php echo $mpResult[0]['Contact']?></td>
						</tr>					
						<tr>
							<td>Last Login:</td>
							<td><?php echo $mpResult[0]['LastLogon']?></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div id="mentor-liaison-profile">
				<?php if($mpmlid === null){ ?>
					No Mentor Liaison Assigned					
				<?php }else{ ?>
				<table id="mentor-liaison-profile-section">
					Mentor Liaison Profile
					<hr>
					<tbody>						
						<tr>
							<td>Name:</td>
							<td><?php echo $mlpResult[0]['Name']?></td>
						</tr>
						<tr>
							<td>User Name:</td>
							<td><?php echo $mlpResult[0]['UName']?></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><?php echo $mlpResult[0]['Email']?></td>
						</tr>
						<tr>
							<td>Contact:</td>
							<td><?php echo $mlpResult[0]['Contact']?></td>
						</tr>					
						<tr>
							<td>Last Login:</td>
							<td><?php echo $mlpResult[0]['LastLogon']?></td>
						</tr>
					</tbody>
				</table>
				<?php } ?>
			</div>			
		</div>	
		<?php if($mentorRollID == 1){?>
		<div id="mentor-business-profiles">
			<?php
				while($mprofilesObj = sqlsrv_fetch_object($mprofilesQuery)) {										
			?>
				
				<div id="Mentor-Businesses" class="mentor-profile-box">
					<div id="Mentor-Businesses-Top">
						<b><?php echo $mprofilesObj->str_Mentor_Name ?></b>
					</div>
					<div class="Table-Content-Body-Section">
					<table id="Mentor-Businesses-Table" class="Table-Content-Section">
						<thead>
							<tr class="tableHeaderRow">
								<th style="width: 65%">Business</th>
								<th style="width: 10%">TP</th>
								<th style="width: 10%">Status</th>						
							</tr>
						</thead>
						
						<tbody>					
							<?php
								foreach($mprofileBusResults as $mprobusRow) {							
									if($mprobusRow['int_Mentor_ID'] == $mprofilesObj->int_Mentor_ID){
							?>
							<tr class="tableBodyRow">
								<td style="width: 65%">
									<?php echo $mprobusRow['Bus_Name'] ?>
								</td>
								<td style="width: 10%">
									<?php echo $mprobusRow['TP'] ?>
								</td>
								<td style="width: 150px">
									<?php echo $mprobusRow['Status'] ?>
								</td>
							</tr>
							<?php
									}
								}
							?>
						</tbody>
						
					</table>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>		
	</body>
</html>