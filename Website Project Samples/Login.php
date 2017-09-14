<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
	<!-- Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Slick Carousel -->
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./slick/slick.css">
	<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
	<!-- Custom -->
	<script type="text/javascript" src=""></script>
	<script type= 'text/javascript' src='./Login.js'></script>
	<link rel="stylesheet" type="text/css" href="Homepage.css">
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<!-- Consistent Nav Dropdown -->
	<div class="dropdown" style="position: absolute; top: 50%;">
		<button id="side_nav" class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-right"></span></button>
		<ul id="slide_nav_sub" class="dropdown-menu" role="menu">
			<li role="presentation"><a href="./Homepage.php"><button class="btn btn-block">Home</button></a></li>
			<li role="presentation"><a href="./Help.html"><button class="btn btn-block">Help</button></a></li>
			<li role="presentation"><a href="./AdvancedSearch.php"><button class="btn btn-block">Search</button></a></li>
		</ul>
	</div>
	<!-- Log-in form / create new account -->
	<div class="container">
	<div class="form-group">
		<form id="mainform" name ="form_1" action="./Login.php" method="post" onsubmit="return validate1();"">
		<label>Username: </label>
		<input class="form-control input-lg" id="username" type="text" name="username" oninput="return validate(this.value);"><span id="box"></span><br>
		<label>Password: </label>
		<input class="form-control input-lg" type="password" name="password"><br>
		<input class="form-control input-lg" type="reset" value="Reset">
		<input class="form-control input-lg" type="submit" name="login" id="login" value="Login">
		<input class="form-control input-lg" type="submit" name="register" id="register" value="Register">
		</form>
	</div>
	</div>
</body>
</html>
<?php
$servername = 'fall-2016.cs.utexas.edu';
$username = 'etwigg';
$p = '2+BRPMegFkB0tph2u9XdnA==
';
$dbname = "cs329e_etwigg";
$key = 'CS329';
$method = 'aes-128-cbc';
$password = openssl_decrypt ($p, $method, $key);
// Process Register
if (isset($_POST['register'])) {
	//sanitize inputs for DB
	$user_san = preg_replace('/\s+/', '',$_POST['username']);
	$pass_san = preg_replace('/\s+/', '',$_POST['password']);
	$pass_cry = openssl_encrypt ($pass_san, $method, $key);
	//connect to DB to insert username/password
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "insert into users (username, password)
	 values ('$user_san', '$pass_cry')";
	if ($conn->query($sql) == TRUE) {
		echo "Registration Successful";
	} else {
		echo "Error: " .$sql . "<br>" . $conn->error;
	}
	$conn->close();
}
// Login Validation
if (isset($_POST['login'])) {
	//sanitize inputs, encrypt password for use
	$user_san = preg_replace('/\s+/', '',$_POST['username']);
	$pass_san = preg_replace('/\s+/', '',$_POST['password']);
	$pass_cry = openssl_encrypt ($pass_san, $method, $key);
	//connect to DB and pull password for username
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "select password from users where username='$user_san'";
	$result = $conn->query($sql);
	//set login cookie
	while ($row = $result->fetch_assoc()){
	if ($pass_cry == $row[password]) {
		setcookie('logged_in', $username, time() + 86400);
	} else {
		return ;
	}
	}
	$conn->close();
}
?>