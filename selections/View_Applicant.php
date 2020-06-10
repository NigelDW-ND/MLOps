<?php
	ini_set('display_errors', 1);
	error_reporting(~0);
	include('../config/database_conn.php');	
	
	$SelectAppViewSql = "SELECT * FROM participant.vw_part_view_info WHERE bus_guid = '".$_POST['suggest']."';";
	$SelectAppViewQuery = sqlsrv_query($objCon, $SelectAppViewSql);
	$SelectAppViewResult = sqlsrv_fetch_array($SelectAppViewQuery);

	$SelectAppViewCommentsSql = "SELECT (SELECT a1.str_Mentor_Name FROM mentor.admin a1 WHERE a1.int_Mentor_ID = a.int_General_Note_added_By) + ' - ' + CONVERT(VARCHAR(16),a.dt_General_Note_Date)[header], a.memo_General_Note_Note[comment] FROM FetolaDB.participant.tb_General_Note a WHERE link_General_Note_Business = '".$_POST['suggest']."';";
	$SelectAppViewCommentsQuery = sqlsrv_query($objCon, $SelectAppViewCommentsSql);
	

	echo "<br>"
	?>
	
        
		<table>
		<tbody>
		<tr style="">
		<td colspan="2">Participant</td>
		</tr>
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
		<tr>
		<td>Sector:</td>
		<td><?  echo $SelectAppViewResult['bus_sec'];   ?></td>
		</tr>
		</tbody>
		</table>
		<input type="button" class="clk_comment" id="btn_Choice_yes" Name="btn_Choice_yes" Value="Close" onclick="span.onclick()">
	
		<table>
		<tbody>
	
		<tr><td>General Comments:</td><td>
			<?

				while( $row = sqlsrv_fetch_array($SelectAppViewCommentsQuery, SQLSRV_FETCH_ASSOC) ) {
				echo $row['header']."<br>".$row['comment']."<br><br>"; 

					
			}

			?>
		</td></tr><tr>
		<td>
			<?
				$Business_GUID = $_POST['suggest'];
				$strSQL3 = "SELECT * FROM FetolaDB.questionee.tb_question_list_approvals;";
				$objQuery3 = sqlsrv_query( $objCon, $strSQL3 );
				while($row3 = sqlsrv_fetch_array($objQuery3, SQLSRV_FETCH_ASSOC)){
					$strSQL4 = "SELECT * FROM FetolaDB.questionee.tb_business_answers WHERE int_business_id = '".$Business_GUID."' and int_question_id = ".$row3['id_question_id'].";";
					$objQuery4 = sqlsrv_query( $objCon, $strSQL4 );
					$objResult4 = sqlsrv_fetch_array($objQuery4,SQLSRV_FETCH_ASSOC);

					if(!$objResult4){

					}else{
						echo "<b>".$row3['str_question']."</b><br><br>";
						echo "<b>".urldecode($objResult4['str_answer'])."</b>" ?>
			<br>
			Rating: <? echo "<b>".$objResult4['int_answer_rating']."</b>" ?>
			<br>
			<hr>

			<?

					}

				}


			?>
		</td>

		</tr>


		</tbody>
		</table>
		<?
		if($objResult4){
			?><input type="button" class="clk_comment" id="btn_Choice_yes" Name="btn_Choice_yes" Value="Close" onclick="span.onclick()">
			<?
		}
	sqlsrv_close($objCon);
?>