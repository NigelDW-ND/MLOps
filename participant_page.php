<?php
ini_set('display_errors', 1); 
error_reporting(~0);
	include('config/database_conn.php');
	session_start();
?>


<html>
	<head>
		<link href="style-css/Styles-profile.css" rel="stylesheet">	
		<title>Home</title>

	</head>
	<body>
<div class="container">	
		      <div class="nav">
	     <img src="site-images/logo_150px.png" style="width:250px;height:85px;" alt="fetola">
		 <nav class='navbar'>	  
			<div id="Mentor-Business-Buttons"> 
				<ul>
					<li><button type="button" id="mbbtn4" class="mentorbus-btn-group" onclick="window.location.href = ''">Logout</button></li>
				</ul>	
		</div> 
	</nav>		 
         <hr>
	     </div>		  
	     <br>
		<div id="Mentor-Alerts" class="data-table-display">
			&nbsp;

		</div>
		<div id="Mentor-Alerts" class="data-table-display">
			&nbsp;

		</div>
</div>
	</body>
</html>