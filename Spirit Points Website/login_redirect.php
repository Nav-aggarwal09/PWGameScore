<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require("mysqlinfo.php");
	$conn = mysqli_connect($ip, $uname, $pass, $dbname);
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	$sql = "SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		echo 'window.location.href="admin_index.php"';
		$_SESSION["user"] = $username;
		$_SESSION["logged"] = 1;
	} else {
		echo '$("#error").html("Incorrect username or password"); $("#error").attr("style", "background-color: #fff; border-radius: 10px; padding-bottom: 4px; padding-top: 4px;")';
		$_SESSION["logged"] = 0;
	}
}

?>