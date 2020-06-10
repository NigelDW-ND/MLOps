<?php
	include('../config/database_conn.php');
	session_start();

	$mentorID = $_SESSION["UserID"];	
		
?>

<html>
	<head>
		<title>My Profile</title>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-mentorqueries.css">
		<script src="https://kit.fontawesome.com/a012f76b8f.js" crossorigin="anonymous"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	</head>
	<body>
	<?php include('queryHeader.php'); ?>	

		<div id="welcomeModal" class="modal">
			<div id="welcomeModalContent">
				<img src="../site-images/fnb_logos.png" style="width:400px;height:80px;" alt="fetola"><hr>
				<h2>Welcome to Mentor Hotline!</h2>
				<div class="welcome_text">You've raised your hand - your time is now. Let's make a difference in the lives of SMEs across South Africa</div><br><br>
				<button id="closeWelcomeModal" class="btn" >Continue</button><br>
				<input type="checkbox" name="disablewelcomescreen" id="disableWelcomeScreen"><b style="font-size: 9px;font-weight:">Don't display this message again.</b>
			</div>
		</div>
	
		<div class="mentorProfileContainer">	
			<div id="mentorProfileSection">
				<label class="profilesHeadingLabelBlue"><i class='fas fa-user-circle' style='font-size:24px'></i> My Contact Details </label>
				<hr>
				<div id="mentorDetails">       
				</div>
				<br>
				<label class="profilesNoteLabel"><i class='fas fa-exclamation-circle'></i><b> This Information is not Shared with Users.</b></label> 
			</div>
			
			<div id="mentorPasswordManageSection">
				<label class="profilesHeadingLabelBlue"><i class='fas fa-lock' style='font-size:24px'></i>  Manage Password</label>
				<hr>
				<br>
				<div class="pwcontainer">
					<table style="width: 100%">
						<tr>
							<td>New Password</td>
							<td>
								<input id="mentorPassword" type="password" class="mentorPasswordInputs">
							</td>
						</tr>
						<tr>
							<td>Confirm Password</td>
							<td>
								<input id="mentorConfirmPassword" type="password" class="mentorPasswordInputs">
							</td>
						</tr> 
						<tr>
							<td colspan="2">
								<div id="passwordErrors"></div>
								<input type="button" id="SubmitPWChange" value="Save">
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			
			<div id="mentorProfileAboutMe">
				<label class="profilesHeadingLabelGreen"><i class='fas fa-user-circle' style='font-size:24px'></i> About Me</label>
				<hr>
				<div id="aboutUsSection">
					<div id="mentorImageSection">
						<div id="mentorProfileImage">
						</div>
						<input type="file" name="imageToUpload" id="imageToUpload">					
						<button type='button' id='uploadImageBtn'>Upload</button>
						<br><label class="profilesNoteLabel"><i class='fas fa-exclamation-circle'></i><b> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</b></label>
					</div>
					<div id="mentorExperienceSection">						
					</div>
					<div id="mentorDescriptionSection">
						<table>
							<tr>
								<td><span>More about me:</span></td>
								<td><i class="fas fa-edit" tip="Edit" id="editMentorDescriptionBtn" aria-hidden="true"></i></td>
								<!--<td><i class="fas fa-save" tip="Save" style="cursor: pointer;color: #799900;" id="saveMentorDescriptionBtn" aria-hidden="true"></i></td>-->
							</tr>
						</table>
						<div id="mentorDescriptionVal">
						</div>
						<textarea id="mentorDescriptionInput" rows="5" placeholder="In no more than 150 words."></textarea>
						<button class="btn" id="updateMentorDescriptionBtn">Update</button>					
					</div>
				</div>
			</div>
			
			
		</div>
	<?php include('queryFooter.php'); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		var mid = <?php echo $mentorID ?>;			
		var welcomeModal = document.getElementById("welcomeModal");			
		var welcomeContent = document.getElementById("welcomeModal");			
		var menDescTextArea = document.getElementById("mentorDescriptionInput");			
		var menDescSubBtn = document.getElementById("updateMentorDescriptionBtn");			
		var menDescEditBtn = document.getElementById("editMentorDescriptionBtn");			
		var menDescVal = document.getElementById("mentorDescriptionVal");			
		
		getShowWelcomeStatus(mid);
		getMentorProfile(mid);
		getMentorProfilePicture(mid);
		getMentorDescription(mid);
		getMentorExperiences(mid)
		
		$(document).on('click', '.unclaimQueryBtn', function(){			
			var queryID = $(this).closest('tr').attr('id');
			getUnclaimForm(queryID);
			mqmodal.style.display = "block";
						
		});
		
		function getShowWelcomeStatus(mid){
			$.ajax({
				url:"welcomeScreenFunctions.php",
				type:"POST",
				data:{'func':'getWelcomeVal',
				'mid':mid},
				success: function(data){
					if(data.trim() == "Yes"){
						welcomeModal.style.display = "block";
					}
				}
			});
		}
		
		function getMentorDescription(mid){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'getMentorDescription',
				'mid':mid},        
				cache: false,
				success: function(data){
					$('#mentorDescriptionVal').html(data);
				}
			});
		}
		
		function getMentorDescriptionTextArea(mid){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'getMentorDescription',
				'mid':mid},        
				cache: false,
				success: function(data){
					$('#mentorDescriptionInput').val(data.trim());
				}
			});
		}
				
		function getMentorProfile(mid){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'getMentorProfile',
				'mid':mid},        
				cache: false,
				success: function(data){
					$('#mentorDetails').html(data);
				}
			});
		}
		
		function getMentorProfilePicture(mid){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'getMentorProfilePicture',
				'mid':mid},        
				cache: false,
				success: function(data){
					$('#mentorProfileImage').html(data);
				}
			});
		}
		
		function getMentorExperiences(mid){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'getMentorExperiences',
				'mid':mid},        
				cache: false,
				success: function(data){
					$('#mentorExperienceSection').html(data);
				}
			});
		}
		
		function addMentorExperience(mid, exp, exptype){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'addMentorExperience',
				'mid':mid,
				'exp':exp,
				'exptype':exptype},        
				cache: false,
				success: function(data){
				}
			});
		}
		
		function removeMentorExperience(mid, exp, exptype){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'removeMentorExperience',
				'mid':mid,
				'exp':exp,
				'exptype':exptype},        
				cache: false,
				success: function(data){
				}
			});
		}	

		$(document).on('click', '#closeWelcomeModal', function(){
			if($("#disableWelcomeScreen").is(':checked')){
				$.ajax({                                      
					url: 'welcomeScreenFunctions.php',              
					type: "post",          
					data: {'func':'disableWelcome'
					,'mid':mid},
					dataType: 'html',                
					cache: false,
					success: function(data){
						console.log(data);						
					}
				});
			}
			welcomeModal.style.display = "none";
		});
		
		$('#imageToUpload').on('change', function() {			
			$('#upload_file').css('display', 'initial');
			uploadImageBtn.style.display = "block";
		});
		
		$('#uploadImageBtn').on('click', function() {	
			var IUFormData = new FormData();
			var FileToUp = $('#imageToUpload')[0].files[0];
			IUFormData.append("file", FileToUp);				
			IUFormData.append("func", 'uploadMentorProfilePicture');				
			IUFormData.append("mid", mid);
			var imageValidation = "no";
			if(FileToUp.type == "image/png"){
				imageValidation = "yes";
			}
			if(FileToUp.type == "image/jpeg"){
				imageValidation = "yes";
			}
			if(FileToUp.type == "image/jpg"){
				imageValidation = "yes";
			}
			if(FileToUp.type == "image/gif"){
				imageValidation = "yes";
			}
			if(imageValidation == "no"){				
				alert("File is not an image");
			}else if(FileToUp.size > 5000000){
				alert("File size to big");
			}else{				
				$.ajax({    
					url: 'profileFunctions.php',
					type: "POST",
					dataType: 'text',
					cache: false,
					contentType: false,
					processData: false,
					data: IUFormData,
					success: function(returndata){
						console.log(returndata);
						getMentorProfilePicture(mid);					
					}
				});				
			}
		});
		
		$(document).on('click', '#SubmitPWChange', function() {
			var menPass = $('#mentorPassword').val();
			var menPassCon = $('#mentorConfirmPassword').val();
			if(menPass != menPassCon){
				alert("confirm password does not match password!");
			}else{		
				$.ajax({					
					url: "profileFunctions.php",
					type: "POST",
					data: {'func':'mentorUpdatePassword',
					'mid':mid,
					'pass':menPass},
					cache: false,
					success: function(data){
						alert("Password Updated");
					}
				});
			}
			
		});
		
		$(document).on('click', '#updateMentorDescriptionBtn', function() {
			var menDesc = $('#mentorDescriptionInput').val();
			$.ajax({					
				url: "profileFunctions.php",
				type: "POST",
				data: {'func':'updateMentorDescriptionBtn',
				'mid':mid,
				'desc':menDesc},
				cache: false,
				success: function(data){
					getMentorDescription(mid);
					menDescTextArea.style.display = "none";
					menDescSubBtn.style.display = "none";
					menDescEditBtn.style.display = "block";
					menDescVal.style.display = "block";
				}
			});
		});
		
		$(document).on( "click", "input[name=expertise][type=checkbox]",  function(){
			var count = $( "input[name=expertise]:checked" ).length;
			if(count > 3){
				alert("You can only select up to 3!");
				$(this).prop('checked', false);
			}else{
				if($(this).prop('checked') == true){					
					var expval = $(this).val();
					addMentorExperience(mid, expval, 'expertise');
				}else{
					var expval = $(this).val();
					removeMentorExperience(mid, expval, 'expertise');
				}
			}
		});
		
		$(document).on( "click", "input[name=experience][type=checkbox]",  function(){			
			if($(this).prop('checked') == true){
				var expval = $(this).val();
				addMentorExperience(mid, expval, 'experience');
			}else{
				var expval = $(this).val();
				removeMentorExperience(mid, expval, 'experience');
			}			
		});
		
		$(document).on( "click", "#editMentorDescriptionBtn",  function(){
			getMentorDescriptionTextArea(mid);
			menDescTextArea.style.display = "block";
			menDescSubBtn.style.display = "block";
			menDescEditBtn.style.display = "none";
			menDescVal.style.display = "none";
		});		
		
	});		
	</script>		
	</body>
</html>