$(document).ready(function () {

	// $('body').append('<?php include("htmlmodal.php"); ?>');

	$('body').html($('body').html()+'<?php include("./htmlmodals.php"); ?>');

	$('#btn_user_email').click(function(e){
		e.preventDefault();
		var emailaddress = $('#user_email').val();
		console.log(emailaddress);
		checkUser(emailaddress);
	});
	$("#displayModal").on("hidden.bs.modal", function () {
		// put your default event here
		console.log("Closing");
		window.location.href = './index.php';
	});
});

function validateEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	return emailReg.test( $email );
}

function checkUser (emailaddress) {
	var txt;
	// console.log(emailaddress);
	if( !validateEmail(emailaddress)) {
		// console.log('Not valid');
		txt = userOutput(3);
		console.log(txt);
		$('#displayModal').modal("show");
		$('#modalQuoteHeading').text(txt);
	} else {
		var dataStr = {emailaddress: emailaddress};
		$.ajax({
			type: 'POST',
			url: './apicalls/checkuser.php',
			data: dataStr,
			success: function(response) {
				console.log("checkUser: " + response);
				if ( response == 0 ){
					// console.log("User does not exist");
					txt = userOutput(1);
					// console.log(txt);
					$('#displayModal').modal("show");
					$('#modalQuoteHeading').text(txt);
					// go to index page

				} else {
					txt = userOutput(2);
					// console.log(txt);
					$('#displayModal').modal("show");
					$('#modalQuoteHeading').text(txt);
					// window.location.href = './index.php';
				}
			}
		});
	}
}

function userOutput (input) {
	var txtMsg = '';

	// console.log(input);

	var MessageList = {
		1: "Email Address does not exist...",
		2: "You will receive an email with a link to reset your password...",
		3: "Email Address not valid..."
	}

	// console.log(MessageList);

	Object.keys(MessageList).forEach(function(key,index) {

		if ( key == input ){
			txtMsg = MessageList[key];
		}
	});

	// console.log(txtMsg);

	return txtMsg;
}