<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link href="../style-css/Styles_login.css" rel="stylesheet">	
	<style type="text/css">
	html, body {
    margin: 0;
    padding: 0;
    font-family: sans-serif, Arial, Helvetica;
    font-size: 14px;
    height: 100%;
}	
	.container {
    right: 50%;
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translate(-50%);
    background-color: #e5f9ff;
    width: 850px;
    height: auto;
    border-radius: 30px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
	.txtTheme {
    border-radius: 25px;
    height: 20px;
    width: 280px;
    font-size: 14px;
    padding-left: 15px;
}
	select.selTheme {
    height: 28px;
    background-color: #007197;
    color: white;
    width: 300px;
    border: none;
    font-size: 14px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    -webkit-appearance: button;
    outline: none;
    border: 2px solid #ccc;
    border-radius: 25px;
    padding: 2px;
    padding-left: 12px;
}
textarea.areTheme {
    width: 300px;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 10px;
    background-color: #f8f8f8;
    font-size: 14px;
    resize: none;
    font-family: inherit;
}
	</style>
</head>
<body>
	   <div class="container">  
      <div class="email_reset">
         <br>
         <img src="../site-images/logo_150px.png" style="width:200px;height:75px; position: relative; left:30%" alt="fetola">
         <hr>
	<table>
		<tr>
			<td  colspan="2">Sign Up</td>
		</tr>
		<tr>
			<td>Title</td>
			<td>
				<select name="Title" id="suTitle" class="selTheme">
					<option value="Mrs">
							Mrs
						</option>
						<option value="Miss">
							Miss
						</option>
						<option value="Mr">
							Mr
						</option>
						<option value="Ms">
							Ms
						</option>
						<option value="Doctor">
							Doctor
						</option>
						<option value="Professor">
							Professor
						</option>
						<option value="Other">
							Other
						</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Firstname</td>
			<td><input type="text" name="Firstname" id="suFirstname" placeholder="Your Name" class="txtTheme"></td>
		</tr>
		<tr>
			<td>Lastname</td>
			<td><input type="text" name="Lastname" id="suLastname" placeholder="Your Surname" class="txtTheme"></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td>
				<select name="Gender" id="suGender" class="selTheme">
						<option value="Female">
							Female
						</option>
						<option value="Male">
							Male
						</option>
						<option value="Other">
							Other
						</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Business Name</td>
			<td><input type="text" name="BusinessName" id="suBusinessName" placeholder="Your Business Name" class="txtTheme"></td>
		</tr>
		<tr>
			<td>In which industry if your business</td>
			<td>
				<select name="Industry" id="suIndustry" class="selTheme">
                <option>Agriculture and environment </option>
                <option>Creative Including arts, crafts and design</option>
                <option>Education & training </option>
                <option>Energy and Electrical power including renewables</option>
                <option>Engineering, Construction & architecture </option>
                <option>Entertainment, Music, Film & Video gaming</option>
                <option>Financial services and Insurance </option>
                <option>Food & agro-processing</option>
                <option>Health care industry including Pharmaceutical </option>
                <option>Hospitality, Tourism, restaurant and conferencing</option>
                <option>IT and Software including Robotics and AI </option>
                <option>Manufacturing inc Automotive, chemical, textiles</option>
                <option>Media, Social media, Broadcasting & Publishing</option>
                <option>Mining, Petroleum and related </option>
                <option>Property & Real estate </option>
                <option>Public service and Government</option>
                <option>Retail & wholesale including online & e- commerce</option>
                <option>Service industries (Other) - inc Business services & consulting</option>
                <option>Social enterprise and Non profit</option>
                <option>Sports & recreation </option>
                <option>Telecommunications </option>
                <option>Transport and logistics </option>
                <option>Water, waste, recycling & sanitation </option>
                <option>Other</option>
            </select>
			</td>
		</tr>
		<tr>
			<td>Company Registration Number</td>
			<td><input type="text" name="RegistrationNo" id="suRegistrationNo" placeholder="Your Business Name" class="txtTheme"></td>
		</tr>
		<tr>
			<td>How long has your company been in Business for</td>
			<td>
				<select name="BusinessExistFor" id="suBusinessExistFor" class="selTheme">
			        <option>less than 6 months</option>
			        <option>between 6 months and 1 year</option>
			        <option>between 1 and 2 years</option>
			        <option>between 2 and 3 years</option>
			        <option>between 3 and 5 years</option>
		        	<option>more than 5 years</option>
	            </select>
        	</td>
		</tr>
		<tr>
			<td>How many people are employed at your company</td>
			<td>
				<select id="Bus_edit_employee_count_form_sel" class="selTheme">
			        <option>1 - 10</option>
			        <option>11 - 50</option>
			        <option>51 - 100</option>
			        <option>101 - 300</option>
			        <option>301 - 500</option>
			        <option>Above 500</option>
	            </select>
			</td>
		</tr>
		<tr>
			<td>What was the annual revenue for your company last year</td>
			<td><select id="Bus_edit_annual_revenue_form_sel" class="selTheme">
			        <option>R 0 - R 335 000</option>
			        <option>R 335 001 - R 500 000</option>
			        <option>R 500 001 - R 750 000</option>
			        <option>R 750 001 - R 1 000 000</option>
			        <option>R 1 000 000 - R 5 000 000</option>
			        <option>R 5 000 000 - R 10 000 000</option>
			        <option>R 10 000 000 - R 20 000 000</option>
			        <option>R 20 000 000 - R 60 000 000</option>
			        <option>Above R 60 000 000</option>
            	</select>
			</td>
		</tr>
		<tr>
			<td>What is your BEE Score</td>
			<td>
				<select id="Bus_edit_bee_score_form_sel"  class="selTheme">
        			<option selected>Less than 51%</option>
        			<option>More than 51%</option>
            	</select>
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="EmailAddress" id="suEmailAddress" placeholder="Your Business Name"  class="txtTheme" disabled="true"></td>
		</tr>
		<tr>
			<td>Contact Number</td>
			<td><input type="text" name="ContactNo" id="suContactNo" placeholder="Your Business Name"  class="txtTheme"></td>
		</tr>
		<tr>
			<td>Address</td>
			<td>
				<textarea name="Address" id="suAddress" class="areTheme"></textarea>
			</td>
		</tr>
		<tr>
			<td>Province</td>
			<td>
				<select id="Bus_edit_sa_prov_form_sel" class="selTheme">
	              <option>Eastern Cape</option>
	              <option>Free State</option>
	              <option>Gauteng</option>
	              <option>KwaZulu-Natal</option>
	              <option>Limpopo</option>
	              <option>Mpumalanga</option>
	              <option>Northern Cape</option>
	              <option>North West</option>
	              <option>Western Cape</option>
            	</select>
        	</td>
		</tr>
		<tr><td colspan="2"><button id="Save">Save</button></tr>
	</table>
	</div>
   </div>
</body>
</html>