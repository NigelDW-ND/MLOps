<?
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
								<input id="myPassword" type="password" class="form-control">
							</td>
						</tr>
						<tr>
							<td>Confirm Password</td>
							<td>
								<input id="myConfirmPassword" type="password" class="form-control">
							</td>
						</tr> 
						<tr>
							<td colspan="2">
								<div id="errors" class="well"></div>
								<input type="button" id="SubmitPWChange" value="Save" name="Update" style="visibility: hidden;" class="btn">
							</td>
						</tr>
					</table>
				</div>
			</div>		
		
			<div id="mentorProfileAboutMe">
				<label class="profilesHeadingLabelGreen"><i class='fas fa-user-circle' style='font-size:24px'></i> About My Business</label>
				<hr>
				<div class="content_right_img_upload">


				<img src="" width="140" height="140" id="myProfileimg" style="border-radius: 10px;"><br><br>
				<div id="FileUpload">
				<label class="btn_view"> Select a File

				<input type="file"  size="60"  name="fileToUpload" id="fileToUpload">
				</label> <p id="upload_message"></p>
				</div>
				<button type='submit' id='upload_file' value='$qid' name='submit-file' class="btn_view" style="display:none;">Upload</button>

				<br><label class="profilesNoteLabel"><i class='fas fa-exclamation-circle'></i><b> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</b></label>
				</div>
				<div class="content_right_desc_update">
				<div id="business-details"></div>
				
				<font style="font-size: 16px;"> Please tell us more about your business? </font>
				<br>
				<textarea id="query_input" name="BusDescr" rows="5" cols="50" placeholder="In no more than 150 words." class="text_descr"></textarea>
				<div id="charNum"></div>
				<br>
				<button class="btn" id="desc_update_btn">Update</button>
				
				</div>

				<div id="snackbar">Some text some message..</div>

			</div> 		
	</div>

	<?php include('queryFooter.php'); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		var mid = <?php echo $mentorID ?>;					
		
		getMentorProfile(mid);
		function getMentorProfile(mid){
			$.ajax({                                      
				url: 'profileFunctions.php',              
				type: 'POST',          
				data: {'func':'getMentorProfile',
				'mid':mid},        
				cache: false,
				success: function(data){
					console.log(data);
					$('#mentorDetails').html(data);
				}
			});
		}
		
		/*
		
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
					'reasonVal':UCReasonValue,
					'categoryVal':UCCatVal,
					'categoryProvided':catProvided},
					cache: false,
					success: function(data){
						getTable("All","All");
						mqmodal.style.display = "none";						
					}
				});
			}
				
		});		
		*/
		
		
	});		
	</script>
	</body>
</html>