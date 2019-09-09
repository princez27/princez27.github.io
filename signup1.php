<?php
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
}
$error = false;
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$uname_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($conn, "INSERT INTO users(user, email, pass) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
			$success_message = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
	   }
	 	else {
			$error_message = "Error in registering...Please try again later!";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
	<body>
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="mainform">
	<div id="login-box">
		<div class="left-box">
		<h1>Sign Up</h1>
		
			
			<input type="text" name="username" placeholder="Enter Username" required>
     			
			<input type="text" name="email" placeholder="Enter Email Id" required>
			
			<input type="password" name="password" id="psw" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase letter,one lowercase letter and at least 8 or more characters" required>
			
			<input type="password" name="password2" placeholder="Retype Password" required>
 
			<input type="submit" name="submit" value="Sign Up">

			<a href="Loginpage.html">Already Registered?<pre>     Login</pre></a>
		
		</div>
		<div class="right-box">
			<span class="signinwith">Sign in with<br>Social Network</span>
			
			<button class="social facebook">Log in with Facebook</button>
			<button class="social twitter">Log in with Twitter</button>
			<button class="social google">Log in with Google+ </button>
		</div>	
		<div class="or">OR</div>
	</div>	
	</form>
	</body>
	<script>
		function validate_email()
		{
			var p1=document.mainform.password.value;
			var p2=document.mainform.password2.value;
			var x=document.mainform.email.value;
			var atposition=x.indexOf("@");
			var dotposition=x.lastIndexOf(".");
			if(atposition<1||dotposition<atposition+2||dotposition+2>=x.length)
			{
				alert("Please enter a valid E-mail address !!!");
				return false;
			}
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
		}
	</script>
</html>