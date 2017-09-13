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
<div class="point-display">
	Seniors: <span id="seniors-points"></span>
</div>
<div id="juniors" class="point-display">
	Juniors: <span id="juniors-points"></span>
</div>
<div id="sophomores" class="point-display">
	Sophomores: <span id="sophomores-points"></span>
</div>
<div id="freshmen" class="point-display">
	Freshmen: <span id="freshmen-points"></span>
</div>
<button onclick="window.location.href='login.php'">Administrator Login</button>
</body>

<script>

$(document).ready(function() {
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

</script>
</html>