<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('../config/database_conn.php');
$serv_name = $_SERVER['SERVER_NAME']; 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome To Fetola</title>
<link href="../style-css/Styles_Register.css" rel="stylesheet"> 
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> 
</head>	
<body>
<div class="content">
          <img src="../site-images/fnb_logos.png" style="width:440px;height:85px;display: block; margin-left: auto; margin-right: auto; width: 50%;" alt="fetola">
    <hr>
    <div id="heading" style=" position: relative; align:center;">
<?php
 $email = $_SESSION["email"] ;


$email1 = $email;
$params = array();

echo "<br />";
$sel_querya = "select count(*) as count from participant.admin where str_participant_Email = '".$email1."'";
echo "<br />";

$resulta = sqlsrv_query($objCon,$sel_querya);



$row1 = sqlsrv_fetch_array($resulta,SQLSRV_FETCH_ASSOC);



if ( !isset($row1['count']) ){
	exit();
}


if ( $row1['count'] == 0 ) {
	echo "You are not registered in the database, Please contact FNB to be registered";
} else {


	$result4a = "SELECT a.str_participant_Name as [FirstName], a.str_participant_Contact as [Contact], TP.Bus_Name as [Bus_Name], TP.Title as [Title], TP.Gender as [Gender], TP.Address as [Address], TP.Prov as [Province], CD.Bee_score as [Bee_score], CD.Annual_Revenue as [Annual_Revenue], CD.Business_Age as [Business_Age], CD.Employee_Count as [Employee_Count], CD.Industry as [Industry], CD.CoRegistration as [Coregistration]  FROM participant.admin a
	inner join import.TP_Status_Info TP on a.id_participant_GUID = TP.Business_GUID
	inner join support.CompanyDet CD on TP.int_ID_Status = CD.Businessdet_ID
	WHERE a.str_participant_Email = '".$email1."'";

	$query5 = sqlsrv_query($objCon,$result4a);
	$row5 = sqlsrv_fetch_array($query5,SQLSRV_FETCH_ASSOC);

if ( empty($row5) ){

  echo "There is no data available: Please contact support.";

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
         <h2>Welcome!</h2>
     <p class="welcome_text">
      You are one step away, please complete the registration form below.
     </p>
      </div>
<div class="form-content"><form method="post" action="regdone.php">
  <table><tr><td>
      
        <label>Title </label></td><td>
        <select id="Title" name="Title" class = "pass_reset" type="text" >  
        <option value="">Select...</option>
        <?php

        $Titlelist = array( 'Mr', 'Mrs', 'Ms', 'Prof' );
         
        foreach ( $Titlelist as $Titleitem) {
          if ( $Titleitem == $User_Title ) {
            echo "<option value='".$Titleitem."' selected>",$Titleitem."</option>";
           } else  {
             echo "<option value='".$Titleitem."'>".$Titleitem."</option>";
           }
          }
        ?>
        </select>


        </td></tr><tr><td>
        <label>Firstname</label>
        </td><td>

      <input type="text" name="Firstname" value = "<?php echo $User_FirstName;?>" >

        </td></tr><tr><td>
      
     <label>Gender</label>
      </td><td>
       <select name="Gender">
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
    </td></tr><tr><td>
        <label>Business Name </label>
        </td><td>
          <label><?php echo $User_Bus_Name; ?></label>
        </td></tr><tr><td>
            <label>In which industry is your business?</label>
        </td><td>
          <select name="Industry" class = "pass_reset" >

        <option value="">Select...</option>
        
        <?php
        $sqlSector = "SELECT SectorsDescription[Sector] FROM FetolaDB.support.Sectors;";
        $qurySector = sqlsrv_query($objCon, $sqlSector);
        while($sectoritem = sqlsrv_fetch_array($qurySector)){
            if ( $sectoritem['Sector'] == $User_Industry ) {
              echo "<option value='".$sectoritem['Sector']."' selected>".$sectoritem['Sector']."</option>";
            } else {
              echo "<option value='".$sectoritem['Sector']."'>".$sectoritem['Sector']."</option>";
            }
        }
				?>
			</select>
    </td></tr><tr><td>
        <label>Company Registration Number</label>
        </td><td>
          <input type="text" name="CompanyRegistrationNumber" value = "<?php echo $User_Coregistration;?>" >
    </td></tr><tr><td>
        <label>How long has your company been in business for?</label>
      </td><td>
       <select name="Companyage">

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
    </td></tr><tr><td>
        <label>How many people are employed at your company?</label>
      </td><td>
       <select name="Headcount" value = "<?Php echo '<option value="'. $Empcount  .'">' . $Empcount .'</option>'?>">

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
    </td></tr><tr><td>
        <label>What was the annual revenue for your company last year?</label>
      </td><td>
       <select name="Annualrev" value = "<?Php echo '<option value="'. $Annrev  .'">' . $Annrev .'</option>'?>">

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
    </td></tr><tr><td>
        <label>What is your BEE Score?</label>
      </td><td>
       <select name="Beescore" value = "<?Php echo '<option value="'. $Beescore  .'">' . $Beescore .'</option>'?>">

        <option value="">Select...</option>

        <?php

          $beescorelist = array('Less than 51%','More than 51%' ); 


           foreach ( $beescorelist as $beescoreitem ) {
            if ( $beescoreitem== $User_Bee_score	) {
             echo "<option value='".$beescoreitem."' selected>".ucfirst($beescoreitem)."</option>";
          } else {
             echo "<option value='".$beescoreitem."'>".ucfirst($beescoreitem)."</option>";

}
}
?>
       </select>
    </td></tr><tr><td>
        <label>Email </label>
      </td><td>
       <label><?php echo $email1 ;?></label>
    </td></tr><tr><td>
        <label>Contact Number</label>
      </td><td>
       <input type="text" name="contactnumber" value = "<?php echo $User_Contact ;?>" >
    </td></tr><tr><td>
        <label>Address</label>
      </td><td>
       <input type="text" name="Address" value = "<?php echo $User_Address ;?>" >
    </td></tr><tr><td>
        <label>Province</label>
      </td><td>
       <select name="Province">

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
    </td></tr><tr><td>
        <label>Enter New Password</label>
      </td><td>
       <input type="password" name="password1" id="myPassword">
    </td></tr><tr><td>
        <label>Re-Enter New Password</label>
      </td><td>
       <input type="password" name="password2" id="myConfirmPassword">
    </td></tr><tr><td></td><td>

       <div id="errors" class="well"></div>

    </td></tr><tr><td colspan="2">
        <input type="hidden" name="submit" value="true">

      <button type="submit" id="SubmitPWChange" name="reg_user">Register</button>
</td></tr></table>
</div>

</form>
      <script type="text/javascript" src="../js-script/jquery.password-validation.js"></script>
      <script>
        $(document).ready(function() {
          $("#myPassword").passwordValidation({"confirmField": "#myConfirmPassword"}, function(element, valid, match, failedCases) {
              $("#errors").html("<div>" + failedCases.join("<br>") + "</div>");
               if(valid) $(element).css("border","2px solid #799900");
               if(!valid) $(element).css("border","2px solid #007197");
               if(valid && match) $("#myConfirmPassword").css("border","2px solid #799900");
               if(!valid || !match) $("#myConfirmPassword").css("border","2px solid #007197");
          });
        });
      </script>


<?php }}; ?>
</body>

</html>