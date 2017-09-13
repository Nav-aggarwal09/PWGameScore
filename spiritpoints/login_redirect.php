<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$uname = $_POST["username"];
	$pass = $_POST["password"];
	$conn = mysqli_connect("pinewooddevclub.cqjjg96wderi.us-east-1.rds.amazonaws.com:3306", "dbadmin", "Pinewood22", "main");

	$sql = "SELECT * FROM users WHERE Username = '".$uname."' AND Password = '".$pass."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		echo 'window.location.href="admin_index.php"';
		$_SESSION["logged"] = 1;
	} else {
		echo '$("#error").html("Username or password was incorrect")';
		$_SESSION["logged"] = 0;
	}
}

?>