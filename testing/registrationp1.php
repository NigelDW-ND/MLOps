<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome To Fetola</title>
<link href="../style-css/registerstyle.css" rel="stylesheet">	
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> 
</head>	
<body>


    <?php
Include '../config/database_conn.php';
$serv_name = $_SERVER['SERVER_NAME'];	


$row1="";
$Result1="";
$error="";
$expdate=""; 
$Result1="";
$OTP="";
$email="";
$email1="";
$sq1="";
$row5="";
$pass1="";
$OTP1="";
$string="";
$sel_query_ret="";
$result2="";
$row51="";
$sel_query_chk="";
$result3="";
$row2="";
$sel_query_ins="";
$sel_query_chk1="";
$result4="";
$row53="";
$sel_query_ins1="";
$result11="";
$resulte="";
$result4a="";
$result3a="";
$row5="";
$Result2d="";
$result2e="";
$resulta="";
$query5="";
$FirstName="";





$email = $_SESSION["email"] ;
// $email = "bevanpaulse@gmail.com";
// $email = "bevan@datanav.co.za";

// $result1 = str_replace('<', '', $email);
// var_dump($result1);

$email1 = $email;
$params = array();

// $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET );

// $sel_query = "select * from participant.admin where str_participant_Email = '".$email1."'";
// var_dump($sel_query);
echo "<br />";
$sel_querya = "select count(*) as count from participant.admin where str_participant_Email = '".$email1."'";
var_dump($sel_querya);
echo "<br />";

$resulta = sqlsrv_query($objCon,$sel_querya);



$row1 = sqlsrv_fetch_array($resulta,SQLSRV_FETCH_ASSOC);



if ( !isset($row1['count']) ){
	exit();
}

// if ( $row1['count'] == 0 ) {}

// $expdate = $row1['count'];
// exit();

