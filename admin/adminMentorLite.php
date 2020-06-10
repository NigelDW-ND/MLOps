<?php
	include('../config/database_conn.php');
	session_start();

	$mentorID = $_SESSION["UserID"];		
?>

<html>
	<head>
		<title>Home</title>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-admin.css">
	</head>
	<body>
	
	<div id="adminModal" class="modal">
	  <div class="modal-content">
		<div class="modal-header">
		  <h2>Query Detail</h2>
		</div>
		<div class="modal-body">
			<div id="ContentDetails">					
			</div>
			<div class="model-button-group">
				<button id="closeModalBtn">Close</button>
			</div>
		</div>
	  </div>
	</div>
	
	<div class="container">	
		<div class="nav">
			<img src="../site-images/fnb_logos.png" style="width:400px;height:85px;" alt="fetola">
			<nav class='navbar'>
				<div> 
					<ul>
						<li>
							<button type="button" id="OverviewPageBtn" class="admin-nav-btn-group">Overview</button>
						</li>
						<li>
							<button type="button" id="UserQueriesPageBtn" class="admin-nav-btn-group">Queries</button>
						</li>
						<li>
							<button type="button" id="UserManagementPageBtn" class="admin-nav-btn-group">User Management</button>
						</li>
						<li>
							<button type="button" id="UserManagementPageBtn" class="admin-nav-btn-group" onclick="window.location.href = '../'">Log Out</button>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<hr>
		<div id="PageSection">			
		</div>
	</div>	

	<script type="text/javascript">
	$(document).ready(function(){
		var mid = <?php echo $mentorID ?>;		
		var amodal = document.getElementById("adminModal");			
		
		
		
		function getOverviewPage(){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"getOverviewPage"},
				cache: false,
				success: function(data){
					$('#PageSection').html(data);
				}
			});
		}
		
		function getQueriesPage(partFil, menFil, catFil, statFil){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"getQueriesPage",
				"partFil":partFil,
				"menFil":menFil,
				"catFil":catFil,
				"statFil":statFil},
				cache: false,
				success: function(data){
					$('#PageSection').html(data);
				}
			});
		}
		
		function getUserManagementPage(mentorNameFilter){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"getUserManagementPage",
				"mnf":mentorNameFilter},
				cache: false,
				success: function(data){
					$('#PageSection').html(data);
				}
			});
		}
		
		function getFilteredUserManagementPage(){
			var mentorNameFilter = $('#searchMentorFilter').val();
			getUserManagementPage(mentorNameFilter);
		}
		
		function getParticipantDetails(qid){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"getParticipantDetails",
				"qid":qid},
				cache: false,
				success: function(data){
					$('#ContentDetails').hide().html(data).fadeIn('slow');
				}
			});
		}
		
		function getQueryComments(qid){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"getQueryComments",
				"qid":qid},
				cache: false,
				success: function(data){
					$('#ContentDetails').hide().html(data).fadeIn('slow');
				}
			});
		}
		
		function getMentorCategories(mid){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"getMentorCategories",
				"mid":mid},
				cache: false,
				success: function(data){
					$('#ContentDetails').hide().html(data).fadeIn('slow');
				}
			});
		}
		
		function assignMentorCategory(mid, mCat){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"assignMentorCategory",
				"mid":mid,
				"mCat":mCat},
				cache: false,
				success: function(data){
					getMentorCategories(mid);
				}
			});
		}
		
		function changeMentorActive(mid, mav){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"changeMentorActive",
				"mid":mid,
				"mav":mav},
				cache: false,
				success: function(data){
					getMentorCategories(mid);
					getUserManagementPage($('#searchMentorFilter').val());
				}
			});
		}
		
		function removeMentorCategories(mcid, mid){
			$.ajax({
				url:"adminMentorLiteFunctions.php",
				type:"POST",
				data: {"adminFunction":"removeMentorCategories",
				"mcid":mcid},
				cache: false,
				success: function(data){
					getMentorCategories(mid);
				}
			});
		}
		
		$(document).on('click', '#OverviewPageBtn', function(){
			getOverviewPage();						
		});
		
		$(document).on('click', '#UserQueriesPageBtn', function(){
			getQueriesPage("All", "All", "All", "All");						
		});
		
		$(document).on('click', '#UserManagementPageBtn', function(){
			getUserManagementPage("All");						
		});
		
		$(document).on('click', '.queryParticipantSpan', function(){			
			var queryID = $(this).closest('tr').attr('id');
			getParticipantDetails(queryID);
			amodal.style.display = "block";			
		});
		
		$(document).on('click', '.viewCommentsBtn', function(){			
			var queryID = $(this).closest('tr').attr('id');
			getQueryComments(queryID);
			amodal.style.display = "block";			
		});
		
		$(document).on('click', '.ManageCategories', function(){			
			var mentorID = $(this).closest('tr').attr('id');
			getMentorCategories(mentorID);
			amodal.style.display = "block";			
		});		
		
		$(document).on('click', '.overviewOptions', function(){			
			var statusVal = $(this).closest('span').attr('value');
			getQueriesPage("All", "All", "All", statusVal);			
		});
		
		$(document).on('click', '.SubmitMentorCategory', function(){			
			var mentorID = $(this).attr('value');
			var mentorCategory = $('#MentorCategoryFilter').val();
			assignMentorCategory(mentorID, mentorCategory);			
		});
		
		$(document).on('click', '.removeMentorCategorySpan', function(){			
			var mentorCategoryID = $(this).closest('tr').attr('id');
			var mentorID = $(this).attr('id');
			removeMentorCategories(mentorCategoryID, mentorID);			
		});		
		
		$(document).on('click', '.ChangeMentorActive', function(){				
			var mentorActiveVal = $('#MentorActiveFilter').val();
			var mentorID = $(this).attr('value');			
			changeMentorActive(mentorID, mentorActiveVal);			
		});
		
		$(document).on('change', '.QueriesFilterDropDownBox', function() {
			var partFilter = $('#QParticipantFilter').val();
			var menFilter = $('#QMentorFilter').val();
			var catFilter = $('#QCategoryFilter').val();
			var statusFilter = $('#QStatusFilter').val();
			getQueriesPage(partFilter, menFilter, catFilter, statusFilter);
		});
		
		
		var typingTimer;
		$(document).on('keydown', '#searchMentorFilter', function () {
		  clearTimeout(typingTimer);
		});
		$(document).on('keyup', '#searchMentorFilter', function() {
			clearTimeout(typingTimer);
			typingTimer = setTimeout(getFilteredUserManagementPage, 3000);			
		});
		
		
		
		$(document).on('click', '#closeModalBtn', function(){
			amodal.style.display = "none";
			$('#ContentDetails').html('');
		});
				
	});		
	</script>	
	</body>
</html>