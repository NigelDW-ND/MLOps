<?php
	session_start();
	include('../config/database_conn.php');
	$strSQL = "SELECT * FROM support.Categories";

?>
<html>
<head>
<meta charset="utf-8">
<title>Log a query</title>
<link href="../../style-css/Styles-part-support.css" rel="stylesheet">	
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
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>

<body>
<div class="container">	
<!--  NAVBAR ---------------------------------------------------------------------->	
<? include('nav.php'); ?>
<hr>
<!--  end of navbar   -------------------------------------------------------    -->	  <br><br>
	
		
		<div id="query-view" class="query-view"> 

			<br>
	
			<div id="query">
			<img src="../../site-images/query_icon.png" style="width:25px;height:25px;" alt="fetola">	
			I need help with.
			<hr>
			<form method="post" action="log_a_query_view.php">
				<input type="Hidden" name="UserID" value="<? echo $_SESSION["UserID"]; ?>">
			Select a Catagory:<br>
			<select name="CatID">
			<?
			$objQuery = sqlsrv_query($objCon, $strSQL);
			if( $objQuery === false) {
				die( print_r( sqlsrv_errors(), true) );
			}			
			while( $row = sqlsrv_fetch_array( $objQuery, SQLSRV_FETCH_ASSOC) ) {
				echo "<option value='".$row['CategoryID']."'>".$row['CategoryDescription']."</option>";
			}
			?>
			</select><br><br>
					
			<b>Subject</b> - Please provide a short description of the issue.<br>
			<input id="SubjectText" type="text" name="Subject" style="width: 337px;" placeholder=" In no more than 15 words."><div id="SubjNum"></div><br><br>
			<b>Details</b> - In more detail please advise as to the nature of the issue we can assist you in?  <br>
			<textarea id="query_input" name="Comment" rows="5" cols="50" placeholder="In no more than 150 words."></textarea>

    		<div id="charNum"></div>
			<br><br>

		
			<input type="submit" value="Submit" class="btn_claim">
				</form>
			</div>
		
     </div>	
<script type="text/javascript">
		$('#query_input').keyup(function(){
		   var wordCount = $(this).val().split(/[\s\.\?]+/).length;
		   var wordsleft = 150 - wordCount
		   if(wordsleft < 1){
		   	$('#query_input').attr('disabled','disabled');
		   	$('#charNum').text('You have reached the word limit of this field.');
		   }else{
		   	$('#charNum').text('You have ' + wordsleft + ' remaining.');
		   }   
		});
		$('#SubjectText').keyup(function(){
		   var wordCnt = $(this).val().split(/[\s\.\?]+/).length;
		   var wordslft = 15 - wordCnt
		   if(wordslft < 1){
		   	$('#SubjectText').attr('disabled','disabled');
		   	$('#SubjNum').text('You have reached the word limit of this field.');
		   }else{
		   	$('#SubjNum').text('You have ' + wordslft + ' remaining.');
		   }   
		});
</script>

</div>
</body>
</html>
