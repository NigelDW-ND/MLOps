<?php
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
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
	</head>
	<body>
		<div class="nav">
			<img src="../site-images/logo_150px.png" style="width:250px;height:85px;" alt="fetola">
			<nav class='navbar'>
				<div id="Mentor-Business-Buttons"> 
					<ul>
						<li><button type="button" id="mbbtn1" class="<?php
						if($curPageName == "Home.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'Home.php'">Home</button>
					</li>
					<li>
						<button type="button" id="mbbtn1" class="<?php
						if($curPageName == "MentorBusiness.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'MentorBusiness.php'">Business</button></li>
						
					<li>
						<button type="button" id="mbbtn2" class="<?php
						if($curPageName == "MentorMilestones.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'MentorMilestones.php'">Milestones</button></li>
						<li><button type="button" id="mbbtn3" class="<?php
						if($curPageName == "MentorSessions.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'MentorSessions.php'">Sessions</button></li>
						<li><button type="button" id="mbbtn4" class="<?php
						if($curPageName == "MentorClaims.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'MentorClaims.php'">Claims</button></li>
						<li><button type="button" id="mbbtn1" class="mentorbus-btn-group" onclick="window.location.href = '../'">LogOut</button></li>
					</ul>
				</div>
			</nav>
		</div>	
	</body>
</html>
