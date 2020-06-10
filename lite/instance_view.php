<?php
	include('../config/database_conn.php');
	$strSQL = "SELECT * FROM mentor.support_catagory_groups";

?>

<form id="form1" name="form1" method="post" action="">
  <table width="200">
    <tr>
      <td align="left" valign="top" align="left">Me: </td>
      <td align="left" valign="top" align="left"></td>
    </tr>
    <tr>
      <td align="left" valign="top" align="left">Catagory:</td>
      <td align="left" valign="top" align="left">
        <label>
        <select name="drp_catagory">
			<?
			$objQuery = sqlsrv_query($objCon, $strSQL);
			if( $objQuery === false) {
				die( print_r( sqlsrv_errors(), true) );
			}			
			while( $row = sqlsrv_fetch_array( $objQuery, SQLSRV_FETCH_ASSOC) ) {
				echo "<option>".$row['str_support_group_catagory_description']."</option>";
			}
			?>
			<option>test</option>
        </select>
        </label></td>
    </tr>
    <tr>
      <td align="left" valign="top" align="left">Subject:</div></td>
      <td align="left" valign="top" align="left"><input type="text" name="txt_subject" size="50"></td>
    </tr>
    <tr>
      <td align="left" valign="top" align="left">Query:</td>
      <td align="left" valign="top" align="left"><label>
        
          <textarea name="txa_applicant_query" rows="4" cols="50"></textarea>
        
      </label></td>
    </tr>    <tr>
      <td align="left" valign="top" align="left"></td>
      <td align="left" valign="top" align="left"><input type="button" value="submit" text="Submit"></td>
    </tr>
  </table>
</form>

