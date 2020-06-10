<?php
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
?>
<html>	
	<head>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-admin.css">
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
			<img src="../site-images/logo_150px.png" style="width:250px;height:85px;" alt="fetola">
			<nav class='navbar'>
				<div> 
					<ul>
						<li>
							<button type="button" class="<?php 
							if($curPageName == "admin.php"){
							    echo "admin-nav-btn-group-select";
							}else{
								echo "admin-nav-btn-group";
							} ?> " onclick="window.location.href = 'admin.php'">Platform</button>
						</li>						
						<li>
							<button type="button" class="admin-nav-btn-group" onclick="window.location.href = '../'">LogOut</button>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</body>
</html>
