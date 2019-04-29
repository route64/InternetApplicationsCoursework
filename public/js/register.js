function checkPasswordLength() {
	var password = document.getElementById("password").value;
	var pswdLength = password.length;
	if (pswdLength>=8) {
		document.getElementById("pswdLengthConfirmation").style = "font-size: 80%; color: red; text-align: left; color: green;";
	}else {
		document.getElementById("pswdLengthConfirmation").style = "font-size: 80%; color: red; text-align: left; color: red;";
	}
}

function checkPasswordsMatch() {
	var message = document.getElementById("checkPasswordsMatch");
	var pswd = document.getElementById("password").value;
	var confirmPswd = document.getElementById("passwordConfirm").value;
	
	if(pswd == confirmPswd){
		message.innerHTML= "Passwords Match";
		message.style = "font-size: 80%; color: red; text-align: left; color: green;";
	}else {
		message.innerHTML = "Passwords Do Not Match!";
		message.style = "font-size: 80%; color: red; text-align: left; color: red;";
	}
}

function removeExcessWhiteSpace() {
	var input = document.getElementById('phone_no').value;
	message = document.getElementById('phoneNoCheck');
	if(isNaN(input)){
		message.innerHTML="Numbers Only";
		message.style = "font-size: 80%; color: red; text-align: left; color: red;"
	} 
	else if (hasWhiteSpace(input)) {
		message.innerHTML += '<br/>' + "Please Remove White Space";
	}
	else {
		message.innerHTML= "";
	}
}
function hasWhiteSpace(s) {
  return s.indexOf(' ') >= 0;
}