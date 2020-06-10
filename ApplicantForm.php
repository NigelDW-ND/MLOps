<?php 

	ini_set('display_errors', 0);
	error_reporting(~0);

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
$id_signupdate = GUID();
$thischampaige = $_POST[thischampaige];
$title = $_POST[title];
$firstname = $_POST[firstname];
$lastname = $_POST[lastname];
$gender = $_POST[gender];
$ethnicity = $_POST[ethnicity];
$dateofbirth = $_POST[dateofbirth];
$disability = $_POST[disability];
$disabilityinfo = $_POST[disabilityinfo];
$email = $_POST[email];
$phonenumber = $_POST[phonenumber];
$altnumber = $_POST[altnumber];
$idnumber = $_POST[idnumber];
$citizen = $_POST[citizen];
$citizeninfo = $_POST[citizeninfo];
$address = $_POST[address];
$address2 = $_POST[address2];
$city = $_POST[city];
$province  = $_POST[province ];
$postalcode = $_POST[postalcode];
$impactlab = $_POST[impactlab];
$other = $_POST[other];
$kinfirstname = $_POST[kinfirstname];
$kinlastname  = $_POST[kinlastname ];
$relationship = $_POST[relationship];
$kinemail = $_POST[kinemail];
$kinphonenumber = $_POST[kinphonenumber];
$entname = $_POST[entname];
$enttradename = $_POST[enttradename];
$groups = $_POST[groups];
$Otherspecify = $_POST[Otherspecify];
$sector = $_POST[sector];
$sectorother = $_POST[sectorother];
$entaddress = $_POST[entaddress];
$entcity = $_POST[entcity];
$entprovince = $_POST[entprovince];
$entnumber = $_POST[entnumber];
$entemail = $_POST[entemail];
$entweb = $_POST[entweb];
$entmedia = $_POST[entmedia];
$entperiod = $_POST[entperiod];
$entdatestarted = $_POST[entdatestarted];
$regnumber = $_POST[regnumber];
$overview = $_POST[overview];
$cbxskills = $_POST[cbxskills];
$cbxyouth = $_POST[cbxyouth];
$cbxeducation = $_POST[cbxeducation];
$cbxcommunity = $_POST[cbxcommunity];
$cbxfemale = $_POST[cbxfemale];
$cbxhealth = $_POST[cbxhealth];
$cbxjob = $_POST[cbxjob];
$cbxgoods = $_POST[cbxgoods];
$cbxhuman = $_POST[cbxhuman];
$cbxenviromental = $_POST[cbxenviromental];
$cbxelderly = $_POST[cbxelderly];
$cbxother = $_POST[cbxother];
$cbxotherspecify = $_POST[cbxotherspecify];
$txtstart = $_POST[txtstart];
$txtcontributes = $_POST[txtcontributes];
$txtdifferent = $_POST[txtdifferent];
$txtstage = $_POST[txtstage];
$txtevidence = $_POST[txtevidence];
$txtcommercial = $_POST[txtcommercial];
$txtneeds = $_POST[txtneeds];
$txtstrenghts = $_POST[txtstrenghts];
$txtweakness = $_POST[txtweakness];
$txtprogress = $_POST[txtprogress];
$txtchallenges = $_POST[txtchallenges];
$txtgoals = $_POST[txtgoals];
$clientname1 = $_POST[clientname1];
$value1 = $_POST[value1];
$product1 = $_POST[product1];
$amount1 = $_POST[amount1];
$Clientname2 = $_POST[Clientname2];
$Value2 = $_POST[Value2];
$Product2 = $_POST[Product2];
$Amount2 = $_POST[Amount2];
$Clientname3 = $_POST[Clientname3];
$Value3 = $_POST[Value3];
$Product3 = $_POST[Product3];
$Amount3 = $_POST[Amount3];
$txtsource = $_POST[txtsource];
$txtexperience = $_POST[txtexperience];
$ftmale = $_POST[ftmale];
$ftfemale = $_POST[ftfemale];
$ftyouth = $_POST[ftyouth];
$ptmale = $_POST[ptmale];
$ptfemale = $_POST[ptfemale];
$ptyouth = $_POST[ptyouth];
$csmale = $_POST[csmale];
$csfemale = $_POST[csfemale];
$csyouth = $_POST[csyouth];
$name1 = $_POST[name1];
$id1 = $_POST[id1];
$position1 = $_POST[position1];
$ethnicity1 = $_POST[ethnicity1];
$gender1 = $_POST[gender1];
$ownpct1 = $_POST[ownpct1];
$name2 = $_POST[name2];
$id2 = $_POST[id2];
$position2 = $_POST[position2];
$Ethnicity2 = $_POST[Ethnicity2];
$gender2 = $_POST[gender2];
$ownpct2 = $_POST[ownpct2];
$name3 = $_POST[name3];
$id3 = $_POST[id3];
$position3 = $_POST[position3];
$ethnicity3 = $_POST[ethnicity3];
$gender3 = $_POST[gender3];
$ownpct3 = $_POST[ownpct3];
$name4 = $_POST[name4];
$id4 = $_POST[id4];
$position4 = $_POST[position4];
$ethnicity4 = $_POST[ethnicity4];
$gender4 = $_POST[gender4];
$ownpct4 = $_POST[ownpct4];
$name5 = $_POST[name5];
$id5 = $_POST[id5];
$position5 = $_POST[position5];
$ethnicity5 = $_POST[ethnicity5];
$gender5 = $_POST[gender5];
$ownpct5 = $_POST[ownpct5];


