<?php
session_start();
include_once("db_connect.php");
if(isset($_SESSION['admin_id'])!="") {
	header("Location: index.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and pass = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['admin_id'] = $row['aid'];
		$_SESSION['admin_name'] = $row['admin'];
		header("Location: index.php");
	} else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
?>

<html>
<head>
	<title>Admin Login Page</title>
	<link rel="stylesheet" type="text/css" href="adminlogin.css">
</head>
	<body>
	<div class="Login-Box">
	<img src="images.png" class="images">
		<h1>Admin Login</h1>
		<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<p>Username</p>
		<input type="text" name="username" placeholder="Enter Username" required class="form-control" />
		<p>Password</p>
		<input type="password" name="password" placeholder="Enter Password" required class="form-control" />
		<input type="submit" name="submit" value="Login" class="btn btn-primary" />
		<a href="forgotpassword.php">Forgot Password</a><br><br>
		</form>
		<div style='text-align: center'><br>
			<span style='color: red; font-weight: normal; font-style: italic; font-size: 12px;'><?php if (isset($error_message)) { echo $error_message; } ?></span>
		</div>	</body>
</html>