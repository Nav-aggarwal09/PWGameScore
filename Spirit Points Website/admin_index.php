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

<div class="container">
<div class="col-4">
<table class="log-table">
	<thead>
		<tr>
		<th>
			Recent Activity
		</th>
		</tr>
	</thead>
	<tbody id="log-table-body">
		<tr>
		<th>
			Loading...
		</th>
		</tr>
	</tbody>
</table>
</div>
<div class="col-4">
<div class="center">
<div id="seniors" class="point-display">
	<span class="grade">Seniors</span><br><br><span class="points" id="seniors-points">Loading...</span>
	<button class="seniors-point-add">+</button>
	<button class="seniors-point-subtract">-</button>
</div>
<div id="juniors" class="point-display">
	<span class="grade">Juniors</span><br><br><span class="points" id="juniors-points">Loading...</span>
	<button class="juniors-point-add">+</button>
	<button class="juniors-point-subtract">-</button>
</div>
<div id="sophomores" class="point-display">
	<span class="grade">Sophomores</span><br><br><span class="points" id="sophomores-points">Loading...</span>
	<button class="sophomores-point-add">+</button>
	<button class="sophomores-point-subtract">-</button>
</div>
<div id="freshmen" class="point-display">
	<span class="grade">Freshmen</span><br><br><span class="points" id="freshmen-points">0</span>
	<button class="freshmen-point-add">+</button>
	<button class="freshmen-point-subtract">-</button>
</div>
<button onclick="logout()">Administrator Logout</button><br>
<button onclick="resetDatabase()">Restart Database</button><br>
<button onclick="window.location.href='index.php'">Back to Home</button><br>
<button onclick="window.location.href='add_event.php'">Create New Spirit Event</button>
</div>
</div>
<div class="col-4">
<table class="upcoming-table">
	<thead>
		<tr>
		<th>
			Upcoming Events
		</th>
		</tr>
	</thead>
	<tbody id="upcoming-table-body">
		<tr>
		<th>
			Loading...
		</th>
		</tr>
	</tbody>
</table>
</div>
</div>

</body>

<script>

$(document).ready(function() {
	var points = 0;
	var reason = "";

		//Change Senior Points
		$(".seniors-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to give?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you giving spirit points? (Max 64 Characters)", "Just cuz");
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					add("Seniors", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});
		$(".seniors-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to take away?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you taking away spirit points? (Max 64 Characters)", "Just cuz");
				reason = reason.replace(/\s/g, '');
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					subtract("Seniors", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});

		//Change Junior Points
		$(".juniors-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to give?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you giving spirit points? (Max 64 Characters)", "Just cuz");
				reason = reason.replace(/\s/g, '');
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					add("Juniors", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});
		$(".juniors-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to take away?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you taking away spirit points? (Max 64 Characters)", "Just cuz");
				reason = reason.replace(/\s/g, '');
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					subtract("Juniors", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});

		//Change Sophomore Points
		$(".sophomores-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to give?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you giving spirit points? (Max 64 Characters)", "Just cuz");
				reason = reason.replace(/\s/g, '');
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					add("Sophomores", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});
		$(".sophomores-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to take away?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you taking away spirit points? (Max 64 Characters)", "Just cuz");
				reason = reason.replace(/\s/g, '');
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					subtract("Sophomores", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});

		//Change Freshmen Points
		$(".freshmen-point-add").click(function() {
			points = parseInt(prompt("How many spirit points would you like to give?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you giving spirit points? (Max 64 Characters)", "Just cuz");
				reason = reason.replace(/\s/g, '');
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					add("Freshmen", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});
		$(".freshmen-point-subtract").click(function() {
			points = parseInt(prompt("How many spirit points would you like to take away?", 100), 10);
			if(points > 0) {
				reason = prompt("Why are you taking away spirit points? (Max 64 Characters)", "Just cuz");
				reason = reason.replace(/\s/g, '');
				var reasonTest = reason.replace(/\s/g, '');
				if(typeof(reason) != "undefined" && reason !== null && reasonTest != "") {
					subtract("Freshmen", points, reason);
				} else {
					alert("You have to enter a reason!");
				}
			} else {
				alert("You have to enter more than 0 points!");
			}
		});

		displayPoints();
		displayLog();
		displayUpcoming();
		
	});

function deleteEvent(event) {

	var eventToDelete = event;
	var deleteRequest = $.ajax({
		type: "POST",
		url: "delete_event.php",
		data: {Event: eventToDelete},
		success: function() {
			displayUpcoming();
		}
	})
}

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

function add(grade, points, reason) {

	var addPointsRequest = $.ajax({
		type: "POST",
		url: "point_change.php",
		data: {Grade: grade, Points: points, Reason: reason, Action: "add"},
		success: function() {
			displayPoints();
			displayLog();
		}
	});
}

function subtract(grade, points, reason) {

	var subtractPointsRequest = $.ajax({
		type: "POST",
		url: "point_change.php",
		data: {Grade: grade, Points: points, Reason: reason, Action: "subtract"},
		success: function() {
			displayPoints();
			displayLog();
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

function resetDatabase() {

	var resetRequest = $.ajax({
		type: "POST",
		url: "create_database.php",
		success: function() {
			displayPoints();
			displayLog();
			displayUpcoming();
		}
	})
}

function displayLog() {
	//Display Point Log
	var getLogRequest = $.ajax({
		type: "POST",
		url: "log_display.php",
		success: function() {
			$("#log-table-body").html(getLogRequest.responseText);
		}
	})
}

function displayUpcoming() {
	//Display Upcoming Events
	var getUpcomingRequest = $.ajax({
		type: "POST",
		url: "upcoming_display_admin.php",
		success: function() {
			$("#upcoming-table-body").html(getUpcomingRequest.responseText);
		}
	})
}

</script>

</html>