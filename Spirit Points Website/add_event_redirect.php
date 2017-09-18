<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

	require("mysqlinfo.php");

	$conn = mysqli_connect($ip, $uname, $pass, $dbname);
	$title = mysqli_real_escape_string($conn, $_POST["title"]);
	$description = mysqli_real_escape_string($conn, $_POST["description"]);
	$date = $_POST["date"];

	$sql = "INSERT INTO upcoming (title, description, eventdate) VALUES ('".$title."', '".$description."', '".$date."')";
	$conn->query($sql);

	}

?>