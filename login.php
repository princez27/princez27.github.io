<?php
session_start();
include_once("db_connect.php");
if(isset($_SESSION['user_id'])!="") {
	header("Location: index.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and pass = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['user_id'] = $row['uid'];
		$_SESSION['user_name'] = $row['user'];
		header("Location: index.php");
	} else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
?>
<html>
<head>
	<title>Transparent Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="Login-Box">
	<img src="images.png" class="images">	
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<?php
				if(isset($_GET["newPwd"])){
					if($_GET["newPwd"] == "passwordupdated"){
						echo '<p class="signupsuccess">Password reseted!</p>';
					}
				}
				?>
					<h1>Login</h1>						
						<p for="name">Username</p>
						<input type="text" name="email" placeholder="Enter Email" required class="form-control" />
						<p for="name">Password</p>
						<input type="password" name="password" placeholder="Enter Password"  required class="form-control" />
						<input type="submit" name="login" value="Login" class="btn btn-primary" />
						<a href="forgotpassword.php">Forgot Password</a><br><br>	
			</form>
			<div style='text-align: center'><br>
				<span style='color: red; font-weight: normal; font-style: italic; font-size: 12px;'><?php if (isset($error_message)) { echo $error_message; } ?></span>
			</div>
		<div class="signup"><a href="signup.php">Sign Up</a></div>
		<div class="adminlogin"><a href="adminlogin.php">Admin Login</a></div>	
	</div>
</body>
</html>

