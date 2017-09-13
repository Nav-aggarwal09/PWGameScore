<?php
session_start();
header('Location: index.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$_SESSION["logged"] = 0;
}