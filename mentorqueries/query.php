<?php
	include('../config/database_conn.php');
	session_start();
	
	$UserRollNum = $_SESSION["RollNum"];
	$userID = $_SESSION["UserID"];	
	$qid = $_POST['queryID'];
	
	$getQueryStatusSql = "SELECT Status FROM support.Queries WHERE QueryID = '$qid'";
	$getQueryStatusQuery = sqlsrv_query($objCon, $getQueryStatusSql);
	$getQueryStatusRow = sqlsrv_fetch_array($getQueryStatusQuery, SQLSRV_FETCH_ASSOC);
	$getQueryStatusVal = $getQueryStatusRow['Status'];
?>

<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" type="text/css" href="../style-css/Styles-mentorqueries.css">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
		<script src="https://kit.fontawesome.com/a012f76b8f.js" crossorigin="anonymous"></script>
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
			<div id="MessagesSection">
				<span>My Messages:</span>
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

