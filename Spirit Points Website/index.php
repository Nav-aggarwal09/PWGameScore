<?php
session_start();
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
	<span class="grade">Seniors (The Best Grade)</span><br><br><span class="points" id="seniors-points">Loading...</span>
</div>
<div id="juniors" class="point-display">
	<span class="grade">Juniors</span><br><br><span class="points" id="juniors-points">Loading...</span>
</div>
<div id="sophomores" class="point-display">
	<span class="grade">Sophomores</span><br><br><span class="points" id="sophomores-points">Loading...</span>
</div>
<div id="freshmen" class="point-display">
	<span class="grade">Freshmen</span><br><br><span class="points" id="freshmen-points">Loading...</span>
</div>
<button onclick="window.location.href='login.php'">Administrator Login</button>
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
		displayPoints();
		displayLog();
		displayUpcoming();
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
		url: "upcoming_display.php",
		success: function() {
			$("#upcoming-table-body").html(getUpcomingRequest.responseText);
		}
	})
}

</script>
</html>