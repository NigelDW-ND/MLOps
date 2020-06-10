
<!DOCTYPE html>
<html>
<head>
<? 	
	include('../config/database_conn.php');
	session_start(); ?>
	<meta charset="utf-8">
	<title>Selection Landing Page</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../Style-css/Styles-selection.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body data-gr-c-s-loaded="true">
		<!-- Modal Start --------------------------------------------------------------------------------->		
<div id="selection_modal_action" style="display: none">
	<div id="selection_modal_header">
		<span class="selection_modal_action_close">&times;</span>
		<div style="width: 48; height: 48; display: table-cell;">

			<img src="../site-images/edit-property-48.png"></div>
			<div id="selection_modal_header_text" style="display: table-cell; height: 48;"></div>
		
	</div>
	<div id="selection_modal_action_data"> </div>
</div>
<!-- Modal End --------------------------------------------------------------------------------->	

		<div class="table_elements" id="body-class" >	
		<!----------------------------------------------------------------------------------->	
		<? include('nav.php'); ?>
	<?php
	ini_set('display_errors', 1);
	error_reporting(~0);
	include('../config/database_conn.php');
	$Business_GUID = $_GET["business_key"];
	$SelectAppViewSql = "SELECT * FROM participant.vw_part_view_info WHERE bus_guid = '".$Business_GUID."';";
	$SelectAppViewQuery = sqlsrv_query($objCon, $SelectAppViewSql);
	$SelectAppViewResult = sqlsrv_fetch_array($SelectAppViewQuery);
	$GETstatSQL = "EXEC questionee.get_status '".$Business_GUID."'";
	$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	$GETstatResult = sqlsrv_fetch_array($GETstatQuery);
?>
		<input type="hidden" name="business_key" id="business_key" value="<? echo $Business_GUID; ?>">
		<table>
		<tbody>
		<tr>
		<td><img src="../../site-images/profiles/<?
		$mypics = $SelectAppViewResult['part_img']; 
		if($mypics == ""){
			$mypics = "users.png";
		}else{
			$mypics = $SelectAppViewResult['part_img']; 
		}
		echo $mypics;
		?>" width="80" height="80"></td>
		<td>		<div style="align: center;">
		<?
	    	include("Participant_Progress.php");
	    ?>
		</div></td>
		</tr>
		<tr>
		<td>Business:</td>
		<td><?  echo $SelectAppViewResult['bus_name'];   ?></td>
		</tr>
		<tr>
		<td>Name:</td>
		<td><?  echo $SelectAppViewResult['part_name'];   ?></td>
		</tr>
		<tr>
		<td>Email:</td>
		<td><?  echo $SelectAppViewResult['part_email'];   ?></td>
		</tr>
		<tr>
		<td>Contact No.</td>
		<td><?  echo $SelectAppViewResult['part_cont'];   ?></td>
		</tr>
		</tbody>
		</table>
		<br>


		<div><div style=" width:32%;float: left;">
			<?
				$strSQL = "SELECT * FROM FetolaDB.questionee.tb_questionee_profile;";
				$objQuery = sqlsrv_query( $objCon, $strSQL );
				$strSQL2 = "SELECT * FROM FetolaDB.questionee.tb_business_profiles tbq INNER JOIN FetolaDB.questionee.tb_questionee_profile tqp ON tqp.id_questionee_profile = tbq.int_profile_id WHERE str_business_key = '".$Business_GUID."';";
				$objQuery2 = sqlsrv_query( $objCon, $strSQL2 );
				$objResult2 = sqlsrv_fetch_array($objQuery2,SQLSRV_FETCH_ASSOC);
				$strSQL3 = "SELECT * FROM FetolaDB.questionee.tb_question_list_approvals;";
				$objQuery3 = sqlsrv_query( $objCon, $strSQL3 );

				$index = 0;
				while($row3 = sqlsrv_fetch_array($objQuery3, SQLSRV_FETCH_ASSOC)){
					$strSQL4 = "SELECT * FROM FetolaDB.questionee.tb_business_answers WHERE int_business_id = '".$Business_GUID."' and int_question_id = ".$row3['id_question_id'].";";
					$objQuery4 = sqlsrv_query( $objCon, $strSQL4 );
					$objResult4 = sqlsrv_fetch_array($objQuery4,SQLSRV_FETCH_ASSOC);
					if ($index % 3 == 0) { // beginning of the row or first
					echo '<div style="width: 100%">';
				}
			?>
		
			<b><? echo $row3['str_question']  ?></b></div>
			<?
		if(!$objResult4){
		}else{
			echo "".urldecode($objResult4['str_answer'])."" ?>
			<br>
			Rating: <? echo "<b>".$objResult4['int_answer_rating']."</b>" ?>
			<br>
			<?
		}
			?>
			
			<hr>
		
		<?  
			}
		?>
