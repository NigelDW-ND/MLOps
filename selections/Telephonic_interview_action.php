
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);
	include('../config/database_conn.php');
	$Business_GUID = $_POST["business_key"];
	$strComment = $_POST["strComment"];
	$intRate = $_POST["intRate"];
	$intQuest = $_POST["intQuest"];
	$uploadans = "INSERT INTO questionee.tb_business_answers (int_question_id, str_answer ,int_answer_rating ,int_business_id) 
					VALUES (".$intQuest.",'".$strComment."',".$intRate." ,'".$Business_GUID."')";
	$uploadansQuery = sqlsrv_query($objCon, $uploadans);
	$uploadansResult = sqlsrv_rows_affected($uploadansQuery);
	if( !$uploadansResult ) {
    die( print_r( sqlsrv_errors(), true));
	}
	else
	{
		echo "<br>Responce: <br><b>".urldecode($strComment)."</b><br>Rating: <b>".$intRate."</b>";
	


	}
	


?>



	