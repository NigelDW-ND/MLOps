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
<input type="button" id="btn_Choice_yes" Name="btn_Choice_yes" Value="Yes" Text="Application Accepted" class="clk_clear" value="<? echo $_POST["suggest"] ?>" onclick="clk_action_sign(this.value, <? echo $_SESSION["UserID"]; ?>, '<? echo $_POST['suggest'] ?>')">  
<input type="button" id="btn_Choice_no" Name="btn_Choice_no" Value="No"  Text="Application Declined" class="clk_clear" value="<? echo $_POST["suggest"] ?>" onclick="clk_action_sign(this.value, <? echo $_SESSION["UserID"]; ?>, '<? echo $_POST['suggest'] ?>')">
</form>
<br>