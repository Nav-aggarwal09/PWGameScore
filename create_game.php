<?php

//init sql variables
$username = "root";
$password = "root";
$servername = "localhost";
$database = "myDB";

//init values
$sport = $level = $date = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$sport = $_POST["sport"];
	$level = $_POST["level"];
	$date = $_POST["date"];

	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->error);
	}

	$sql = "INSERT INTO sports (Sport, Level, GameDate, Homescore, Awayscore) VALUES ('$sport', '$level', '$date', 0, 0)";
	$conn->query($sql);
	$conn->close();
}
?>