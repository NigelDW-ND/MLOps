<?php
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	$oqBtnClass = '';
	$mqBtnClass = '';
	$mpBtnClass = '';
	$mp2BtnClass = '';
	if($curPageName == "openqueries.php"){
		$oqBtnClass = "nav-btn-group-select";
	}else{
		$oqBtnClass = "nav-btn-group";
	}
	if($curPageName == "myqueries.php"){
		$mqBtnClass = "nav-btn-group-select";
	}else{
		$mqBtnClass = "nav-btn-group";
	}
	if($curPageName == "profile.php"){
		$mpBtnClass = "nav-btn-group-select";
	}else{
		$mpBtnClass = "nav-btn-group";
	}
	
?>
<div class="headerContainer">
	<div class="headerLogo">
		<img src="../site-images/fnb_logos.png" style="width:350px;height:70px;" alt="fetola">
	</div>
	<div class="nav">		
		<nav class='navbar'>
			<button type="button" class="<?php echo $mpBtnClass ?>" onclick="window.location.href = 'profile.php'">My Profile</button>
			<button type="button" class="<?php echo	$oqBtnClass ?>" onclick="window.location.href = 'openqueries.php'">Open Queries</button>
			<button type="button" class="<?php echo $mqBtnClass ?>" onclick="window.location.href = 'myqueries.php'">My Queries</button>			
			<button type="button" class="nav-btn-group" onclick="window.location.href = '../'"><i class='fas fa-sign-out-alt'></i> Sign Out</button>
		</nav>
	</div>
</div>
	
