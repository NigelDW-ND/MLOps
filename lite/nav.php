<?php
 	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 	
?>
<html>	
	<head>

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
			<img src="../site-images/fnb_logos.png" style="width:400px;height:85px;" alt="fetola">
			<nav class='navbar'>
				<div id="Mentor-Business-Buttons"> 
					<ul>
					<ul>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "my_account.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'my_account.php'">My Account</button></li>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "participant_support_page.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'participant_support_page.php'">My Queries</button></li>
				<li><button type="button" id="mbbtn1" class="<?
						if($curPageName == "log_a_query.php"){
							    echo "mentorbus-btn-group-select";
							}else{
								echo "mentorbus-btn-group";
							}
						?>" onclick="window.location.href = 'log_a_query.php'">Log A Query</button></li>
				<li><button type="button" id="mbbtn1" class="mentorbus-btn-group" onclick="window.location.href = '../../'">LogOut</button></li>
					</ul>
					</ul>
				</div>
			</nav>
		</div>


