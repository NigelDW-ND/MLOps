<?php
 	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 


 	$LandingPage = "..\..";
 	$Overview = "Overview_page.php";
 	$Stats = "Stats_page.php";
 	$Pending = "Pending_page.php";
 	$InParticants = "InParticants_page.php";
 	$OutParticants = "OutParticants_page.php"; 
 	$RoundTable = "RoundTable_page.php"; 	
?>
<html>	
	<head>
		<link rel="stylesheet" type="text/css" href="../style-css/styles-mentors.css">
		<style>
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
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
	<script>
		$(function() {
			$(".meter > span").each(function() {
				$(this)
					.data("origWidth", $(this).width())
					.width(0)
					.animate({
						width: $(this).data("origWidth")
					}, 1200);
			});
		});
	</script>
	</head>
	<body>
		<div class="nav">
			<img src="../site-images/logo_150px.png" style="width:250px;height:85px;" alt="fetola">
			<nav class='navbar'>
				<div id="Mentor-Business-Buttons"> 
					<ul>
					<ul>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "Overview_page.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'Overview_page.php'">Overview</button></li>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "Pending_page.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'Pending_page.php'">Pending</button></li>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "InParticants_page.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'InParticants_page.php'">Telephonic</button></li>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "Round_List_page.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'Round_List_page.php'">Round Table</button></li>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "OutParticants_page.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'OutParticants_page.php'">Declined</button></li>
				<li><button type="button" id="mbbtn1" class="mentorbus-btn-group" onclick="window.location.href = '../../'">LogOut</button></li>
					</ul>
					</ul>
				</div>
			</nav>
		</div><hr>	
		<div class="ProgramSelectbox">
		  <select>
		    <option>Fetola2020</option>
		  </select>
		</div>
	</body>
</html>		

