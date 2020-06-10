<?php
	$serverName = "fetolasqlsvr.database.windows.net"; 
    $connectionOptions = array(
        "Database" => "FetolaDB",
        "Uid" => "fetoladbadmin",
        "PWD" => "Ad31nU53r4F3t01a" //F3t0laAdm1n
    );
	
	$objCon = sqlsrv_connect($serverName, $connectionOptions);
	
	if( $objCon === false ) {
      die( print_r( sqlsrv_errors(), true));
     }
?>	 