if ( $row1['count'] == 0 ) {
	echo "You are not registered in the database, Please contact FNB to be registered";
} else {

	echo "Register new user<br />";


// $expdate = $row1['count'];
// exit();
// if ( $expdate == "" ) {
	// echo "You are not registered in the database, Please contact FNB to be registered";}
// else if( $expdate === 1 ){

//Query values to pass back to register form

	$result4a = "SELECT a.str_participant_Name as [FirstName], a.str_participant_Contact as [Contact], TP.Bus_Name as [Bus_Name], TP.Title as [Title], TP.Gender as [Gender], TP.Address as [Address], TP.Prov as [Province], CD.Bee_score as [Bee_score], CD.Annual_Revenue as [Annual_Revenue], CD.Business_Age as [Business_Age], CD.Employee_Count as [Employee_Count], CD.Industry as [Industry], CD.CoRegistration as [Coregistration]  FROM participant.admin a
	inner join import.TP_Status_Info TP on a.id_participant_GUID = TP.Business_GUID
	inner join support.CompanyDet CD on TP.int_ID_Status = CD.Businessdet_ID
	WHERE a.str_participant_Email = '".$email1."'";

	$query5 = sqlsrv_query($objCon,$result4a);
	$row5 = sqlsrv_fetch_array($query5,SQLSRV_FETCH_ASSOC);

	// var_dump($row5);

if ( empty($row5) ){

  echo "There is no data available";

} else {


	$user = $row5;

	$User_FirstName			= $user['FirstName'];
	$User_Contact			= $user['Contact'];
  $User_Bus_Name			= $user['Bus_Name'];
  $User_Title			= $user['Title'];
  $User_Gender			= $user['Gender'];
  $User_Address      = $user['Address'];
	$User_Province			= $user['Province'];
	$User_Bee_score			= $user['Bee_score'];
	$User_Annual_Revenue	= $user['Annual_Revenue'];
	$User_Business_Age		= $user['Business_Age'];
	$User_Employee_Count	= $user['Employee_Count'];
	$User_Industry			= $user['Industry'];
  $User_Coregistration	= $user['Coregistration'];
  

?>

<br>

         <img src="../site-images/logo_150px.png" style="width:200px;height:75px; position: relative; left:30%" alt="fetola">

         <hr>

         <h2>Welcome to the Fetola registration page!</h2>

	<div class="welcome_text">You are one step away, please complete the registration form below</div><br><br>

      <form method="post" action="registration1.php">

    <?php //include('errors.php'); ?>

        <div class="input-group">

        <label>Title </label>

        <select id="Title" name="Title" class = "pass_reset" style="font-size:20px;" type="text" >
        <option value="">Select...</option>
        <?php

        $Titlelist = array( 'Mr', 'Mrs', 'Ms', 'Prof' );
         
        foreach ( $Titlelist as $Titleitem) {
          if ( $Titleitem = $User_Title ) {
            echo "<option value='".$Titleitem."' selected>",ucfirst($Titleitem)."</option>";
           } else  {
             echo "<option value='".$Titleitem."'>".ucfirst($Titleitem)."</option>";
           }
          }
        ?>
        </select>

       </div>

        <br>

      <div class="input-group">

      <label>Firstname</label>

      <input type="text" name="Firstname" style="font-size:20px;" value = "<?php echo $User_FirstName;?>" >

  </div>


		<br>
		<br>

		<div class="input-group">
      
     <label>Gender</label>
      
       <select style="font-size:20px;" name="Gender">
      
         <option value="">Select...</option>
				 <?php

					$genderList = array( 'male', 'female', 'other' );

					foreach ( $genderList as $genderItem ) {
						if ( $genderItem == $User_Gender ) {
							echo "<option value='".$genderItem."' selected>".ucfirst($genderItem)."</option>";
						} else {
							echo "<option value='".$genderItem."'>".ucfirst($genderItem)."</option>";
						}
					}
				?>
			</select>

		</div>

      <br>

      <br>

      <div class="input-group">
      <label>Business Name</label>

      <input type="text" name="Businessname" style="font-size:20px;" value = "<?php echo $User_Bus_Name; ?>">

      </div>

        <br>

      <div class="input-group">

        <label>In which industry is your business?</label>

        <select style="font-size:20px;" name="Industry" class = "pass_reset" >

        <option value="">Select...</option>
        
        <?php

          $industrylist = array( 'Agriculture forestry and fishing', 'Mining', 'Manufacturing', 'Electricity gas steam and air conditioning supply', 'Water supply sewerage and waste management activities', 'Construction', 'Wholesale and retail trade', 'Transportation and Storage',
          'Accomodation and food services', 'Information and communication', 'Financial and insurance services', 'Real Estate', 'Scientific and technical services', 'Education', 'Human health and social work activities', 'Arts entertainment and recreation', 'Other Services'  ); 

        
					foreach ( $industryList as $industryitem ) {
						if ( $industryitem == $User_Industry ) {
							echo "<option value='".$industryItem."' selected>".ucfirst($industryItem)."</option>";
						} else {
							echo "<option value='".$industryItem."'>".ucfirst($industryItem)."</option>";
						}
					}
				?>
			</select>


      </div>

        <br>

      <div class="input-group">

      <label>Company Registration Number</label>

        <input type="text" name="CompanyRegistrationNumber" style="font-size:20px;" value = "<?php echo $User_Coregistration;?>" >

    </div>

       <br>

    <div class="input-group">

        <label>How long has your company been in business for?</label>

        <select style="font-size:20px;" name="Companyage">

        <option value="">Select...</option>

        <?php

          $businessagelist = array( 'less than 6 months', 'between 6 months and 1 year', 'between 1 and 2 years', 'between 2 and 3 years', 'between 3 and 5 years', 'more than 5 years' ); 


          foreach ( $businessagelist as $businessageitem ) {
            if ( $businessageitem == $User_Business_Age ) {
             echo "<option value='".$businessageitem."' selected>".ucfirst($businessageitem)."</option>";
            } else {
             echo "<option value='".$businessageitem."'>".ucfirst($businessageitem)."</option>";
    }
  }
?>
</select>

      
</div>

      <br>

      <br>

       <div class="input-group" >

        <label>How many people are employed at your company?</label>

         <br>

        <select style="font-size:20px;" name="Headcount" value = "<?Php echo '<option value="'. $Empcount  .'">' . $Empcount .'</option>'?>">

        <option value="">Select...</option>

        <?php

       $employeecountlist = array('1-10', '11-50', '51-100', '101-300', '301-500'); 


        foreach ( $employeecountlist as $employeecountitem ) {
         if ( $employeecountitem == $User_Employee_Count ) {
          echo "<option value='".$employeecountitem."' selected>".ucfirst($employeecountitem)."</option>";
       } else {
          echo "<option value='".$employeecountitem."'>".ucfirst($employeecountitem)."</option>";

       }
        }
        ?>
       
       </select>

    </div>

      <br>

    <div class="input-group" >

      <label>What was the annual revenue for your company last year?</label>

      <select style="font-size:20px;" name="Annualrev" value = "<?Php echo '<option value="'. $Annrev  .'">' . $Annrev .'</option>'?>">

      <option value="">Select...</option>

      <?php

        $annualrevenuelist = array('0-335000', '335001-500000', '500001-750000', '750001-1000000', '1000000-5000000'); 


          foreach ( $annualrevenuelist as $annualrevenueitem ) {
           if ( $annualrevenueitem == $User_Annual_Revenue ) {
            echo "<option value='".$annualrevenueitem."' selected>".ucfirst($annualrevenueitem)."</option>";
         } else {
            echo "<option value='".$annualrevenueitem."'>".ucfirst($annualrevenueitem)."</option>";

}
}
?>
      </select>

    </div>

      <br>

    <div class="input-group" >

        <label>What is your BEE Score?</label>

        <select name="Beescore" style="font-size:20px;" value = "<?Php echo '<option value="'. $Beescore  .'">' . $Beescore .'</option>'?>">

        <option value="">Select...</option>

        <?php

          $beescorelist = array('Level 1 - 100%', 'Level 2 - 85 to 99%', 'Level 3 - 75 to 84.99%', 'Level 4 - 65 to 74.99%', 'Level 5 - 55 to 64.99%', 'Level 6 - 45 to 54.99%', 'Level 7 - 40 to 44.99%', 'Level 8 - 30 to 39.99%"' ); 


           foreach ( $beescorelist as $beescoreitem ) {
            if ( $beescoreitem== $User_Bee_score	) {
             echo "<option value='".$beescoreitem."' selected>".ucfirst($beescoreitem)."</option>";
          } else {
             echo "<option value='".$beescoreitem."'>".ucfirst($beescoreitem)."</option>";

}
}
?>
       </select>

</div>

      <br>

<div class="input-group">

      <label>Email</label>

        <input type="email" name="email" id="email" style="font-size:20px;" value = "<?php echo $email1 ;?>" >
        
    </div>

      <br>

       <div class="input-group">

      <label>Contact Number</label>

        <input type="text" name="contactnumber" style="font-size:20px;" value = "<?php echo $User_Contact ;?>" >

    </div>

      <br>

    <div class="input-group">

      <label>Address</label>

        <input type="text" name="Address" style="font-size:20px;" value = "<?php echo $User_Address ;?>" >

    </div>

      <br>

    <div class="input-group">

        <label>Province</label>

        <select name="Province" style="font-size:20px;" >

        <option value="">Select...</option>

        <?php

         $provincelist = array('Eastern Cape', 'Free State', 'Gauteng', 'KwaZulu-Natal', 'Limpopo', 'Mpumalanga', 'Northern Cape', 'North West', 'Western Cape' ); 


          foreach ( $provincelist as $provinceitem ) {
           if ( $provinceitem == $User_Province	) {
            echo "<option value='".$provinceitem."' selected>".ucfirst($provinceitem)."</option>";
          } else {
            echo "<option value='".$provinceitem."'>".ucfirst($provinceitem)."</option>";

}
}
?>


       </select>

    </div>

      <br>

    <div class="input-group">

      <label>Enter New Password</label>

        <input type="password" name="password1" style="font-size:20px;">

    </div>

      <br>

    <div class="input-group">

      <label>Re-Enter New Password</label>

        <input type="password" name="password2" style="font-size:20px;">

    </div>

      <br>

    <div class="input-group">

      <button type="submit"  name="reg_user" style="font-size:20px;"><a href="https://localhost/Fetola%20Project/Register/regdone.php">Register</button>

</div>

</form>



<?php }}; ?>



</body>

</html>