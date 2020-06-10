<!doctype html>
<?
session_start();
$partid = $_SESSION["UserID"];
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/plain; charset=utf-8">
<title>Business Account Details</title>
<link href="../../style-css/Styles-part-support.css" rel="stylesheet">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>	
</head>
<style type="text/css">
	
#part_tb, #part_td {
  color: black;
  text-align: left;
  font-size: 10px;
  background: #00000000;
  box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0), 0 0px 0px 0 rgba(0, 0, 0, 0);
  padding: 4px;
}

#part_td:hover, #part_tr:hover{SS
  color: black;
  text-aliSSSSSgn: left;
  font-size: 10px;
  background: #00000000;
  box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0), 0 0px 0px 0 rgba(0, 0, 0, 0);
  padding: 4px;
}

			.mentorbus-btn-group {
				width: 130px;
				height: 40px;
				font-size: 15px;
				transition: 0.5s;
				background: url('../site-images/nav_button_blank_spark.png') no-repeat top left;
			}
			.mentorbus-btn-group-select {
				width: 130px;
				height: 40px;
				font-size: 15px;				
				background: url('../site-images/nav_button_green_spark.png') no-repeat top left;
			}				
			.mentorbus-btn-group:hover {
				
				background: url('../site-images/nav_button_blue_spark.png') no-repeat top left;
			}
		</style>
<body>
<div class="container">	
<!--  NAVBAR ---------------------------------------------------------------------->	
<? include('nav.php'); ?>
<!--  end of navbar   -------------------------------------------------------    --><hr><br><br>
	
		
		<div id="query-view" class="query-view"> 

			<br>
			<br>
	
			<div id="query">
			<img src="../../site-images/query_icon.png" style="width:25px;height:25px;" alt="fetola">	
			My Account Details
			<hr><br>
			<div id="part-details">				
			</div><hr>
			<div class="pwcontainer">

			Update My Password:<br>
			<label>Password: </label><br>
			<input id="myPassword" type="password" class="form-control">
			<br>
			<label>Verify Password: </label><br>
			<input id="myConfirmPassword" type="password" class="form-control">
			<div id="errors" class="well">
			</div>
			<input type="button" id="SubmitPWChange" value="Save" name="Update" style="visibility: hidden;" class="btn_claim">
			</div>


<script type="text/javascript" src="../js-script/jquery.password-validation.js"></script>
<script>
	$(document).ready(function() {
		$("#myPassword").passwordValidation({"confirmField": "#myConfirmPassword"}, function(element, valid, match, failedCases) {

		    $("#errors").html("<pre>" + failedCases.join("\n") + "</pre>");
		  
		     if(valid) $(element).css("border","2px solid green");
		     if(!valid) $(element).css("border","2px solid red");
		     if(valid && match) $("#myConfirmPassword").css("border","2px solid green");
		     if(valid && match) $("#SubmitPWChange").css("visibility","visible");
		     if(!valid || !match) $("#myConfirmPassword").css("border","2px solid red");
		});
	});
</script>

				
			</div>
      			
			<div id="response">
			<img src="../../site-images/response_icon.png" style="width:25px;height:25px;" alt="fetola">		
			Business Description:
			<br><hr><br>
			Please tell us more about your business? <br>
			<textarea id="query_input" name="BusDescr" rows="5" cols="50" placeholder="In no more than 150 words."></textarea><div id="charNum"></div><br>

			<button class="desc_update_btn">Update</button>
			<hr><br> 
				
			<div id="res">		
				<!--Placeholder -->		
			<p>
		  
					
				
			</p>
				<!------------------------------------>			
			</div>
			
			</div>
	
		
     </div>	


</div>
	<script type="text/javascript">
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
		$(document).ready(function (){
			var partid = <? echo $partid; ?>;

		    $.ajax({                                      
		      url: 'partcipant_details.php',              
		      type: "post",          
		      data: {'Part_ID':partid},
		      dataType: 'html',                
			  cache: false,
			  success: function(data){
					$('#part-details').html(data);
				}
		   });
		   $('.desc_update_btn').click(function(){
		   	$.ajax({                                      
		      url: 'update_bus_descr.php',              
		      type: "post",          
		      data: {'UserID':partid, 'Bus_Desc':$("#query_input").val()},
		      dataType: 'html',                
			  cache: false,
			  success: function(data){
					location.reload();
				}
		   		});
			});
		});
	</script>

</body>
</html>
