<?php
session_start();
include_once("db_connect.php");
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

<html>
<head>
	<title>Sign Up</title>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="mainform">
			<div id="login-box" style="top: 100;">
				<div class="left-box">
					<h1>Sign Up</h1>
						
						<input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
						<span style='color: red; font-weight: normal; font-style: italic; font-size: 12px;'><?php if (isset($uname_error)) echo $uname_error; ?></span>
						
						<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span style='color: red; font-weight: normal; font-style: italic; font-size: 12px;'><?php if (isset($email_error)) echo $email_error; ?></span>
						
						<input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase letter,one lowercase letter and at least 8 or more characters" required class="form-control" />
						
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<span style='color: red; font-weight: normal; font-style: italic; font-size: 12px;'><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>

						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" style="top: 320px;;"/>

						


				</div>
				<div class="right-box">
					<span class="signinwith">Sign in with<br>Social Network</span>
					<div class="fb" style="position: absolute; top: -230px; left: -115px; box-shadow: 0 2px 4px rgba(0,0,0,0.5); ">
					<a href="https://www.facebook.com"><i class="fab fa-facebook" style="padding-top: 10px; font-size: 50px; transition: color .5s; color: #32508e;"></i></a>
					</div>
					<div style="position: absolute; top: -170px; left: -115px; box-shadow: 0 2px 4px rgba(0,0,0,0.5); ">
					<a href="#"><i class="fab fa-twitter" class="fab fa-facebook" style="padding-top: 10px; font-size: 50px; transition: color .5s; color: #32508e;"></i></a>
				</div>
				<div>
					<a href="#"><i class="fab fa-google-plus-g"></i></a>
					</div>
					<a href="login.php" style="color: #efefef; text-decoration: none; left:80px; position: absolute;
	top: 320px; width:250px;">Already Registered?<pre>     Login</pre></a>
				</div>
				<div class="or">OR</div>
			</div>		
			</form>
			<div style='text-align: center; position: absolute; top: 616px; left: 268px;'><br>
				<span><?php if (isset($success_message)) { echo $success_message; } ?></span>
			</div>
			<div style='text-align: center; position: absolute; top: 616px; left: 268px;'><br>
				<span><?php if (isset($error_message)) { echo $error_message; } ?></span>
			</div>
		</div>
</body>
<script>
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