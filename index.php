<?php // This must be the first line of this file.

$cookieName = "myCookie"; // must be identical in both files.
$username = "myUN";
$password = "myPW";
$hoursCookieExists = 36;
$dashboardURL = "http://example.com/dashboard.php";

if( isset($_POST['pw']) and $_POST['pw'] == $password and isset($_POST['un']) and $_POST['un'] == $username )
{
	$cval = $hoursCookieExists > 0 ? (time() + ($hoursCookieExists * 60 * 60)) : '';
	setcookie($cookieName,'good',$cval);
	header("Location: $dashboardURL");
	exit;
}
?>

<html>
<head>
<title>Login</title>
</head>
<body style="margin:200px;">
<form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
<table border="0" cellpadding="0" cellspacing="5"><tr>
<td>Username:</td><td><input type="text" name="un" size="22"></td>
</tr><tr>
<td>Password:</td><td><input type="password" name="pw" size="22"></td>
</tr><tr>
<td> </td><td><input type="submit"></td>
</tr>
</table>
</form>
</body>
</html>


<!-- <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mis_aves";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?> -->



<html>
<head>
	<title>User Login Form - PHP MySQL Ligin System | W3Epic.com</title>
</head>
<body>
<h1>User Login Form - PHP MySQL Ligin System | W3Epic.com</h1>
<?php
if (!isset($_POST['submit'])){
?>
<!-- The HTML login form -->
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />

		<input type="submit" name="submit" value="Login" />
	</form>
<?php
} else {
	require_once("db_const.php");
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * from usuario WHERE usu_rut LIKE '{$username}' AND usu_contra LIKE '{$password}' LIMIT 1";
	$result = $mysqli->query($sql);
	if (!$result->num_rows == 1) {
    echo "<p>Te equivocaste de usuario papoludo</p>";
    exit;
	} else {
    $_SESSION['user']=array('id'=>$id,
             'emailAddress'=>$emailAddress,
             'membership'=>$membership);
    header('Location: dashboard.html');
    exit;
	}
}
?>
</body>
</html>
