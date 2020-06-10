<!DOCTYPE html>
<html>
<head>
<? 	
	include('../config/database_conn.php');
	session_start(); ?>
	<meta charset="utf-8">
	<title>Selection Landing Page</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../Style-css/Styles-selection.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body data-gr-c-s-loaded="true">
<div class="table_elements" id="body-class" >	
		<!----------------------------------------------------------------------------------->	
		<? include('nav.php'); ?>
			
<!----------------------------------------------------------------------------------->	
		<div class="data-table-display">
		<div class="floatLeft"><b>Statistics</b><br><br>
		<? include('Applicant_stats.php'); ?>
		</div>

		<div class="floatRight"><b>Applicants by Province</b><br><br>
		<? include('Applicant_stats_prov.php'); ?>
		<br>
		<div style="width: 100%; text-align: center;">
		<? include('South_African_Count_Map.php'); ?>
		</div></div>
		<p></p>	
		</div>
		<p></p>

</body>
</html>