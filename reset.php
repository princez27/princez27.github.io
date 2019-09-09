<?php
session_start();
include_once("db_connect.php");
?>

<html>
<head>
	<title>Forget Password</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
</head>
	<body>
	<div class="Password-Box">
		<h1>Reset Password</h1>
		<form name="forgetpasswordform"  onsubmit="return validate_password();">
		<input type="email" name="email" placeholder="Enter Email" required style="border: none;  border-bottom: 1px solid #fff;background: transparent; outline: none; height: 40px; color: #fff; font-size: 16px;">
		<input type="password" name="password1" id="psw" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase letter,one lowercase letter and at least 8 or more characters" required>
		<input type="password" name="password2" placeholder="Retype Password" required>
		<button onsubmit type="submit" style="border: none; outline: none; height: 40px; background: #1c8adb; color: #fff; font-size: 18px; border-radius: 20px; text-transform: uppercase; width: 100%; margin-bottom: 20px;" >Submit<?php
											$sql = 'UPDATE user SET pass=? WHERE email=?';
											$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
											
											
?>
		</button>
	   </form>
	</body>
	<script>
		function validate_password()
		{
			var p1=document.forgetpasswordform.password1.value;
			var p2=document.forgetpasswordform.password2.value;
			if(p1!=p2)
			{
				alert("Please retype the password correctly !!!");
				return false;
			}
		}
		//Password type
		var myInput = document.getElementById("psw");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		// When the user clicks on the password field, show the message box
		myInput.onfocus = function() {
  			document.getElementById("message").style.display = "block";
		}

		// When the user clicks outside of the password field, hide the message box
		myInput.onblur = function() {
			document.getElementById("message").style.display = "none";
		}

		// When the user starts to type something inside the password field
		myInput.onkeyup = function() {
  			// Validate lowercase letters
  			var lowerCaseLetters = /[a-z]/g;
  			if(myInput.value.match(lowerCaseLetters)) { 
    			letter.classList.remove("invalid");
    			letter.classList.add("valid");
  		} else {
    			letter.classList.remove("valid");
    			letter.classList.add("invalid");
		}

  		// Validate capital letters
  		var upperCaseLetters = /[A-Z]/g;
  		if(myInput.value.match(upperCaseLetters)) { 
    			capital.classList.remove("invalid");
    			capital.classList.add("valid");
  		} else {
    			capital.classList.remove("valid");
    			capital.classList.add("invalid");
  		}

  		// Validate numbers
  		var numbers = /[0-9]/g;
 		if(myInput.value.match(numbers)) { 
    			number.classList.remove("invalid");
    			number.classList.add("valid");
  		} else {
    			number.classList.remove("valid");
    			number.classList.add("invalid");
  		}

  		// Validate length
  		if(myInput.value.length >= 8) {
    			length.classList.remove("invalid");
    			length.classList.add("valid");
  		} else {
    			length.classList.remove("valid");
    			length.classList.add("invalid");
  		}
		
	</script>
</html>