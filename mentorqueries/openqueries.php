<?php
	include('../config/database_conn.php');
	session_start();

	$mentorID = $_SESSION["UserID"];		
?>

<html>
	<head>
		<title>Open Queries</title>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-mentorqueries.css">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		<script src="https://kit.fontawesome.com/a012f76b8f.js" crossorigin="anonymous"></script>
	</head>
	<body>
	<?php include('queryHeader.php'); ?>	
	
	<div id="openQueriesModal" class="modal">
	  <div class="modal-content">
		<div class="modal-header">
		  <h2>Query Detail</h2>
		</div>
		<div class="modal-body">
			<div id="ContentDetails">					
			</div>
			<div class="oq-model-button-group">
				<button id="oqCloseModalBtn">Close Window</button>
			</div>
		</div>
	  </div>
	</div>
	
	<div class="container">	
		<div id="Open-Queries" class="data-table-display">
			<div id="Open-Queries-Top">
				Open Queries				
			</div>
			<div id="Table-Section">	
			</div>
		</div>
	</div>	
	<?php include('queryFooter.php'); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		var mid = <?php echo $mentorID ?>;		
		var oqmodal = document.getElementById("openQueriesModal");			
		
		getTable("All","All");
		
		$(document).on('click', '.vqBtn', function(){			
			var queryID = $(this).closest('tr').attr('id');			
			getQueryDetails(queryID);
			oqmodal.style.display = "block";
						
		});		
		
		$(document).on('click', '#oqCloseModalBtn', function(){			
			oqmodal.style.display = "none";
		});
		
		window.onclick = function(event) {
		  if (event.target == oqmodal) {
			oqmodal.style.display = "none";
		  }
		}			
		
		function getTable(PartFilter, CatFilter){
			$.ajax({
				url:"getOpenQueries.php",
				type:"POST",
				data:{'PartFilter':PartFilter,
				'CatFilter':CatFilter},
				success: function(data){
					$('#Table-Section').html(data);
				}
			});
		}
		
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

		$(document).on('change', '#OQParticipantFilter', function() {
			var partFilter = $('#OQParticipantFilter').val();
			var catFilter = $('#OQCategoryFilter').val();
			getTable(partFilter, catFilter);
		});
		
		$(document).on('change', '#OQCategoryFilter', function() {
			var partFilter = $('#OQParticipantFilter').val();
			var catFilter = $('#OQCategoryFilter').val();
			getTable(partFilter, catFilter);
		});
		
	});		
	</script>	
	</body>
</html>