<?php
session_start();
if($_SESSION["logged"] == 0 || !isset($_SESSION["logged"])) {
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<script src="jquery-3.2.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
<div class="point-display">
	Seniors: <span id="seniors-points"></span>
</div>
<button class="seniors-point-add">+</button>
<button class="seniors-point-subtract">-</button><br>
<div id="juniors" class="point-display">
	Juniors: <span id="juniors-points"></span>
</div>
<button class="juniors-point-add">+</button>
<button class="juniors-point-subtract">-</button><br>
<div id="sophomores" class="point-display">
	Sophomores: <span id="sophomores-points"></span>
</div>
<button class="sophomores-point-add">+</button>
<button class="sophomores-point-subtract">-</button><br>
<div id="freshmen" class="point-display">
	Freshmen: <span id="freshmen-points"></span>
</div>
<button class="freshmen-point-add">+</button>
<button class="freshmen-point-subtract">-</button><br>
<button onclick="logout()">Administrator Logout</button>
</body>

<script>

$(document).ready(function() {
	var points = 0;

		//Change Senior Points
		$(".seniors-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to add?", 100), 10);
			add("Seniors", points);
		});
		$(".seniors-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to subtract?", 100), 10);
			subtract("Seniors", points);
		});

		//Change Junior Points
		$(".juniors-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to add?", 100), 10);
			add("Juniors", points);
		});
		$(".juniors-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to subtract?", 100), 10);
			subtract("Juniors", points);
		});

		//Change Sophomore Points
		$(".sophomores-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to add?", 100), 10);
			add("Sophomores", points);
		});
		$(".sophomores-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to subtract?", 100), 10);
			subtract("Sophomores", points);
		});

		//Change Freshmen Points
		$(".freshmen-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to add?", 100), 10);
			add("Freshmen", points);
		});
		$(".freshmen-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to subtract?", 100), 10);
			subtract("Freshmen", points);
		});

		displayPoints();
		
	});

function displayPoints() {
	//Display Current Points
	var getPointsRequest = $.ajax({
		type: "POST",
		url: "point_display.php",
		success: function() {
			eval(getPointsRequest.responseText);
		}
	})
}

function add(grade, points) {

	var addPointsRequest = $.ajax({
		type: "POST",
		url: "point_change.php",
		data: {Grade: grade, Points: points, Action: "add"},
		success: function() {
			displayPoints();
		}
	});
}

function subtract(grade, points) {

	var subtractPointsRequest = $.ajax({
		type: "POST",
		url: "point_change.php",
		data: {Grade: grade, Points: points, Action: "subtract"},
		success: function() {
			displayPoints();
		}
	});
}

function logout() {

	var logoutRequest = $.ajax({
		type: "POST",
		url: "logout.php",
		success: function() {
			window.location.href = 'index.php';
		}
	})
}

</script>

</html>