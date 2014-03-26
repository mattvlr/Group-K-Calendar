function checkPass()
{
	//Store the password field objects into variables ...
	var pass1 = document.getElementById('password');
	var pass2 = document.getElementById('password1');
	var message = document.getElementById('confirmMessage');
	//and the confirmation field
	if(pass1.value == pass2.value){
		pass2.style.backgroundColor = "#66cc66";
		message.style.color = "#66cc66";
		message.innerHTML = "Passwords Match!"
	}else{
		pass2.style.backgroundColor = "#ff6666";
		message.style.color = "#ff6666";
		message.innerHTML = "Passwords Do Not Match!"
	}
}  