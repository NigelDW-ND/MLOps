<!doctype html>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);
	session_start();
	include('../config/database_conn.php');
?>
<html>
<head>
<meta charset="utf-8">
<title>Business Queries</title>
<link href="../../style-css/Styles-part-support.css" rel="stylesheet">
<style type="text/css">
	#InProgress { background:#eb9800; }
	#Closed { background:#8cb300; }
	#Open { background:#007197; }
	#NewClaim { background:#bb529b; } 

			.mentorbus-btn-group {
				width: 130px;
				height: 40px;
				font-size: 15px;
				transition: 0.5s;
				background: url('../site-images/nav_button_blank_spark.png') no-repeat top left;
			}
			.mentorbus-btn-group-select {
				width: 130px;
				height: 40px;
				font-size: 15px;				
				background: url('../site-images/nav_button_green_spark.png') no-repeat top left;
			}				
			.mentorbus-btn-group:hover {
				
				background: url('../site-images/nav_button_blue_spark.png') no-repeat top left;
			}
		</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
<div class="container">	
<!--  NAVBAR ---------------------------------------------------------------------->	
<? include('nav.php'); ?>
<!--  end of navbar   -------------------------------------------------------    --><hr><br><br>
<div id="query-view" class="query-view"> 	  
	  <div id="query-table" class="queries-tbl"><form method="POST" action="query.php">	
			<table class="openq-table" cellpadding="5">
				<tbody>
				<tr style="background: #007197; color: white; text-align: center;">
					<th style="background: #007197; color: white; text-align: center;font-size: 16px;">Mentor</th>
					<th style="background: #007197; color: white; text-align: center;font-size: 16px;">Subject</th>
					<th style="background: #007197; color: white; text-align: center;font-size: 16px;">Catagory</th>
					<th style="background: #007197; color: white; text-align: center;font-size: 16px;">Status</th>
					<th style="background: #007197; color: white; text-align: center;font-size: 16px;">Date</th>
					<th style="background: #007197; color: white; text-align: center;font-size: 16px;">Action</th>
				</tr>
					<?
			$partparameters = $_SESSION["UserID"];
			$strSQL = "SELECT QueryID, Subject, Mentor, Category, Status, CONVERT(VARCHAR(12),DateCreated)[DateCreated] FROM support.vw_support_list WHERE myID = $partparameters;";
			$objQuery = sqlsrv_query($objCon, $strSQL);
			if( $objQuery === false) {
				die( print_r( sqlsrv_errors(), true) );
			}
			while( $row = sqlsrv_fetch_array( $objQuery, SQLSRV_FETCH_ASSOC) ) {
				
							echo "<tr>
								<td>".$row['Mentor']."</td><td>".$row['Subject']."</td>
								<td>".$row['Category']."</td>
								<td>"
								?>
								<lable id="<? echo str_replace(" ","",$row['Status']); ?>" class="query-status">
								<?
								echo $row['Status']."</lable></td>
								<td>".$row['DateCreated']."</td><td>";

								?>
									<button type="submit" value="<? echo $row['QueryID']; ?>" name="queryID" class="btn_claim">View</button>
								<?
 								
								echo "</td></tr>";
						}
						sqlsrv_free_stmt( $objQuery);
					?>
				</tbody>	
			</table></form>
		</div>
		


</div>
</div>
</body>
</html>
