<?php
	include('../config/database_conn.php');
	session_start();
?>

<br>
<form method="post">
Comment - Yes by <? echo $_SESSION["UserName"]."."; ?><br>

<br>
<br>
<textarea id="tat_Applicant_Comment" name="tat_Applicant_Comment" rows="4" cols="50">
</textarea><br>
<input type="button" id="btn_Choice_yes" Name="btn_Choice_yes" Value="Mark as Pending">  
<input type="button" id="btn_Choice_yes" Name="btn_Choice_yes" Value="Close" onclick="span.onclick()">
</form>
<br>