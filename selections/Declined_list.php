
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);
	include('../config/database_conn.php');
	$strKeyword = null;

	if(isset($_POST["txtKeyword"]))
	{
		$strKeyword = $_POST["txtKeyword"];
	}
	if(isset($_GET["txtKeyword"]))
	{
		$strKeyword = $_GET["txtKeyword"];
	}
?>
<form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" style="float: right;">
Business Name: <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
      <input type="submit" value="Filter" class="MyButton">
</form>
<br><br>
<?php


	$strSQL = "SELECT id_signupdate, title, firstname, lastname, email, phonenumber, entname FROM forms.tb_signup_update WHERE id_signupdate IN (SELECT id_participant_Guid FROM participant.admin WHERE bt_accepted = 'no') AND entname LIKE '%".$strKeyword."%' ORDER BY addedsql; ";

	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$objQuery = sqlsrv_query( $objCon, $strSQL , $params, $options );

	$num_rows = sqlsrv_num_rows($objQuery);

	$per_page = 12;   // Per Page
	$page  = 1;
	
	if(isset($_GET["Page"]))
	{
		$page = $_GET["Page"];
	}

	$prev_page = $page-1;
	$next_page = $page+1;

	$row_start = (($per_page*$page)-$per_page);
	if($num_rows<=$per_page)
	{
		$num_pages =1;
	}
	else if(($num_rows % $per_page)==0)
	{
		$num_pages =($num_rows/$per_page) ;
	}
	else
	{
		$num_pages =($num_rows/$per_page)+1;
		$num_pages = (int)$num_pages;
	}
	$row_end = $per_page * $page;
	if($row_end > $num_rows)
	{
		$row_end = $num_rows;
	}


	$strSQL = "SELECT id_signupdate, title, firstname, lastname, email, phonenumber, entname FROM forms.tb_signup_update WHERE id_signupdate IN (SELECT id_participant_Guid FROM participant.admin WHERE bt_accepted = 'no') AND entname LIKE '%".$strKeyword."%' ORDER BY addedsql OFFSET (".$page." - 1) * ".$per_page." ROWS FETCH NEXT ".$per_page." ROWS ONLY";
	$objQuery = sqlsrv_query( $objCon, $strSQL );
?>
	<table>
		<tr>
		<th style=" border-top-left-radius: 15px;">Business Name</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th style=" border-top-right-radius: 15px;"></th>
		</tr>
<?
while($row = sqlsrv_fetch_array($objQuery, SQLSRV_FETCH_ASSOC))
{
				echo "<tr>
					<td>".$row['entname']."</td>
					<td>".$row['firstname']."</td>
					<td>".$row['lastname']."</td>
					<td>"
					?>
					<button  class="clk_comment" onclick="clk_undo('<? echo $row['id_signupdate'] ?>')">Undo</button>
		
					<? echo "</td>
					</tr>";
		}
?>
	</table>
<br>
Total <?php echo $num_rows;?> Record : <?php echo $num_pages;?> Page :
<?php
if($prev_page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$prev_page&txtKeyword=$strKeyword' class='MyButton'>&nbsp; Back &nbsp;</a> ";
}

for($i=1; $i<=$num_pages; $i++){
	if($i != $page)
	{
		echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$i&txtKeyword=$strKeyword' class='MyButton'>&nbsp; $i &nbsp;</a> ";
	}
	else
	{
		echo "<b class='MyButtonblue'>&nbsp; $i &nbsp;</b>";
	}
}
if($page!=$num_pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$next_page&txtKeyword=$strKeyword' class='MyButton'>&nbsp;Next&nbsp;</a class='MyButton'> ";
}
sqlsrv_close($objCon);
?>
