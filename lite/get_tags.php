<?php
include('../config/database_conn.php');
$data = array();

if(isset($_GET["query"]))
{

	$strSQL = "SELECT TOP 10 Tag FROM FetolaDB.support.Tags WHERE Tag LIKE '".$_GET["query"]."%' ORDER BY Tag ASC;";
	$objQuery = sqlsrv_query($objCon, $strSQL);
	if( $objQuery === false) {
	die( print_r( sqlsrv_errors(), true) );
	}
	while( $row = sqlsrv_fetch_array( $objQuery, SQLSRV_FETCH_ASSOC) )
 	{
  	$data[] = $row["Tag"];
 	}
}
echo json_encode($data);

?>

