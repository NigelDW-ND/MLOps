<!DOCTYPE html>
<html>
<head>
<? 	session_start(); ?>
	<meta charset="utf-8">
	<title>Selection Landing Page</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="Style-css/Styles-selection.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body data-gr-c-s-loaded="true">
<!-- Modal Start --------------------------------------------------------------------------------->		
<div id="selection_modal_action" style="display: none">
	<div id="selection_modal_header">
		<span class="selection_modal_action_close">&times;</span>
		<div style="width: 48; height: 48; display: table-cell;">

			<img src="site-images/edit-property-48.png"></div>
			<div id="selection_modal_header_text" style="display: table-cell; height: 48;"></div>
		
	</div>
	<div id="selection_modal_action_data"> </div>
</div>
<!-- Modal End --------------------------------------------------------------------------------->	

<div class="table_elements" id="body-class">	
<!----------------------------------------------------------------------------------->	
<? include('selections/nav.php'); ?>
		
<!----------------------------------------------------------------------------------->	
		<br><h3 class="tablehdr">Pending Applications</h3>
		<? include('selections/Applicant_list.php'); ?><div>
		<div class="floatLeft"><h3 class="tablehdr">Statistics</h3>
		<? include('selections/Applicant_stats.php'); ?>
		</div>

		<div class="floatRight"><h3 class="tablehdr">Applicants by Province</h3>
		<? include('selections/Applicant_stats_prov.php'); ?>
		</div>
		<p></p><div class="MyApplications">
		<h3 class="tablehdr">My Applicants</h3>
		<? include('selections/Accepted_list.php'); ?></div>	
		<p></p><div class="MyApplications">
		<h3 class="tablehdr">Declined List</h3>
		<? include('selections/Declined_list.php'); ?></div>	
		</div>
	</div>
<script>
	function clk_undo(x) {		

		$.post("/selections/Undo_comment.php",
	    {
	      suggest: x
	    },function(result){
        document.getElementById("selection_modal_action_data").innerHTML = result;
    });
	document.getElementById("selection_modal_header_text").innerHTML = "Undo Declined";
	document.getElementById("body-class").style.filter = "blur(10px)";
	document.getElementById("selection_modal_action").style.display = "block";
	$('html, body').animate({scrollTop:0}, 'slow');
    }

	function clk_action(x) {		

		$.post("/selections/Review_comment.php",
	    {
	      suggest: x
	    },function(result){
        document.getElementById("selection_modal_action_data").innerHTML = result;
    });
	document.getElementById("selection_modal_header_text").innerHTML = "Pending Applications";
	document.getElementById("body-class").style.filter = "blur(10px)";
	document.getElementById("selection_modal_action").style.display = "block";
	$('html, body').animate({scrollTop:0}, 'slow');
    }

    function clk_action_sign(x ,y ,z) {
    	var t = document.getElementById("tat_Applicant_Comment").value;
    	$.post("/selections/SelectAction.php",{
    		Action: x,
    		Memo: t,
    		By: y,
    		Business: z
    	},function(result){
    		document.getElementById("selection_modal_action_data").innerHTML = result;
    	});

    }

    function clk_view(x) {		

		$.post("/selections/View_Applicant.php",
	    {
	      suggest: x
	    },function(result){
        document.getElementById("selection_modal_action_data").innerHTML = result;
    });

	document.getElementById("selection_modal_header_text").innerHTML = "Participant View";
	document.getElementById("body-class").style.filter = "blur(10px)";
	document.getElementById("selection_modal_action").style.display = "block";
	document.getElementById("selection_modal_action").click = "false";
	$('html, body').animate({scrollTop:0}, 'slow');
    }

	var span = document.getElementsByClassName("selection_modal_action_close")[0];
	span.onclick = function() {
		document.getElementById("body-class").style.filter = "blur(0px)";
		document.getElementById("selection_modal_action").style.display = "none";
		document.getElementById("selection_modal_action").click = "true";
    }

    document.getElementById("tat_Applicant_Comment").addEventListener("keypress", tat_Applicant_Function);
    function tat_Applicant_Function() {
    	var nameInput = document.getElementById('tat_Applicant_Comment').value;
	    if (nameInput.lenght < 10) {
			document.getElementById('btn_Choice_yes').setAttribute("disabled", null);
	        document.getElementById('btn_Choice_no').setAttribute("disabled", null);
	    } else {     
	        document.getElementById('btn_Choice_yes').removeAttribute("disabled");
	        document.getElementById('btn_Choice_no').removeAttribute("disabled");
	    }
    }

</script>
</body>
</html>