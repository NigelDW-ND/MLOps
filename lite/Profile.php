<!DOCTYPE html>
<?

session_start();
$partid = $_SESSION["UserID"];
include('../config/database_conn.php');
    $GETstatSQL = "SELECT * FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid INNER JOIN FetolaDB.support.CompanyDet cd ON t.int_ID_Status = cd.Businessdet_id  WHERE a.int_participant_ID = ".$partid.";";
    $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
    $GETstat = sqlsrv_fetch_array($GETstatQuery, SQLSRV_FETCH_ASSOC);
$DescriptionValue = $GETstat['Description'];
$WelcomeValue = $GETstat['bt_Welcome'];

?>
<html>
<head>
  <title>Welcome to My Profile</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
      <script src="https://kit.fontawesome.com/a012f76b8f.js" crossorigin="anonymous"></script>
      <link href="../../style-css/fetola.lite.css" rel="stylesheet">
      <style type="text/css">
          /* NavBar*/
.headerContainer{
  display: grid;
  /*grid-template-columns: 1fr 2fr;*/
  grid-template-areas:
  'headerlogo navSection';
  background-color: white;
  padding-top: 5px;
    height: 85px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.nav button{
  border: none;
  color: #5e5e5e;
  display: inline-block;
  top:30px;
  font-size: 16px;
  left: -20%;
  padding: 5px 5px 5px 5px;
  outline: none;
  background-color:white;
  
}

input[type="button"]{
  outline: none;
}
.nav-btn-group {
  /*width: 150px;*/
  height: 40px;
  font-size: 15px;
}   
.nav-btn-group-select {
  width: 130px;
  height: 40px;
  font-size: 15px;        
  background: url('../site-images/nav_button_green_spark.png') no-repeat top left;
}       
.nav-btn-group:hover {        
  background: url('../site-images/nav_button_blue_spark.png') no-repeat top left;
}
      </style>
</head>
<body>
<?php include('queryHeader.php'); ?>
<div class="content">
<div class="content_left">
  <div class="content_left_profile">
    <label class="heading_label_blue"><i class='fas fa-user-circle' style='font-size:24px'></i> My Contact Details </label>
    <hr>
      <div id="part-details"><table style="width: 100%; padding: 2px">
      <tr><td>Contact Name</td><td><b><? echo $GETstat['str_participant_Name']; ?></b></td></tr>
      <tr class="tr_underline"><td colspan="2"></td></tr>
      <tr><td>Email Address</td><td><b><? echo $GETstat['str_participant_Email']; ?></b></td></tr>
      <tr><td>Contact Number</td><td id="Bus_edit_contact_number_td">
        <div id="Bus_edit_contact_number_text"><div id="Bus_edit_contact_number_txt_value"><b><? echo $GETstat['str_participant_Contact']; ?></b><i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #007197;" id="Bus_edit_contact_number_icon"></i></div></div>
        <div id="Bus_edit_contact_number_form" style="display: none;"><b><input type="Text"  class="Profile_Textbox" name="Bus_Contact" value="<? echo $GETstat['str_participant_Contact']; ?>" id="Bus_edit_contact_number_form_txtbox"> <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #007197;" id="Bus_edit_contact_number_save"></i></b></div>
      </td></tr>
      </table>       
      </div><br>
    <label class="heading_label_note"><i class='fas fa-exclamation-circle'></i><b> This Information is not Shared with Users.</b></label> 
  </div>
  <br>&nbsp;
  <br>&nbsp;
  <div class="content_left_password">
   
      <label class="heading_label_blue"><i class='fas fa-lock' style='font-size:24px'></i>  Manage Password</label>
      <hr>

            <br><div class="pwcontainer">
              <table style="width: 100%">
                <tr><td>New Password</td><td><input id="myPassword" type="password" class="form-control"></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td>Confirm Password</td><td><input id="myConfirmPassword" type="password" class="form-control"></td></tr>
                <tr><td></td><td></td></tr> 
                <tr><td colspan="2"><div id="errors" class="well">
      </div>
      <input type="button" id="SubmitPWChange" value="Save" name="Update" style="visibility: hidden;" class="btn"></td></tr>
                <tr><td></td><td></td></tr>
               
              </table>
      
      
      </div>
      <script type="text/javascript" src="../js-script/jquery.password-validation.js"></script>
      <script>
        $(document).ready(function() {
          $("#myPassword").passwordValidation({"confirmField": "#myConfirmPassword"}, function(element, valid, match, failedCases) {

              $("#errors").html("<div>" + failedCases.join("<br>") + "</div>");
            
               if(valid) $(element).css("border","2px solid #799900");
               if(!valid) $(element).css("border","2px solid #007197");
               if(valid && match) $("#myConfirmPassword").css("border","2px solid #799900");
               if(valid && match) $("#SubmitPWChange").css("visibility","visible");
               if(!valid || !match) $("#myConfirmPassword").css("border","2px solid #007197");
          });
        });
      </script>





</div>
  <br>&nbsp;
  <br>&nbsp;
  <div class="content_help_password">
   
      <label class="heading_label_blue"><i class="fas fa-question-circle" style='font-size:24px'></i> Application Notes</label>
      <hr>
      <i class="fas fa-edit" tip="Edit" style="color: #007197; font-size:20px;" id="Bus_edit_contact_number_icon"></i>Click to make field available.<br>
      <i class="fas fa-save" tip="Save" style="color: #007197; font-size:20px;" id="Bus_edit_contact_number_save"></i> Click to Save changes.<br><br>
      Please click on the My Queries tab to log a new support request. <br>


</div>  <br>&nbsp;
  <br>&nbsp;  <br>&nbsp;
  </div>
<div class="content_spacer">
</div>
<div class="content_right">
  <div class="content_right_aboutme">
    <label class="heading_label_green"><i class='fas fa-user-circle' style='font-size:24px'></i> About My Business</label>
      <hr>
      <div class="content_right_img_upload">


        <img src="../../site-images/profiles/business/<? echo $GETstat['str_participant_image']; ?>" width="140" height="140" id="myProfileimg" style="border-radius: 10px;"><br><br>
                  <div id="FileUpload">
            <label class="btn_view"> Select a Image

            <input type="file"  size="60"  name="fileToUpload" id="fileToUpload">
            </label> <p id="upload_message"></p>
          </div>
            <button type='submit' id='upload_file' value='$qid' name='submit-file' class="btn_view" style="display:none;">Upload</button>
             
            <br><label class="heading_label_note"><i class='fas fa-exclamation-circle'></i><b> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</b></label>
      </div>
      <div class="content_right_desc_update">
        <div id="business-details"><table style="width: 100%; padding: 2px">

      <tr><td>Business Name</td><td><b><? echo $GETstat['Bus_Name']; ?></b></td></tr>
      <tr class="tr_underline"><td colspan="2"></td></tr>
       <tr>
    <td>Co. Registration Number</td>
    <td id="Bus_edit_co_registration_number_td">
      <div id="Bus_edit_co_registration_number_text">
        <div id="Bus_edit_co_registration_number_txt_value">
          <b><? echo $GETstat['CoRegistration']; ?></b>
          <i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_co_registration_number_icon"></i>
        </div>
      </div>
      <div id="Bus_edit_co_registration_number_form" style="display: none;">
        <b><input type="Text"  class="Profile_Textbox" name="Bus_co_registration" value="<? echo $GETstat['CoRegistration']; ?>" id="Bus_edit_co_registration_number_form_txtbox">
        <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_co_registration_number_save"></i></b>
      </div>
    </td>
    </tr>
       <tr>
        <td>Sector</td>
        <td id="Bus_edit_business_sector_td">
        <div id="Bus_edit_business_sector_text">
          <div id="Bus_edit_business_sector_txt_value">
            <b><? echo $GETstat['Sector']; ?></b>
          <i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_business_sector_icon"></i></div>
        </div>
        <div id="Bus_edit_business_sector_form" style="display: none;">
          <b>
            <select id="Bus_edit_business_sector_form_sel" class="Profile_Selector">
                <option<? If($GETstat['Sector'] == 'Agriculture and environment '){ echo " selected";} ?>>Agriculture and environment </option>
                <option<? If($GETstat['Sector'] == 'Creative Including arts, crafts and design'){ echo " selected";} ?>>Creative Including arts, crafts and design</option>
                <option<? If($GETstat['Sector'] == 'Education & training '){ echo " selected";} ?>>Education & training </option>
                <option<? If($GETstat['Sector'] == 'Energy and Electrical power including renewables'){ echo " selected";} ?>>Energy and Electrical power including renewables</option>
                <option<? If($GETstat['Sector'] == 'Engineering, Construction & architecture '){ echo " selected";} ?>>Engineering, Construction & architecture </option>
                <option<? If($GETstat['Sector'] == 'Entertainment, Music, Film & Video gaming'){ echo " selected";} ?>>Entertainment, Music, Film & Video gaming</option>
                <option<? If($GETstat['Sector'] == 'Financial services and Insurance '){ echo " selected";} ?>>Financial services and Insurance </option>
                <option<? If($GETstat['Sector'] == 'Food & agro-processing'){ echo " selected";} ?>>Food & agro-processing</option>
                <option<? If($GETstat['Sector'] == 'Health care industry including Pharmaceutical '){ echo " selected";} ?>>Health care industry including Pharmaceutical </option>
                <option<? If($GETstat['Sector'] == 'Hospitality, Tourism, restaurant and conferencing'){ echo " selected";} ?>>Hospitality, Tourism, restaurant and conferencing</option>
                <option<? If($GETstat['Sector'] == 'IT and Software including Robotics and AI '){ echo " selected";} ?>>IT and Software including Robotics and AI </option>
                <option<? If($GETstat['Sector'] == 'Manufacturing inc Automotive, chemical, textiles'){ echo " selected";} ?>>Manufacturing inc Automotive, chemical, textiles</option>
                <option<? If($GETstat['Sector'] == 'Media, Social media, Broadcasting & Publishing'){ echo " selected";} ?>>Media, Social media, Broadcasting & Publishing</option>
                <option<? If($GETstat['Sector'] == 'Mining, Petroleum and related '){ echo " selected";} ?>>Mining, Petroleum and related </option>
                <option<? If($GETstat['Sector'] == 'Property & Real estate '){ echo " selected";} ?>>Property & Real estate </option>
                <option<? If($GETstat['Sector'] == 'Public service and Government'){ echo " selected";} ?>>Public service and Government</option>
                <option<? If($GETstat['Sector'] == 'Retail & wholesale including online & e- commerce'){ echo " selected";} ?>>Retail & wholesale including online & e- commerce</option>
                <option<? If($GETstat['Sector'] == 'Service industries (Other) - inc Business services & consulting'){ echo " selected";} ?>>Service industries (Other) - inc Business services & consulting</option>
                <option<? If($GETstat['Sector'] == 'Social enterprise and Non profit'){ echo " selected";} ?>>Social enterprise and Non profit</option>
                <option<? If($GETstat['Sector'] == 'Sports & recreation '){ echo " selected";} ?>>Sports & recreation </option>
                <option<? If($GETstat['Sector'] == 'Telecommunications '){ echo " selected";} ?>>Telecommunications </option>
                <option<? If($GETstat['Sector'] == 'Transport and logistics '){ echo " selected";} ?>>Transport and logistics </option>
                <option<? If($GETstat['Sector'] == 'Water, waste, recycling & sanitation '){ echo " selected";} ?>>Water, waste, recycling & sanitation </option>
                <option<? If($GETstat['Sector'] == 'Other'){ echo " selected";} ?>>Other</option>
            </select>
            <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_business_sector_save"></i>
          </b>
        </div>
        </td>
      </tr>
       <tr>
        <td>Province</td>
        <td id="Bus_edit_sa_prov_td">
        <div id="Bus_edit_sa_prov_text">
          <div id="Bus_edit_sa_prov_txt_value">
            <b><? echo $GETstat['Prov']; ?></b>
          <i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_sa_prov_icon"></i></div>
        </div>
        <div id="Bus_edit_sa_prov_form" style="display: none;">
          <b>
            <select id="Bus_edit_sa_prov_form_sel" class="Profile_Selector">
              <option<? If($GETstat['Prov'] == 'Eastern Cape'){ echo " selected";} ?>>Eastern Cape</option>
              <option<? If($GETstat['Prov'] == 'Free State'){ echo " selected";} ?>>Free State</option>
              <option<? If($GETstat['Prov'] == 'Gauteng'){ echo " selected";} ?>>Gauteng</option>
              <option<? If($GETstat['Prov'] == 'KwaZulu-Natal'){ echo " selected";} ?>>KwaZulu-Natal</option>
              <option<? If($GETstat['Prov'] == 'Limpopo'){ echo " selected";} ?>>Limpopo</option>
              <option<? If($GETstat['Prov'] == 'Mpumalanga'){ echo " selected";} ?>>Mpumalanga</option>
              <option<? If($GETstat['Prov'] == 'Northern Cape'){ echo " selected";} ?>>Northern Cape</option>
              <option<? If($GETstat['Prov'] == 'North West'){ echo " selected";} ?>>North West</option>
              <option<? If($GETstat['Prov'] == 'Western Cape'){ echo " selected";} ?>>Western Cape</option>
            </select>
            <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_sa_prov_save"></i>
          </b>
        </div>
        </td>
      </tr>
      <tr class="tr_underline"><td colspan="2"></td></tr>
      <tr>
        <td>My business exists for...</td>
        <td id="Bus_edit_business_exists_td">
        <div id="Bus_edit_business_exists_text">
          <div id="Bus_edit_business_exists_txt_value">
            <b><? echo $GETstat['Business_Age']; ?></b>
          <i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_business_exists_icon"></i></div>
        </div>
        <div id="Bus_edit_business_exists_form" style="display: none;">
          <b>
            <select id="Bus_edit_business_exists_form_sel" class="Profile_Selector">
        <option<? If($GETstat['Business_Age'] == 'less than 6 months'){ echo " selected";} ?>>less than 6 months</option>
        <option<? If($GETstat['Business_Age'] == 'between 6 months and 1 year'){ echo " selected";} ?>>between 6 months and 1 year</option>
        <option<? If($GETstat['Business_Age'] == 'between 1 and 2 years'){ echo " selected";} ?>>between 1 and 2 years</option>
        <option<? If($GETstat['Business_Age'] == 'between 2 and 3 years'){ echo " selected";} ?>>between 2 and 3 years</option>
        <option<? If($GETstat['Business_Age'] == 'between 3 and 5 years'){ echo " selected";} ?>>between 3 and 5 years</option>
        <option<? If($GETstat['Business_Age'] == 'more than 5 years'){ echo " selected";} ?>>more than 5 years</option>
            </select>
            <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_business_exists_save"></i>
          </b>
        </div>
        </td>
      </tr>
      
      <tr>
        <td>No. of employees</td>
        <td id="Bus_edit_employee_count_td">
        <div id="Bus_edit_employee_count_text">
          <div id="Bus_edit_employee_count_txt_value">
            <b><? echo $GETstat['Employee_Count']; ?></b>
          <i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_employee_count_icon"></i></div>
        </div>
        <div id="Bus_edit_employee_count_form" style="display: none;">
          <b>
            <select id="Bus_edit_employee_count_form_sel" class="Profile_Selector">
        <option<? If($GETstat['Employee_Count'] == '1-10'){ echo " selected";} ?>>1-10</option>
        <option<? If($GETstat['Employee_Count'] == '11-50'){ echo " selected";} ?>>11-50</option>
        <option<? If($GETstat['Employee_Count'] == '51-100'){ echo " selected";} ?>>51-100</option>
        <option<? If($GETstat['Employee_Count'] == '101-300'){ echo " selected";} ?>>101-300</option>
        <option<? If($GETstat['Employee_Count'] == '301-500'){ echo " selected";} ?>>301-500</option>
            </select>
            <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_employee_count_save"></i>
          </b>
        </div>
        </td>
      </tr>
      
      <tr class="tr_underline"><td colspan="2"></td></tr>   
      <tr>
        <td>BEE Score</td>
        <td id="Bus_edit_bee_score_td">
        <div id="Bus_edit_bee_score_text">
          <div id="Bus_edit_bee_score_txt_value">
            <b><? echo $GETstat['BEE_Score']; ?></b>
          <i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_bee_score_icon"></i></div>
        </div>
        <div id="Bus_edit_bee_score_form" style="display: none;">
          <b>
            <select id="Bus_edit_bee_score_form_sel" class="Profile_Selector">
        <option<? If($GETstat['BEE_Score'] == 'Less than 51%'){ echo " selected";} ?>>Less than 51%</option>
        <option<? If($GETstat['BEE_Score'] == 'More than 51%'){ echo " selected";} ?>>More than 51%</option>
            </select>
            <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_bee_score_save"></i>
          </b>
        </div>
        </td>
      </tr>
      <tr>
        <td>Annual Revenue</td>
        <td id="Bus_edit_annual_revenue_td">
        <div id="Bus_edit_annual_revenue_text">
          <div id="Bus_edit_annual_revenue_txt_value">
            <b>R <? echo $GETstat['Annual_Revenue']; ?></b>
          <i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_annual_revenue_icon"></i></div>
        </div>
        <div id="Bus_edit_annual_revenue_form" style="display: none;">
          <b>R 
            <select id="Bus_edit_annual_revenue_form_sel" class="Profile_Selector">
        <option<? If($GETstat['Annual_Revenue'] == '0 - 335 000'){ echo " selected";} ?>>0 - 335 000</option>
        <option<? If($GETstat['Annual_Revenue'] == '335 001 - 500 000'){ echo " selected";} ?>>335 001 - 500 000</option>
        <option<? If($GETstat['Annual_Revenue'] == '500 001 - 750 000'){ echo " selected";} ?>>500 001 - 750 000</option>
        <option<? If($GETstat['Annual_Revenue'] == '750 001 - 1 000 000'){ echo " selected";} ?>>750 001 - 1 000 000</option>
        <option<? If($GETstat['Annual_Revenue'] == '1 000 000 - 5 000 000'){ echo " selected";} ?>>1 000 000 - 5 000 000</option>
        <option<? If($GETstat['Annual_Revenue'] == '5 000 000 - 10 000 000'){ echo " selected";} ?>>5 000 000 - 10 000 000</option>
        <option<? If($GETstat['Annual_Revenue'] == '10 000 000 - 20 000 000'){ echo " selected";} ?>>10 000 000 - 20 000 000</option>
        <option<? If($GETstat['Annual_Revenue'] == '20 000 000 - 60 000 000'){ echo " selected";} ?>>20 000 000 - 60 000 000</option>
        <option<? If($GETstat['Annual_Revenue'] == 'Above 60 000 000'){ echo " selected";} ?>>Above 60 000 000</option>
            </select>
            <i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;color: #799900;" id="Bus_edit_annual_revenue_save"></i>
          </b>
        </div>
        </td>
      </tr>
      <tr class="tr_underline"><td colspan="2"></td></tr>   
      <tr>
        <td td colspan="2" id="Bus_edit_description_input_td">
      <div id="Bus_edit_description_input_text">
        <div id="Bus_edit_description_input_txt_value">
          More about my Business: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<i class="fas fa-edit" tip="Edit" style="cursor: pointer;color: #799900;" id="Bus_edit_description_input_icon"></i><br>
          <pre style="font-family: sans-serif, Arial, Helvetica; font-size: 14px;"><b><? echo $GETstat['Description']; ?></b></pre>
          
        </div>
      </div>
      <div id="Bus_edit_description_input_form" style="display: none;">
        More about my Business: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-save" tip="Save" style="cursor: pointer;color: #799900;" id="Bus_edit_description_input_save"></i><br>
        <textarea name="Bus_Description" id="Bus_edit_description_input_form_txtbox" class="Profile_Desc_txta"><? echo $GETstat['Description']; ?></textarea>
        <div id="charNum" class="heading_label_note"></div>
      </div>
    </td></tr>

      </table></div>
        </div>

<div id="snackbar">Some text some message..</div>

<button id="modal-launcher" style="display: none;"></button>

<div id="modal-background">
</div>
<div id="modal-content">
  <img src="../site-images/fnb_logos.png" style="width:400px;height:90px;" alt="fetola"><hr>
 
  <h2>Welcome to Mentor Hotline!</h2>
  <div class="welcome_text">This is your space to reach out and get the support you need. Log a query and a mentor will respond shortly!</div><br><br>
    <button id="modal-close" class="btn" >Continue</button><br>
    <input type="checkbox" name="killmodal" id="killmodal"><b style="font-size: 9px;font-weight:">Don't display this message again.</b>
</div>
<script>

function mySnackbar() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 4000);
  setTimeout(function(){ location.reload(); }, 1000);
}

