<?php
	include('../config/database_conn.php');
	session_start();

	$mentorID = $_SESSION["UserID"];		
?>

<html>
	<head>
		<title>Home</title>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>		
	</head>
	<body>
	
	<div class="container">	
	<?php include('adminNav.php'); ?>
		<hr>
		<br>
		<div id="PageSelection">
		<button id="MentorLitePages" class="adminPageSelection">Mentor Hotline</button>
		<button id="FTPortalPages" class="adminPageSelection">FT Portal</button>
		</div>
	</div>	

	<script type="text/javascript">
	$(document).ready(function(){
				
		$(document).on('click', '#MentorLitePages', function(){			
			window.location.href = '../admin/adminMentorLite.php';						
		});
		
		$(document).on('click', '#FTPortalPages', function(){			
			alert("FT Portal Admin pages to be added!");						
		});
		
	});		
	</script>	
	</body>
</html>