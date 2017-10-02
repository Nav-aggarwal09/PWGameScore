<!DOCTYPE html>
<html>
<head>
<script src="jquery-3.2.0.min.js"></script>
</head>
<body>

<form action="login_redirect.php" method="POST" id="login-form">

<span>Username</span>

<input class="textfield" type="text" id="username" name="username" maxlength="16" required>
<span>Password</span>

<input class="textfield" type="password" id="password" name="password" class="form-control" maxlength="16" required>

<input class="button" type="submit" value="Submit">

</form>

</body>

<script>
	
// $(document).ready(function() {
// 	$("#login-form").on('submit', function(e) {
// 		e.preventDefault();

// 		var loginRequest = $.ajax({
// 			type: "POST",
// 			url: "login_redirect.php",
// 			data: $("#login-form").serialize(),
// 			success: function() {
// 				alert(loginRequest.responseText);
// 			}
// 		})
// 	});
// });

</script>

</html>