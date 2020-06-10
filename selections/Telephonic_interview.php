
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
	    	include('../participant/Participant_Progress.php');
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

		<div class="meter animate" style="width: 98%;">
			<span style="width: <? echo $GETstatResult['PercentAnsw']; ?>%"><span></span></span>
		</div>
		<div>
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
		<div style=" width:32%;height: 220px;float: left;" id="quest<? echo $row3['id_question_id']  ?>">
			<div style="width:80%; height: 25px;"><b><? echo $row3['str_question']  ?></b></div>
			<br>
			Responce:
			<br><?
		if(!$objResult4){
				?>
			<textarea rows="4" cols="60" name="comment<? echo $row3['id_question_id'] ?>" id="comment<? echo $row3['id_question_id'] ?>"></textarea>
			<br>
			Rating: <input type="range" id="vol<? echo $row3['id_question_id'] ?>" name="vol<? echo $row3['id_question_id'] ?>" min="1" max="5" value="1">
			<br>
			<button  class="clk_comment" onclick="sample('<? echo $row3['id_question_id']  ?>')" value="1"><b>Apply</b></button><?
		}else{
			echo "<b>".urldecode($objResult4['str_answer'])."</b>" ?>
			<br>
			Rating: <? echo "<b>".$objResult4['int_answer_rating']."</b>" ?>
			<br>
			<?
		}
			?>
			<br>
			<div style="width:80%; height: 30px;"><hr></div>
		</div>
		<?  
			if ($index % 3 == 2) { // end of the row or last
				echo '</div>';
					}
			$index++;
			}
		?>
</div>
<br>
<?
if($GETstatResult['PercentAnsw'] == 100){
	?><button  class="clk_comment" onclick="location.href = 'InParticants_page.php';"><b>Done</b></button><?
}


	sqlsrv_close($objCon);
?>
<script>
	function sample(x) {
		var bus_guid = encodeURI(document.getElementById("business_key").value);
		var comment = encodeURI(document.getElementById("comment"+x).value);
		var rate = encodeURI(document.getElementById("vol"+x).value);
		   $.post("Telephonic_interview_action.php",{
    		business_key: bus_guid,
    		strComment: comment,
    		intRate: rate,
    		intQuest: x
    	},function(result){
    		document.getElementById("quest"+x).innerHTML = result;
    		location.reload();
    	});	
    }
</script>	