</div><div style=" width:60%;float: right;">

	<form>
		<b>Score:</b> <? echo $GETstatResult['PercentRate']."% - Based on Telephonic Interview Answer Ratings"; ?>
		<br>
		
		<hr>
		<b>Comment:</b><br>
		<textarea id="Round_Comment" cols="150" rows="15"></textarea><br>
		<input type="button" value="Add Comment"  onclick="clk_action('<? echo $Business_GUID; ?>','Comment')">
		<br><br>
		<input type="button" value="Decline" onclick="clk_action('<? echo $Business_GUID; ?>','Decline')">
		<input type="button" value="Revisit\Pending" onclick="clk_action('<? echo $Business_GUID; ?>','Pending')">
		<input type="button" value="Clarify Applications" onclick="clk_action('<? echo $Business_GUID; ?>','Unclear')">
		<input type="button" value="Move to Workshops" onclick="clk_action('<? echo $Business_GUID; ?>','Workshop')">






	</form>
		<hr>
		<div id="selection_modal_action_data"></div>
		<b>Comment History:</b>
		<br>
		<?
			$CommentsSQL = "SELECT * FROM FetolaDB.participant.tb_General_Note WHERE link_General_Note_Business = '".$Business_GUID."' ORDER BY dt_General_Note_Date DESC";
			$CommentsQuery = sqlsrv_query($objCon, $CommentsSQL);
			
			while($Commentsr = sqlsrv_fetch_array($CommentsQuery, SQLSRV_FETCH_ASSOC)){
				echo "<b>".date_format($Commentsr['dt_General_Note_Date'], 'Y/m/d H:i:s')."</b><br>".$Commentsr['memo_General_Note_Note']."<br><br>";
			}

		?>
		<hr>
		<b>Application Details:</b>
		<br>
</div></div>
<br>
<?
	sqlsrv_close($objCon);
?>
<script>
	function clk_action(x,y) {
		var commenttext = document.getElementById("Round_Comment").value;
		var action = y;
		var bus_guid = x;
		if (action == 'Comment') {
		  $.post("Add_Comment.php",{
    		note: commenttext,
    		guid: bus_guid
    	},function(result){
    		location.reload();
    	});

		} 
		if (action == 'Decline') {
		  $.post("Updated_Part_Status.php",{
    		status: 1,
    		guid: bus_guid
    	},function(result){
    		location.reload();
    	});

		}
		if (action == 'Pending') {
		  $.post("Updated_Part_Status.php",{
    		status: 2,
    		guid: bus_guid
    	},function(result){
    		location.reload();
    	});

		}
		if (action == 'Unclear') {
		  $.post("Updated_Part_Status.php",{
    		status: 3,
    		guid: bus_guid
    	},function(result){
    		location.reload();
    	});

		}
		if (action == 'Workshop') {
		  $.post("Updated_Part_Status.php",{
    		status: 10,
    		guid: bus_guid
    	},function(result){
    		location.reload();
    	});
		}
	}
</script>
</body>
</html>