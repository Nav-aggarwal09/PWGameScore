<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require("mysqlinfo.php");
	$conn = mysqli_connect($ip, $uname, $pass, $dbname);
	$id = $_POST["Event"];

	$sql = "DELETE FROM upcoming WHERE ID = ".$id."";
	$conn->query($sql);
	$conn->close();
}