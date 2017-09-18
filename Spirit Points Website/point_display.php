<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require("mysqlinfo.php");

	$conn = mysqli_connect($ip, $uname, $pass, $dbname);
	$sql = "SELECT * FROM points WHERE RowID = 1";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		echo   "$('#seniors-points').html(".$row["Seniors"].");
				$('#juniors-points').html(".$row["Juniors"].");
				$('#sophomores-points').html(".$row["Sophomores"].");
				$('#freshmen-points').html(".$row["Freshmen"].");";
	}
	$conn->close();
}

?>