$data1 = "INSERT INTO forms.tb_signup_update
(
	id_signupdate
	,thischampaige
	,title
	,firstname
	,lastname
	,gender
	,ethnicity
	,dateofbirth
	,disability
	,disabilityinfo
	,email
	,phonenumber
	,altnumber
	,idnumber
	,citizen
	,citizeninfo
	,address
	,address2
	,city
	,province 
	,postalcode
	,impactlab
	,other
	,kinfirstname
	,kinlastname 
	,relationship
	,kinemail
	,kinphonenumber
	,entname
	,enttradename
	,groups
	,Otherspecify
	,sector
	,sectorother
	,entaddress
	,entcity
	,entprovince
	,entnumber
	,entemail
	,entweb
	,entmedia
	,entperiod
	,entdatestarted
	,regnumber
	,overview
	,cbxskills
	,cbxyouth
	,cbxeducation
	,cbxcommunity
	,cbxfemale
	,cbxhealth
	,cbxjob
	,cbxgoods
	,cbxhuman
	,cbxenviromental
	,cbxelderly
	,cbxother
	,cbxotherspecify
	,txtstart
	,txtcontributes
	,txtdifferent
	,txtstage
	,txtevidence
	,txtcommercial
	,txtneeds
	,txtstrenghts
	,txtweakness
	,txtprogress
	,txtchallenges
	,txtgoals
	,clientname1
	,value1
	,product1
	,amount1
	,Clientname2
	,Value2
	,Product2
	,Amount2
	,Clientname3
	,Value3
	,Product3
	,Amount3
	,txtsource
	,txtexperience
	,ftmale
	,ftfemale
	,ftyouth
	,ptmale
	,ptfemale
	,ptyouth
	,csmale
	,csfemale
	,csyouth
	,name1
	,id1
	,position1
	,ethnicity1
	,gender1
	,ownpct1
	,name2
	,id2
	,position2
	,Ethnicity2
	,gender2
	,ownpct2
	,name3
	,id3
	,position3
	,ethnicity3
	,gender3
	,ownpct3
	,name4
	,id4
	,position4
	,ethnicity4
	,gender4
	,ownpct4
	,name5
	,id5
	,position5
	,ethnicity5
	,gender5
	,ownpct5
)
VALUES
(";
$data1 .= "'$id_signupdate',";
$data1 .= "'$thischampaige',";
$data1 .= "'$title',";
$data1 .= "'$firstname',";
$data1 .= "'$lastname',";
$data1 .= "'$gender',";
$data1 .= "'$ethnicity',";
$data1 .= "'$dateofbirth',";
$data1 .= "'$disability',";
$data1 .= "'$disabilityinfo',";
$data1 .= "'$email',";
$data1 .= "'$phonenumber',";
$data1 .= "'$altnumber',";
$data1 .= "'$idnumber',";
$data1 .= "'$citizen',";
$data1 .= "'$citizeninfo',";
$data1 .= "'$address',";
$data1 .= "'$address2',";
$data1 .= "'$city',";
$data1 .= "'$province ',";
$data1 .= "'$postalcode',";
$data1 .= "'$impactlab',";
$data1 .= "'$other',";
$data1 .= "'$kinfirstname',";
$data1 .= "'$kinlastname ',";
$data1 .= "'$relationship',";
$data1 .= "'$kinemail',";
$data1 .= "'$kinphonenumber',";
$data1 .= "'$entname',";
$data1 .= "'$enttradename',";
$data1 .= "'$groups',";
$data1 .= "'$Otherspecify',";
$data1 .= "'$sector',";
$data1 .= "'$sectorother',";
$data1 .= "'$entaddress',";
$data1 .= "'$entcity',";
$data1 .= "'$entprovince',";
$data1 .= "'$entnumber',";
$data1 .= "'$entemail',";
$data1 .= "'$entweb',";
$data1 .= "'$entmedia',";
$data1 .= "'$entperiod',";
$data1 .= "'$entdatestarted',";
$data1 .= "'$regnumber',";
$data1 .= "'$overview',";
$data1 .= "'$cbxskills',";
$data1 .= "'$cbxyouth',";
$data1 .= "'$cbxeducation',";
$data1 .= "'$cbxcommunity',";
$data1 .= "'$cbxfemale',";
$data1 .= "'$cbxhealth',";
$data1 .= "'$cbxjob',";
$data1 .= "'$cbxgoods',";
$data1 .= "'$cbxhuman',";
$data1 .= "'$cbxenviromental',";
$data1 .= "'$cbxelderly',";
$data1 .= "'$cbxother',";
$data1 .= "'$cbxotherspecify',";
$data1 .= "'$txtstart',";
$data1 .= "'$txtcontributes',";
$data1 .= "'$txtdifferent',";
$data1 .= "'$txtstage',";
$data1 .= "'$txtevidence',";
$data1 .= "'$txtcommercial',";
$data1 .= "'$txtneeds',";
$data1 .= "'$txtstrenghts',";
$data1 .= "'$txtweakness',";
$data1 .= "'$txtprogress',";
$data1 .= "'$txtchallenges',";
$data1 .= "'$txtgoals',";
$data1 .= "'$clientname1',";
$data1 .= "'$value1',";
$data1 .= "'$product1',";
$data1 .= "'$amount1',";
$data1 .= "'$Clientname2',";
$data1 .= "'$Value2',";
$data1 .= "'$Product2',";
$data1 .= "'$Amount2',";
$data1 .= "'$Clientname3',";
$data1 .= "'$Value3',";
$data1 .= "'$Product3',";
$data1 .= "'$Amount3',";
$data1 .= "'$txtsource',";
$data1 .= "'$txtexperience',";
$data1 .= "'$ftmale',";
$data1 .= "'$ftfemale',";
$data1 .= "'$ftyouth',";
$data1 .= "'$ptmale',";
$data1 .= "'$ptfemale',";
$data1 .= "'$ptyouth',";
$data1 .= "'$csmale',";
$data1 .= "'$csfemale',";
$data1 .= "'$csyouth',";
$data1 .= "'$name1',";
$data1 .= "'$id1',";
$data1 .= "'$position1',";
$data1 .= "'$ethnicity1',";
$data1 .= "'$gender1',";
$data1 .= "'$ownpct1',";
$data1 .= "'$name2',";
$data1 .= "'$id2',";
$data1 .= "'$position2',";
$data1 .= "'$Ethnicity2',";
$data1 .= "'$gender2',";
$data1 .= "'$ownpct2',";
$data1 .= "'$name3',";
$data1 .= "'$id3',";
$data1 .= "'$position3',";
$data1 .= "'$ethnicity3',";
$data1 .= "'$gender3',";
$data1 .= "'$ownpct3',";
$data1 .= "'$name4',";
$data1 .= "'$id4',";
$data1 .= "'$position4',";
$data1 .= "'$ethnicity4',";
$data1 .= "'$gender4',";
$data1 .= "'$ownpct4',";
$data1 .= "'$name5',";
$data1 .= "'$id5',";
$data1 .= "'$position5',";
$data1 .= "'$ethnicity5',";
$data1 .= "'$gender5',";
$data1 .= "'$ownpct5'";
$data1 .= ");";

	$serverName = "fetolasqlsvr.database.windows.net"; // update me
    $connectionOptions = array(
        "Database" => "FetolaDB", // update me
        "Uid" => "fetoladbadmin", // update me
        "PWD" => "F3t0laAdm1n" // update me
    );
	
	$objCon = sqlsrv_connect($serverName, $connectionOptions);
	
	if( $conn === false ) {
      die( print_r( sqlsrv_errors(), true));
     }	
	
	$validstrSQL = "SELECT * FROM forms.tb_signup_update WHERE thischampaige = '$thischampaige' and entname = '$entname'";
	$validobjQuery = sqlsrv_query($objCon, $validstrSQL);
	$validobjResult = sqlsrv_fetch_array($validobjQuery,SQLSRV_FETCH_ASSOC);
	
	if(!$validobjResult)
	{
			header("Location: index.php?error=2", true, 301);
	}
	else
	{
		$strSQL = $data1;
			$objQuery = sqlsrv_query($objCon, $strSQL);
			$objResult = sqlsrv_fetch_array($objQuery,SQLSRV_FETCH_ASSOC);
			header("location:user_info.php?profile=$id_signupdate&uploaded=ok");
			print($id_signupdate);
	}		
	sqlsrv_close( $conn );
	

?>
