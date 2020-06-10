<?php
	include('../config/database_conn.php');
	$GETstatSQL = "SELECT * FROM FetolaDB.participant.admin a INNER JOIN import.TP_Status_Info t ON t.Business_GUID = a.id_participant_Guid INNER JOIN FetolaDB.support.CompanyDet cd ON t.int_ID_Status = cd.Businessdet_id  WHERE a.int_participant_ID = 2;";
	$GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
	$GETstat = sqlsrv_fetch_array($GETstatQuery, SQLSRV_FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sample</title>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	<script src="https://kit.fontawesome.com/a012f76b8f.js" crossorigin="anonymous"></script>
</head>
<body>
	<table style="width: 100%; padding: 2px">
			<tr>
				<td>Contact Number</td>
				<td id="Bus_edit_business_sector_td">
				<div id="Bus_edit_business_sector_text">
					<div id="Bus_edit_business_sector_txt_value">
						<b><? echo $GETstat['Sector']; ?></b>
					</div><i class="fas fa-edit" tip="Edit" style="float:right;cursor: pointer;" id="Bus_edit_business_sector_icon"></i>
				</div>
				<div id="Bus_edit_business_sector_form" style="display: none;">
					<b>
						<select id="Bus_edit_business_sector_form_sel">
							<option<? If($GETstat['Sector'] == 'Agriculture, forestry and fishing'){ echo "selected";} ?>>Agriculture, forestry and fishing</option>
							<option<? If($GETstat['Sector'] == 'Mining'){ echo "selected";} ?>>Mining</option>
							<option<? If($GETstat['Sector'] == 'Manufacturing'){ echo "selected";} ?>>Manufacturing</option>
							<option<? If($GETstat['Sector'] == 'Electricity, gas, steam and air conditioning supply'){ echo "selected";} ?>>Electricity, gas, steam and air conditioning supply</option>
							<option<? If($GETstat['Sector'] == 'Water supply, sewerage and waste management activities'){ echo "selected";} ?>>Water supply, sewerage and waste management activities</option>
							<option<? If($GETstat['Sector'] == 'Construction'){ echo "selected";} ?>>Construction</option>
							<option<? If($GETstat['Sector'] == 'Wholesale and retail trade'){ echo "selected";} ?>>Wholesale and retail trade</option>
							<option<? If($GETstat['Sector'] == 'Transportation and Storage'){ echo "selected";} ?>>Transportation and Storage</option>
							<option<? If($GETstat['Sector'] == 'Accomodation and food services'){ echo "selected";} ?>>Accomodation and food services</option>
							<option<? If($GETstat['Sector'] == 'Information and communication'){ echo "selected";} ?>>Information and communication</option>
							<option<? If($GETstat['Sector'] == 'Financial and insurance services'){ echo "selected";} ?>>Financial and insurance services</option>
							<option<? If($GETstat['Sector'] == 'Real Estate'){ echo "selected";} ?>>Real Estate</option>
							<option<? If($GETstat['Sector'] == 'Scientific and technical services'){ echo "selected";} ?>>Scientific and technical services</option>
							<option<? If($GETstat['Sector'] == 'Education'){ echo "selected";} ?>>Education</option>
							<option<? If($GETstat['Sector'] == 'Human health and social work activities'){ echo "selected";} ?>>Human health and social work activities</option>
							<option<? If($GETstat['Sector'] == 'Arts, entertainment and recreation'){ echo "selected";} ?>>Arts, entertainment and recreation</option>
							<option<? If($GETstat['Sector'] == 'Other Services'){ echo "selected";} ?>>Other Services</option>
						</select>
						<i class="fas fa-save" tip="Save" style="float:right;cursor: pointer;" id="Bus_edit_business_sector_save"></i>
					</b>
				</div>
				</td>
			</tr>
			</table>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#Bus_edit_business_sector_icon').on( "click", function(){
				$('#Bus_edit_business_sector_text').hide();
				$('#Bus_edit_business_sector_form').show();
			});
			$('#Bus_edit_business_sector_save').on( "click", function(){
				alert($('#Bus_edit_business_sector_form_sel').val());

			});
		});
	</script>		
</body>
</html>	