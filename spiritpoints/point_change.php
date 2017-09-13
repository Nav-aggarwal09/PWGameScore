<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	switch($_POST["Action"]) {
		case "add":
			add();
			break;
		case "subtract":
			subtract();
			break;
		default:
			break;
	}
}

function add() {
	$grade = getGrade();
	$points = $_POST["Points"];

	$conn = mysqli_connect("pinewooddevclub.cqjjg96wderi.us-east-1.rds.amazonaws.com:3306", "dbadmin", "Pinewood22", "main");
	$sql = "UPDATE points SET ".$grade." = ".$grade." + ".$points."";
	$conn->query($sql);
}

function subtract() {
	$grade = getGrade();
	$points = $_POST["Points"];

	$conn = mysqli_connect("pinewooddevclub.cqjjg96wderi.us-east-1.rds.amazonaws.com:3306", "dbadmin", "Pinewood22", "main");
	$sql = "UPDATE points SET ".$grade." = ".$grade." - ".$points."";
	$conn->query($sql);
}

function getGrade() {
	switch($_POST["Grade"]) {
		case "Seniors":
			return "Seniors";
			break;
		case "Juniors":
			return "Juniors";
			break;
		case "Sophomores":
			return "Sophomores";
			break;
		case "Freshmen":
			return "Freshmen";
			break;
		default:
			break;
	}
}
?>