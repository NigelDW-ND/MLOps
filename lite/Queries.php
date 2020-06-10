<!DOCTYPE html>
<?
session_start();
$partid = $_SESSION["UserID"];
include('../config/database_conn.php');



$strSQL = "SELECT * FROM support.Categories";          
?>
<html>
<head>
  <title>Welcome to Queries</title>
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
    <label class="heading_label_blue"><i class="fas fa-plus-square" style='font-size:24px'></i> New Query</label>
    <hr><br>

      <b>I require help with:</b><br><br>
      <select name="CatID" id="CatagorySel" class="CatagorySelector">
      <?
      $objQuery = sqlsrv_query($objCon, $strSQL);
      if( $objQuery === false) {
        die( print_r( sqlsrv_errors(), true) );
      }     
      while( $row = sqlsrv_fetch_array( $objQuery, SQLSRV_FETCH_ASSOC) ) {
        echo "<option value='".$row['CategoryID']."'>".$row['CategoryDescription']."</option>";
      }
      ?>
      </select><br><br><br>
          
      <b>Subject of my request.</b><br><br>
      <input class="SubjectText" id="SubjectText" type="text" name="Subject" placeholder="In no more than 40 characters." maxlength="40">
      <div id="SubjNum" class="heading_label_note"></div><br><br>
      <b>Details of my request.</b><br><br>
      <textarea id="query_input_text" name="Comment" rows="5"  placeholder="In no more than 150 words." class="Query_Details"></textarea>

        <div id="charNum" class="heading_label_note"></div>
      <br><br>

    <button id="SubmitQuery" class="btn_submit_query">Submit</button>
      
 
  </div>
  <br>&nbsp;
  <br>&nbsp;
  </div>
<div class="content_spacer">
</div>
<div class="content_right">
  <div class="content_right_aboutme">
    <label class="heading_label_green"><i class="fas fa-list" style='font-size:24px'></i> My Queries</label>
      <hr>
    

<form method="POST" action="query.php"> 
      <table class="Table-Content-Section" cellpadding="5" style="width:100%">
        <tbody>
        <tr style="background: #007197; color: white; text-align: center;">
          <th style="background: #007197; color: white; text-align: center;font-size: 13px;">Mentor</th>
          <th style="background: #007197; color: white; text-align: center;font-size: 13px;">Subject</th>
          <th style="background: #007197; color: white; text-align: center;font-size: 13px;">Category</th>
          <th style="background: #007197; color: white; text-align: center;font-size: 13px;">Status</th>
          <th style="background: #007197; color: white; text-align: center;font-size: 13px;">Date</th>
          <th style="background: #007197; color: white; text-align: center;font-size: 13px;">Action</th>
        </tr>
          <?
      $QustrSQL = "SELECT QueryID, Subject, Mentor, Category, Status, CONVERT(VARCHAR(10),DateCreated)[DateCreated], SortOd FROM support.vw_support_list WHERE myID = $partid ORDER BY SortOd ASC, DateCreated DESC;";
      $QuobjQuery = sqlsrv_query($objCon, $QustrSQL);
      if( $QuobjQuery === false) {
        die( print_r( sqlsrv_errors(), true) );
      }
      while( $row = sqlsrv_fetch_array( $QuobjQuery, SQLSRV_FETCH_ASSOC) ) {
        
              echo "<tr>
                <td>".$row['Mentor']."</td><td>".$row['Subject']."</td>
                <td>".$row['Category']."</td>
                <td>"
                ?>
                <lable id="<? echo str_replace(" ","",$row['Status']); ?>" class="query-status">
                <?
                echo $row['Status']."</lable></td>
                <td>".$row['DateCreated']."</td><td>";

                ?>
                  <button type="submit" value="<? echo $row['QueryID']; ?>" name="queryID" class="btn_view">View</button>
                <?
                
                echo "</td></tr>";
            }
            sqlsrv_free_stmt( $objQuery);
          ?>
        </tbody>  
      </table></form>


  </div>  
</div>
</div><div id="snackbar">Some text some message..</div>
<?php include('queryFooter.php'); ?>
<script>

function mySnackbar() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 4000);
  setTimeout(function(){ location.reload(); }, 1000);
}

$(document).ready(function (){
          var partid = <? echo $partid; ?>;
          $('#SubmitQuery').click(function(){
        $.ajax({                                      
          url: 'Business_Functions.php',              
          type: "post",          
          data: {
            'func':'New_Query',
            'UserID': partid,
            'CatID': $("#CatagorySel").val(),
            'Comment': $("#query_input_text").val(),
            'Subject': $("#SubjectText").val(),
          },
          dataType: 'html',                
        cache: false,
        success: function(data){
            $("#CatagorySel").val('1'),
            $("#query_input_text").val(''),
            $("#SubjectText").val(''),
            $('#snackbar').text(data);
             mySnackbar();
        }
          });
      });
});

    $('#query_input').keyup(function(){
       var wordCount = $(this).val().split(/[\s\.\?]+/).length;
       var wordsleft = 150 - wordCount
       if(wordsleft < 1){
        $('#query_input').attr('disabled','disabled');
        $('#charNum').html('<i class="fas fa-exclamation-circle"></i>You have reached the word limit of this field.');
       }else{
        $('#charNum').html('<i class="fas fa-exclamation-circle"></i>You have ' + wordsleft + ' remaining.');
       }   
    });
    $('#SubjectText').keyup(function(){
       var wordCnt = $(this).val().length;
       var wordslft = 40 - wordCnt
       if(wordslft < 1){
        $('#SubjNum').html('<i class="fas fa-exclamation-circle"></i>You have reached the character limit of this field.');
       }else{
        $('#SubjNum').html('<i class="fas fa-exclamation-circle"></i>You have ' + wordslft + ' characters remaining.');
       }   
    });
</script>
</body>
</html>