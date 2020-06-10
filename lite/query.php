<?php
	include('../config/database_conn.php');
	session_start();
	
	$UserRollNum = $_SESSION["RollNum"];
	$userID = $_SESSION["UserID"];	
	$qid = $_POST['queryID'];
	
	$getQueryStatusSql = "SELECT * FROM support.vw_lite_close_checks WHERE QueryID = '$qid'";
	$getQueryStatusQuery = sqlsrv_query($objCon, $getQueryStatusSql);
	$getQueryStatusRow = sqlsrv_fetch_array($getQueryStatusQuery, SQLSRV_FETCH_ASSOC);
	$getQueryStatusVal = $getQueryStatusRow['Status'];
	$isClose = $getQueryStatusVal;
	$isRating = $getQueryStatusRow['ClientRating'];
	$isComment = $getQueryStatusRow['ClientRatingComment'];

?>

<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-mentorqueries.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript">
			function ToggleUnclaimForm(){
				var unclaimDiv = document.getElementById("unclaim-query-form");
				var finalCommentDiv = document.getElementById("final-comment-form");
				if(unclaimDiv.style.display === "block"){					
					unclaimDiv.style.display = "none";
				} else {
					finalCommentDiv.style.display = "none";
					unclaimDiv.style.display = "block";
					
				}
			}
			function ToggleFinalCommentForm(){
				var finalCommentDiv = document.getElementById("final-comment-form");
				var unclaimDiv = document.getElementById("unclaim-query-form");
				if(finalCommentDiv.style.display === "block"){
					finalCommentDiv.style.display = "none";
				} else {
					unclaimDiv.style.display = "none";
					finalCommentDiv.style.display = "block";
					
				}
			}
		</script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		<style type="text/css">
			fieldset, label { margin: 0; padding: 0; }

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 25px;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

          /* NavBar*/
.headerContainer{
  display: grid;
  /*grid-template-columns: 1fr 2fr;*/
  grid-template-areas:
  'headerlogo navSection';
  background-color: white;
  padding-top: 5px;
    height: 85px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.nav button{
  border: none;
  color: #5e5e5e;
  display: inline-block;
  top:30px;
  font-size: 16px;
  left: -20%;
  padding: 5px 5px 5px 5px;
  outline: none;
  background-color:white;
  margin-left: 5px;
  margin-right: 5px;
  
}

input[type="button"]{
  outline: none;
}
.nav-btn-group {
  /*width: 150px;*/
  height: 40px;
  font-size: 15px;
}   
.nav-btn-group-select {
  width: 130px;
  height: 40px;
  font-size: 15px;        
  background: url('../site-images/nav_button_green_spark.png') no-repeat top left;
}       
.nav-btn-group:hover {        
  background: url('../site-images/nav_button_blue_spark.png') no-repeat top left;
}

#Final_comment{
	  border: 1px solid #00BCD4;
	  height: 100px;
	  width: 350px;
}

.btn_view {
    border: none;
    background: #007197;
    color: white;
    padding: 5px 15px 5px 15px;
    outline: none;
    border-radius: 15px;
}
.btn_view:hover:not([disabled]) {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    color: #007197;
    background: white;
}
   
