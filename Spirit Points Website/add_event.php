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
<div class="col-4" style="width: 15%; margin-left: 40%; margin-right: 40%; text-align: center; border-radius: 10px; padding-top: 200px; padding-left: 40px; padding-right: 40px; padding-bottom: 200px;">

<form action="add_event_redirect.php" method="POST" id="event-form">
<span style="display: block;">Event Title</span>
<input class="textfield" type="text" name="title" maxlength="64" autocomplete="off" required>
<span style="display: block;">Event Description</span>
<input class="textfield" type="text" name="description" maxlength="128" autocomplete="off" required>
<input style="margin-top: 10px;" type="date" name="date" min="2017-08-21" max="2018-05-31" required>
<input type="submit" value="Submit">
</form>

<button onclick="window.location.href='admin_index.php'">Back to Admin Home</button>
</div>
</div>
</body>
<script>
	
$(document).ready(function() {
		$("#event-form").on('submit', function(e) {
			e.preventDefault();
			var addEventRequest = $.ajax({
				type: "POST",
				url: "add_event_redirect.php",
				data: $("#event-form").serialize(),
				success: function() {		
					window.location.href = 'index.php';
				}
			});
		});
	});

</script>
</html>