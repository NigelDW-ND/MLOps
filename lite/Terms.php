<!DOCTYPE html>
<?
session_start();
$partid = $_SESSION["UserID"];        
?>
<html>
<head>
	<title>Terms and Conditions</title>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>
<body>
	<h1>Terms and Contions go here.</h1>
	<button id="Accepted">Accept</button> <button>Decline</button>
<script>
	$(document).ready(function (){
    	var partid = <? echo $partid; ?>;
    	$("#Accepted").click(function() {
    		$.ajax({                                      
          		url: 'Business_Functions.php',              
          		type: "post",          
          		data: {'func':'Accept_Terms','UserID':partid},
          		dataType: 'html',                
        		cache: false,
        		success: function(data){
        			$(location).prop('href', 'Profile.php');
        		}
          	});
    	});
  	});
</script>
</body>
</html>