</script>



  </div>  
</div>
</div>
<?php include('queryFooter.php'); ?>



<script>
      $(document).ready(function(){
        var partid = <? echo $partid; ?>;
       

    $('#Bus_edit_description_input_form_txtbox').keyup(function(){
       var wordCount = $(this).val().split(/[\s\.\?]+/).length;
       var wordsleft = 150 - wordCount
       if(wordsleft < 1){
        $('#Bus_edit_description_input_form_txtbox').attr('disabled','disabled');
        $('#charNum').html('<i class="fas fa-exclamation-circle"></i>You have reached the word limit of this field.');
       }else{
        $('#charNum').html('<i class="fas fa-exclamation-circle"></i>You have ' + wordsleft + ' remaining.');
       }   
    });

        $('#Bus_edit_description_input_icon').on( "click", function(){
        $('#Bus_edit_description_input_text').hide();
        $('#Bus_edit_description_input_form').show();
      });
      $('#Bus_edit_description_input_save').on( "click", function(){
        $.ajax({                                      
          url: 'Business_Functions.php',              
          type: "post",          
          data: {'func':'Update_Business_Description','UserID':partid, 'Description':$('#Bus_edit_description_input_form_txtbox').val()},
          dataType: 'html',                
        cache: false,
        success: function(data){
            $('#Bus_edit_description_input_text').show();
            $('#Bus_edit_description_input_form').hide();
            $('#Bus_edit_description_input_txt_value').html("<b>"+$('#Bus_edit_description_input_form_txtbox').val()+"</b>");        
            $('#snackbar').text("Updated Description.");
            mySnackbar();
            }
          });
        });


      $('#Bus_edit_contact_number_icon').on( "click", function(){
        $('#Bus_edit_contact_number_text').hide();
        $('#Bus_edit_contact_number_form').show();
      });
      $('#Bus_edit_contact_number_save').on( "click", function(){
        $.ajax({                                      
          url: 'Business_Functions.php',              
          type: "post",          
          data: {'func':'Update_Business_Contact_Number','UserID':partid, 'ContactNum':$('#Bus_edit_contact_number_form_txtbox').val()},
          dataType: 'html',                
        cache: false,
        success: function(data){
            $('#Bus_edit_contact_number_text').show();
            $('#Bus_edit_contact_number_form').hide();
            $('#Bus_edit_contact_number_txt_value').html("<b>"+$('#Bus_edit_contact_number_form_txtbox').val()+"</b>");        
            $('#snackbar').text("Updated Contact Number. To :"+$('#Bus_edit_contact_number_form_txtbox').val()+".");
            mySnackbar();
            }
          });
        });
      $('#Bus_edit_annual_revenue_icon').on( "click", function(){
            $('#Bus_edit_annual_revenue_text').hide();
            $('#Bus_edit_annual_revenue_form').show();
          });
          $('#Bus_edit_annual_revenue_save').on( "click", function(){
               $.ajax({                                      
              url: 'Business_Functions.php',              
              type: "post",          
              data: {'func':'Update_Annual_Revenue','UserID':partid, 'Annual_Revenue':$('#Bus_edit_annual_revenue_form_sel').val()},
              dataType: 'html',                
            cache: false,
            success: function(data){
                $('#Bus_edit_annual_revenue_text').show();
                $('#Bus_edit_annual_revenue_form').hide();
                $('#Bus_edit_annual_revenue_txt_value').html("<b>"+$('#Bus_edit_annual_revenue_form_sel').val()+"</b>");        
                $('#snackbar').text("Updated Annual Revenue. To :"+$('#Bus_edit_annual_revenue_form_sel').val()+".");
                mySnackbar();
                }
              });
          });



      $('#Bus_edit_business_exists_icon').on( "click", function(){
            $('#Bus_edit_business_exists_text').hide();
            $('#Bus_edit_business_exists_form').show();
          });
          $('#Bus_edit_business_exists_save').on( "click", function(){
               $.ajax({                                      
              url: 'Business_Functions.php',              
              type: "post",          
              data: {'func':'Update_Business_Age','UserID':partid, 'Business_Age':$('#Bus_edit_business_exists_form_sel').val()},
              dataType: 'html',                
            cache: false,
            success: function(data){
                $('#Bus_edit_business_exists_text').show();
                $('#Bus_edit_business_exists_form').hide();
                $('#Bus_edit_business_exists_txt_value').html("<b>"+$('#Bus_edit_business_exists_form_sel').val()+"</b>");        
                $('#snackbar').text("Updated Business Age. To :"+$('#Bus_edit_business_exists_form_sel').val()+".");
                mySnackbar();
                }
              });
          });
           $('#Bus_edit_employee_count_icon').on( "click", function(){
            $('#Bus_edit_employee_count_text').hide();
            $('#Bus_edit_employee_count_form').show();
          });
          $('#Bus_edit_employee_count_save').on( "click", function(){
               $.ajax({                                      
              url: 'Business_Functions.php',              
              type: "post",          
              data: {'func':'Update_Employee_Count','UserID':partid, 'Employee_Count':$('#Bus_edit_employee_count_form_sel').val()},
              dataType: 'html',                
            cache: false,
            success: function(data){
                $('#Bus_edit_employee_count_text').show();
                $('#Bus_edit_employee_count_form').hide();
                $('#Bus_edit_employee_count_txt_value').html("<b>"+$('#Bus_edit_employee_count_form_sel').val()+"</b>");        
                $('#snackbar').text("Updated Employee Count. To :"+$('#Bus_edit_employee_count_form_sel').val()+".");
                mySnackbar();
                }
              });
          });



      $('#Bus_edit_bee_score_icon').on( "click", function(){
            $('#Bus_edit_bee_score_text').hide();
            $('#Bus_edit_bee_score_form').show();
          });
          $('#Bus_edit_bee_score_save').on( "click", function(){
               $.ajax({                                      
              url: 'Business_Functions.php',              
              type: "post",          
              data: {'func':'Update_BEE_Score','UserID':partid, 'BEE_Score':$('#Bus_edit_bee_score_form_sel').val()},
              dataType: 'html',                
            cache: false,
            success: function(data){
                $('#Bus_edit_bee_score_text').show();
                $('#Bus_edit_bee_score_form').hide();
                $('#Bus_edit_bee_score_txt_value').html("<b>"+$('#Bus_edit_bee_score_form_sel').val()+"</b>");        
                $('#snackbar').text("Updated BEE Score. To :"+$('#Bus_edit_bee_score_form_sel').val()+".");
                mySnackbar();
                }
              });
          });
            $('#Bus_edit_business_sector_icon').on( "click", function(){
            $('#Bus_edit_business_sector_text').hide();
            $('#Bus_edit_business_sector_form').show();
          });
          $('#Bus_edit_business_sector_save').on( "click", function(){
               $.ajax({                                      
              url: 'Business_Functions.php',              
              type: "post",          
              data: {'func':'Update_Business_Sector','UserID':partid, 'BusinessSector':$('#Bus_edit_business_sector_form_sel').val()},
              dataType: 'html',                
            cache: false,
            success: function(data){
                $('#Bus_edit_business_sector_text').show();
                $('#Bus_edit_business_sector_form').hide();
                $('#Bus_edit_business_sector_txt_value').html("<b>"+$('#Bus_edit_business_sector_form_sel').val()+"</b>");        
                $('#snackbar').text("Updated Business Sector. To :"+$('#Bus_edit_business_sector_form_sel').val()+".");
                mySnackbar();
                }
              });
          });
          $('#Bus_edit_sa_prov_icon').on( "click", function(){
            $('#Bus_edit_sa_prov_text').hide();
            $('#Bus_edit_sa_prov_form').show();
          });
          $('#Bus_edit_sa_prov_save').on( "click", function(){
               $.ajax({                                      
              url: 'Business_Functions.php',              
              type: "post",          
              data: {'func':'Update_SA_Province','UserID':partid, 'ProvinceSel':$('#Bus_edit_sa_prov_form_sel').val()},
              dataType: 'html',                
            cache: false,
            success: function(data){
                $('#Bus_edit_sa_prov_text').show();
                $('#Bus_edit_sa_prov_form').hide();
                $('#Bus_edit_sa_prov_txt_value').html("<b>"+$('#Bus_edit_sa_prov_form_sel').val()+"</b>");        
                $('#snackbar').text("Updated Province. To :"+$('#Bus_edit_sa_prov_form_sel').val()+".");
                mySnackbar();
                }
              });
          });
        $('#Bus_edit_co_registration_number_icon').on( "click", function(){
        $('#Bus_edit_co_registration_number_text').hide();
        $('#Bus_edit_co_registration_number_form').show();
      });
      $('#Bus_edit_co_registration_number_save').on( "click", function(){
        $.ajax({                                      
          url: 'Business_Functions.php',              
          type: "post",          
          data: {'func':'Update_Business_Registration_Number','UserID':partid, 'Registration_Number':$('#Bus_edit_co_registration_number_form_txtbox').val()},
          dataType: 'html',                
        cache: false,
        success: function(data){
            $('#Bus_edit_co_registration_number_text').show();
            $('#Bus_edit_co_registration_number_form').hide();
            $('#Bus_edit_co_registration_number_txt_value').html("<b>"+$('#Bus_edit_co_registration_number_form_txtbox').val()+"</b>");        
            $('#snackbar').text("Updated Registration Number. To :"+$('#Bus_edit_co_registration_number_form_txtbox').val()+".");
            mySnackbar();
            }
          });
        });




      });



    $(document).ready(function (){
      var partid = <? echo $partid; ?>;

        $("#killmodal").change(function() {
            if(this.checked) {
               $.ajax({                                      
                    url: 'Business_Functions.php',              
                    type: "post",          
                    data: {'func':'Kill_Welcome','UserID':partid},
                    dataType: 'html',                
                  cache: false,
                  success: function(data){
                  $('#snackbar').text(data);
                  mySnackbar();
                  }
                 });
            }
        });
        <?
            if($WelcomeValue == 'yes'){
            echo '$("#modal-content, #modal-background").toggleClass("active");';
          }
        ?>

      
        $(function(){
            $("#modal-launcher, #modal-background, #modal-close").click(function() {
                $("#modal-content, #modal-background").toggleClass("active");
            });
        });

      $('#SubmitPWChange').click(function(){
        $.ajax({                                      
          url: 'Business_Functions.php',              
          type: "post",          
          data: {'func':'Update_Password','UserID':partid, 'Password':$("#myConfirmPassword").val()},
          dataType: 'html',                
        cache: false,
        success: function(data){
          $('#snackbar').text(data);
          mySnackbar();
        }
          });
      });


      $('#query_input').keyup(function(){
       var wordCount = $(this).val().split(/[\s\.\?]+/).length;
       var wordsleft = 150 - wordCount
       if(wordsleft < 1){
        $('#query_input').attr('disabled','disabled');
        $('#charNum').text('You have reached the word limit of this field.');
       }else{
        $('#charNum').text('You have ' + wordsleft + ' remaining.');
       }   
    });
        $('#fileToUpload').on('change', function() {
      var filenm = $("#fileToUpload").val().replace(/C:\\fakepath\\/i, '');
      $('#upload_message').text(filenm);
      $('#upload_file').css('display', 'initial');
    });
        $('#upload_file').on('click', function() {
          var file_data = $('#fileToUpload').prop('files')[0];   
          var form_data = new FormData();
          var uid = partid;
          form_data.append('func', 'image_file2'); 
          form_data.append('UserID', partid);                  
          form_data.append('photo', file_data);
          $.ajax({
          type: 'POST',
            url: 'Business_Functions.php', 
                contentType: false,
                processData: false,
                data: form_data,
                success:function(response) {
                  
                    $('#snackbar').text(response);
                    mySnackbar();
                    $('#upload_message').val();
                    $('#upload_file').css('display', 'none');

                    setTimeout(function(){
                    $.ajax({                                      
                    url: 'Business_Functions.php',              
                    type: "post",          
                    data: {'func':'Get_profileimage','Part_ID':partid},
                    dataType: 'html',                
                  cache: false,
                  success: function(data){
                    $('#myProfileimg').attr('src',data);
            
                  }
              });},1000);         
            }
         }); 


    });
});     



</script>
</body>
</html>