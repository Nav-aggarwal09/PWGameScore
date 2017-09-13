<?php
session_start();
if($_SESSION["logged"] == 1) {
	header('Location: admin_index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<script src="jquery-3.2.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>

<form action="login_redirect.php" method="POST" id="login-form">

Username:
<input type="text" name="username" maxlength="16"><br>
Password:
<input type="text" name="password" maxlength="16"><br>
<input type="submit" value="Submit">

</form>
<button onclick="window.location.href='index.php'">Back to Home</button>

<p id='error'></p>
</body>

<script>
	
	$(document).ready(function() {
		$("#login-form").on('submit', function(e) {
			e.preventDefault();
			var loginRequest = $.ajax({
				type: "POST",
				url: "login_redirect.php",
				data: $("#login-form").serialize(),
				success: function() {			
					eval(loginRequest.responseText);
				}
			});
		});
	});

</script>

</html>