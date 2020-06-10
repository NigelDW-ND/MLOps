<?php
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
?>
<html>	
	<head>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-mentorqueries.css">
		<style>
			.mentorsup-btn-group {
				width: 150px;
				height: 40px;
				font-size: 15px;
			}		
			.mentorsup-btn-group-select {
				width: 130px;
				height: 40px;
				font-size: 15px;				
				background: url('../site-images/nav_button_green_spark.png') no-repeat top left;
			}				
			.mentorsup-btn-group:hover {				
				background: url('../site-images/nav_button_blue_spark.png') no-repeat top left;
			}			
			
		</style>
	</head>
	<body>
		<div class="nav">
			<img src="../site-images/fnb_logos.png" style="width:400px;height:85px;" alt="fetola">
			<nav class='navbar'>
				<div> 
					<ul>
						<li>
							<button type="button" class="<?php 
							if($curPageName == "openqueries.php"){
							    echo "mentorsup-btn-group-select";
							}else{
								echo "mentorsup-btn-group";
							} ?>" onclick="window.location.href = 'openqueries.php'">Open Queries</button>
						</li>
						<li>
							<button type="button" class="<?php 
							if($curPageName == "myqueries.php"){
							    echo "mentorsup-btn-group-select";
							}else{
								echo "mentorsup-btn-group";
							} ?>" onclick="window.location.href = 'myqueries.php'">My Queries</button>
						</li>
						<li>
							<button type="button" class="mentorsup-btn-group" onclick="window.location.href = '../'">LogOut</button>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</body>
</html>
