<?php
include('../config/database_conn.php');
if(isset($_POST["func"])){
	if($_POST["func"] == 'rating'){
		$qid = $_POST["QueryID"];
		$rate = $_POST["Rating"];
		$GETstatSQL = "UPDATE support.QueryNotes SET ClientRating = $rate WHERE QueryID = $qid;";
		$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	    $GETstatResult = sqlsrv_fetch_array($GETstatQuery);
	}
	if($_POST["func"] == 'finalcomment'){
		$qid = $_POST["QueryID"];
		$comment = $_POST["comment"];
		$GETstatSQL1 = "UPDATE support.QueryNotes SET ClientRatingComment = '$comment' WHERE QueryID = $qid;";
		$GETstatQuery1 = sqlsrv_query($objCon, $GETstatSQL1);
	    $GETstatResult1 = sqlsrv_fetch_array($GETstatQuery1);
	}
}

?>

