<!DOCTYPE html>
<html>
<head>
<? 	session_start(); ?>
	<meta charset="utf-8">

	<title>Selection Landing Page</title>
	<link href="Style-css/Styles-selection.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
		$(document).ready(function(){
			$(".clk_confirm").click(function(){
				var varb = $(this).val();
				$.post("/selections/Review_confirmation.php", {suggest: varb}, function(result){
					$("#CommentSet").html(result);
    			});
 			});
			$(".clk_comment").click(function(){
				var varb = $(this).val();
				$.post("/selections/Review_comment.php", {suggest: varb}, function(result){
					$("#CommentSet").html(result);
    			});
 			});
	 		$(".clk_clear").click(function(){
 				$("#CommentSet").html("");
 			});		
			
			
		});
	</script>
</head>
<body data-gr-c-s-loaded="true">
<div class="table_elements">	
<!----------------------------------------------------------------------------------->	
		<div  class="selection_navbar">
				<div class="slt_navbar">
					<img src="site-images/logo_150px.png" style="width:250px;height:85px;" alt="fetola">
					<div class="sel_toggle-menu">
						<nav class="navbar_tabs">
						<ul>
							<li><a data-for-tab="1" href="http://thedw.azurewebsites.net/">Logout</a></li>

						</ul>
						</nav>
					</div>   
				</div>	
			
			</div>
				<hr>
<!----------------------------------------------------------------------------------->	

		<br><h3 class="tablehdr">Pending Applications</h3>
		<? include('selections/Applicant_list.php'); ?>
		<p id="CommentSet"></p>
		<div class="container">
<div class="floatLeft"><h3 class="tablehdr">Statistics</h3>
<? include('selections/Applicant_stats.php'); ?>
</div>

<div class="floatRight"><h3 class="tablehdr">Applicants by Province</h3>
<? include('selections/Applicant_stats_prov.php'); ?>
</div>
</div>



		
</body>
</html>