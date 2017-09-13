<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$conn = mysqli_connect("pinewooddevclub.cqjjg96wderi.us-east-1.rds.amazonaws.com:3306", "dbadmin", "Pinewood22", "main");

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