</style>

	</head>
	<body>
	<?php include('queryHeader.php'); ?>
	<div class="container">	
		<div id="content-section">
			<div id="RecepientSection">
				<span>Conversation with:</span>
				<div id="receipientDetailsSection">
				</div>
			</div>
			<div id="FileUploadSection">
				<span>Documents Recieved/Sent:</span>
				<div id="fileUploadsDetailsSection">
				</div>
				<input type="file" name="queryFileToUpload" id="<?php if($getQueryStatusVal == "Closed"){echo "queryFileToUploadDisabled";}else{echo "queryFileToUpload";} ?>" <?php if($getQueryStatusVal == "Closed"){echo "disabled";} ?>>
				<button type="button" id="<?php if($getQueryStatusVal == "Closed"){echo "SubmitQueryFileUploadDisabled";}else{echo "SubmitQueryFileUpload";} ?>" name="submit-query-file" <?php if($getQueryStatusVal == "Closed"){echo "disabled";} ?>>Upload</button>
			</div>
			<div id="Rating-section">
				<?
					if($isClose == 'Closed'){
						?>
						 <br>&nbsp;<br>&nbsp;<br>&nbsp;<b>This query has been marked as concluded.</b>
				  			<br>
								Please rate your overall experience with your Mentor:
							<br>
							<fieldset id="RateSelect" class="rating" <? if($isRating){echo ' disabled="true" style="pointer-events: none;"';}  ?>>
						    <input type="radio" id="star5" name="rating" value="5" <? if($isRating == 5){echo " checked";}  ?>/><label class = "full" for="star5" title="5 stars"></label>
						    <input type="radio" id="star4" name="rating" value="4" <? if($isRating == 4){echo " checked";}  ?>/><label class = "full" for="star4" title="4 stars"></label>
						    <input type="radio" id="star3" name="rating" value="3" <? if($isRating == 3){echo " checked";}  ?>/><label class = "full" for="star3" title="3 stars"></label>
						    <input type="radio" id="star2" name="rating" value="2" <? if($isRating == 2){echo " checked";}  ?>/><label class = "full" for="star2" title="2 stars"></label>
						    <input type="radio" id="star1" name="rating" value="1" <? if($isRating == 1){echo " checked";}  ?>/><label class = "full" for="star1" title="1 star"></label>
						</fieldset>
						<br><br>
				Would you like to provide further details of your rating here:
						<br>
<textarea name='final-comment' id='Final_comment' rows='5' cols='50' maxlength='500' spellcheck='true' placeholder='Your comments will not be viewed by the Mentors.' <? if($isComment){echo ' disabled="true">'.$isComment;}else{echo '>';}  ?></textarea><br>
						<? if($isComment){
							echo '<br><b>Thank you for your feedback.</b>';
							}else{

							?>
									<button type='submit' id='SubFinalComBtn' value='$qid' name='submit-final-comment' class="btn_view">Submit</button>
							<?
						}  
					}
				?>

			</div>
			<div id="MessagesSection">
				<span>Your Messages:</span>
				<div id="comment-section">				
				</div>
				<div id="input-section">
				<div id='add-mentor-coment'>
					<div id='commentText'>
						<textarea name='commentVal' id='add-comment-text' rows='2' cols='50' maxlength='500' placeholder='Type a message here' spellcheck='true' <?php if($getQueryStatusVal == "Closed"){echo "disabled";} ?>></textarea>
						<button type='submit' id='SubQueryComBtn' value='$qid' name='submit-comment' <?php if($getQueryStatusVal == "Closed"){echo "disabled";} ?>>Send</button>
					</div>			
				</div>				
			</div>			
			</div>			
		</div>		
	</div>	
	<?php include('queryFooter.php'); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		var qid = <?php echo $qid ?>;
		var uid = <?php echo $userID ?>;
		var urid = <?php echo $UserRollNum ?>;
		getComments(qid);	
		getRecepientDetails(qid);
		getFileUploadDetails(qid);
		
		$("input[type=radio]").on( "click", function() {
			var queryID = qid;
			var ratedval = $( "input:checked" ).val();
			$.ajax({
				url:"save_rating.php",
				type:"POST",
				data: {
					'func':'rating',
					'QueryID':qid,
					'Rating':ratedval
				},
				cache: false,
				success: function(data){
					location.reload(true);
				}				
			});
		});

		$(document).on('click', '#SubFinalComBtn', function() {
			var queryID = qid;
			var finalcom = $('#Final_comment').val();
			$.ajax({
				url:"save_rating.php",
				type:"POST",
				data: {
					'func':'finalcomment',
					'QueryID':qid,
					'comment':finalcom
				},
				cache: false,
				success: function(data){
					location.reload(true);
				}	
			});
		});

		function getComments(qid){
			var queryID = qid;
			$.ajax({
				url:"queryFunctions.php",
				type:"POST",
				data: {'qType':'getComments',
				'qid':queryID},
				cache: false,
				success: function(data){
					$('#comment-section').html(data);
				}
			});
		}
		
		function getRecepientDetails(qid){
			var queryID = qid;
			$.ajax({
				url:"queryFunctions.php",
				type:"POST",
				data: {'qType':'getRecepientDetails',
				'urid':urid,
				'qid':qid},
				cache: false,
				success: function(data){
					$('#receipientDetailsSection').html(data);
				}
			});
		}
		
		function getFileUploadDetails(qid){
			$.ajax({
				url:"queryFunctions.php",
				type:"POST",
				data: {'qType':'getUploadedFiles',
				'qid':qid},
				cache: false,
				success: function(data){
					$('#fileUploadsDetailsSection').html(data);
				}
			});
		}	
		
		$(document).on('click', '#SubQueryComBtn', function() {			
			var commValue = $('#add-comment-text').val();			
			if(commValue == ""){
				alert("Comment not provided");
			}else{
				$.ajax({					
					url: "queryFunctions.php",
					type: "POST",
					data: {'qType':'addComment',
					'qid':qid,
					'commentVal':commValue,
					'userID':uid,
					'userRollID':urid},
					cache: false,
					success: function(data){
						$('#add-comment-text').val("");
						getComments(qid);
					}
				});
			}
		});	
		
		$(document).on('click', '#SubmitQueryFileUpload', function() {			
			var FCFormData = new FormData();
			
			if($('#queryFileToUpload').get(0).files.length === 0){				
				alert("no file selected to upload!");
			}else{				
				var FileToUp = $('#queryFileToUpload')[0].files[0];
				FCFormData.append("file", FileToUp);				
				FCFormData.append("qType", 'uploadFile');				
				FCFormData.append("qid", qid);
				FCFormData.append("uid", uid);
				FCFormData.append("userRollID", urid);
								
				$.ajax({					
					url: "queryFunctions.php",
					type: "POST",
					dataType: 'text',
					cache: false,
					contentType: false,
					processData: false,
					data: FCFormData,
					success: function(data){
						console.log(data);
						getComments(qid);
						getFileUploadDetails(qid)
					}
				});
				
			}
			
		});
		
	});		
	</script>
	</body>
</html>

