<?php
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	$oqBtnClass = '';
	$mqBtnClass = '';
	if($curPageName == "Profile.php"){
		$oqBtnClass = "nav-btn-group-select";
	}else{
		$oqBtnClass = "nav-btn-group";
	}
	if($curPageName == "Queries.php" or $curPageName == "query.php"){
		$mqBtnClass = "nav-btn-group-select";
	}else{
		$mqBtnClass = "nav-btn-group";
	}
?>
<div class="headerContainer">
	<div class="headerLogo">
		<img src="../site-images/fnb_logos.png" style="width:440px;height:85px;" alt="fetola">
	</div>
	<div class="nav">		
		<nav class='navbar'>
			<button type="button" class="<?php echo	$oqBtnClass ?>" onclick="window.location.href = 'Profile.php'">My Profile</button>
			<button type="button" class="<?php echo $mqBtnClass ?>" onclick="window.location.href = 'Queries.php'">My Queries</button>
			<button type="button" class="nav-btn-group" onclick="window.location.href = '../'"><i class='fas fa-sign-out-alt'></i> Sign Out</button>
		</nav>
	</div>
</div>
	
