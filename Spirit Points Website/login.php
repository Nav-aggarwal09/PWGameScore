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
<div class="container">
<div class="col-4" style="width: 15%; margin-left: 40%; margin-right: 40%; text-align: center; border-radius: 10px; padding-top: 200px; padding-left: 40px; padding-right: 40px; padding-bottom: 200px;">

<p id='error' style="background-color: #fff; border-radius: 10px;"></p>

<form action="login_redirect.php" method="POST" id="login-form" style="text-align: center;">

<span style="display: block;">Username</span>
<input class="textfield" type="text" id="username" name="username" maxlength="16" autocomplete="off" style="display: block;" required>
<span style="display: block;">Password</span>
<input class="textfield" type="password" id="password" name="password" class="form-control" maxlength="16" autocomplete="off" style="display: block;" required>
<input type="submit" value="Submit">

</form>
<button onclick="window.location.href='index.php'">Back to Home</button>

</div>
</div>
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
					$("#password").select();		
					eval(loginRequest.responseText);
				}
			});
		});
	});

</script>

</html>