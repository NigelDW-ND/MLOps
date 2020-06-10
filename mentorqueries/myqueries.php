<?php
	include('../config/database_conn.php');
	session_start();

	$mentorID = $_SESSION["UserID"];	
		
?>

<html>
	<head>
		<title>My Queries</title>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-mentorqueries.css">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		<script src="https://kit.fontawesome.com/a012f76b8f.js" crossorigin="anonymous"></script>
	</head>
	<body>
	<?php include('queryHeader.php'); ?>
		<div id="myQueriesModal" class="modal">
		  <div class="modal-content">
			<div class="modal-header">
			  <h2><span id="modalHeaderTitle"></span></h2>
			</div>
			<div class="modal-body">
				<div id="ContentDetails">					
				</div>
				<div class="mq-model-button-group">
					<button id="mqCloseModalBtn">Close Window</button>
				</div>
			</div>
		  </div>
		</div>
		
		<div class="container">	
			<div id="My-Queries" class="data-table-display">
				<div id="My-Queries-Top">
					My Queries				
				</div>
				<div id="Table-Section">	
				</div>
			</div>
		</div>
	<?php include('queryFooter.php'); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		var mid = <?php echo $mentorID ?>;		
		var mqmodal = document.getElementById("myQueriesModal");			
		
		getTable("All","All");
		
		$(document).on('click', '.unclaimQueryBtn', function(){			
			var queryID = $(this).closest('tr').attr('id');
			getUnclaimForm(queryID);
			mqmodal.style.display = "block";
			$('#modalHeaderTitle').html("Unclaim Query");
						
		});
		
		$(document).on('click', '.closeQueryBtn', function(){			
			var queryID = $(this).closest('tr').attr('id');			
			getCloseQueryForm(queryID);
			mqmodal.style.display = "block";
			mqmodal.style.top = "-100";
			$('#modalHeaderTitle').html("Closing Details");
						
		});
		
		$(document).on('click', '#mqCloseModalBtn', function(){
			mqmodal.style.top = "0";
			mqmodal.style.display = "none";
		});
		
		window.onclick = function(event) {
			if (event.target == mqmodal) {
				mqmodal.style.top = "0";
				mqmodal.style.display = "none";
			}
		}		
		
		function getTable(PartFilter, CatFilter){
			$.ajax({
				url:"getMyQueries.php",
				type:"POST",
				data:{'funcTR':'getMyQueries',
				'PartFilter':PartFilter,
				'CatFilter':CatFilter},
				success: function(data){
					$('#Table-Section').html(data);
				}
			});
		}
		
		function getUnclaimForm(queryID){			
			$.ajax({
				url:"getMyQueries.php",
				type:"POST",
				data:{'funcTR':'getUnclaimForm',
				'qid':queryID},
				cache: false,
				success: function(data){
					$('#ContentDetails').html(data);
				}
			});
		}
		
		function getCloseQueryForm(queryID){			
			$.ajax({
				url:"getMyQueries.php",
				type:"POST",
				data:{'funcTR':'getCloseQueryForm',
				'qid':queryID},
				cache: false,
				success: function(data){
					$('#ContentDetails').html(data);
				}
			});
		}
		
		$(document).on('click', '#USubBtn', function() {
			var queryID = $(this).attr('value');
			var UCReasonValue = $('#unclaim-reason-comment-text').val();
			var UCCatVal = $('#qCategory').val();
			var catProvided = "Undefined";
			if(UCCatVal == -1){
				catProvided = "No";
			}else{
				catProvided = "Yes";
			} 
			if(UCReasonValue == ""){
				alert("Reason not provided");
			}else{				
				$.ajax({					
					url: "queryFunctions.php",
					type: "POST",
					data: {'qType':'unclaimMentorQuery',
					'qid':queryID,
					'mid':mid,
					'reasonVal':UCReasonValue,
					'categoryVal':UCCatVal,
					'categoryProvided':catProvided},
					cache: false,
					success: function(data){
						console.log(data);
						getTable("All","All");
						mqmodal.style.display = "none";						
					}
				});
			}
				
		});		
		
		$(document).on('click', '#FSubBtn', function() {
			var queryID = $(this).attr('value');
			var FCTextValue = $('#add-final-comment-text').val();
			var FCRatcingCommentValue = $('#add-rating-comment-text').val();
			var FCConTypeVal = $('#qContactType').val();
			var hoursVal = $('#qtsHours').val();
			var minutesVal = $('#qtsMinutes').val();
			var FCRating = $("input:radio[name='QueryRating']:checked").val();
			var FCFormData = new FormData();
			
			if(FCConTypeVal == -1){
				alert("Contact type was not selected");
			}else if(hoursVal == "0" && minutesVal == "0"){
				alert("Hours and minutes cannot be 0!");
			}else if(!$("input:radio[name='QueryRating']:checked").val()){
				alert("Rating was not provided");
			}else if(FCTextValue == ""){
				alert("Final comment was not provided");
			}else{
								
				$.ajax({					
					url: "queryFunctions.php",
					type: "POST",
					cache: false,
					data: {'qType':'addMentorFinalComment',
					'NoteDesc':FCTextValue,
					'ConType':FCConTypeVal,
					'HoursSpent':hoursVal,
					'MinutesSpent':minutesVal,
					'MentorQueryRating':FCRating,
					'MentorQueryRatingComment':FCRatcingCommentValue,
					'qid':queryID,
					'mid':mid},
					success: function(data){
						getTable("All","All");
						mqmodal.style.display = "none";
					}
				});
				
			}
			
		});
		
		/*
		function getQueryDetails(qid){
			$.ajax({
				url:"getQueryDetails.php",
				type:"POST",
				data:{'qid':qid},
				success: function(data){					
					$('#ContentDetails').html(data);
				}
			});
		}		
	
		$(document).on('click', '.cqBtn', function() {
			var queryID = $(this).closest('tr').attr('id');
			$.ajax({					
				url: "claimquery.php",
				type: "POST",
				data: {"qid":queryID, "mid":mid},
				cache: false,
				success: function(data){
					getTable("All","All");
				}
			});
		});
		*/
		$(document).on('change', '#MQParticipantFilter', function() {
			var partFilter = $('#MQParticipantFilter').val();
			var catFilter = $('#MQCategoryFilter').val();
			getTable(partFilter, catFilter);
		});
		
		$(document).on('change', '#MQCategoryFilter', function() {
			var partFilter = $('#MQParticipantFilter').val();
			var catFilter = $('#MQCategoryFilter').val();
			getTable(partFilter, catFilter);
		});
		
		
	});		
	</script>		
	</body>
</html>