<!DOCTYPE html>
<html>
<head>
	<title>Sport Form</title>
</head>
<body>

<?php
$date = $sport = $level = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$level = $_POST["level"]; $sport = $_POST["sport"]; $date = $_POST["date"];
	print ("$date, $sport, $level");
	$newfile = fopen("../htdocs/Sports/$sport/$level/".$date, "w") or die("Error");
	fwrite($newfile, $sport . " game on " . $date);
	fclose($newfile);
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Date:
	<input type="date" name="date">
	Sport:
	<select name="sport">
	<option value="">---</option>
	<option value="Football">Football</option>
	<option value="Volleyball">Volleyball</option>
	<option value="Baseball">Baseball</option>
	</select>
	JV or Varsity:
	<select name="level">
	<option value="">---</option>
	<option value="V">Varsity</option>
	<option value="JV">JV</option>
	</select>

	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to index</a>

</body>
</html>
