<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

	require("mysqlinfo.php");
	$conn = mysqli_connect($ip, $uname, $pass, $dbname);
	$today = date("Y-m-d");
	$sql = "SELECT * FROM upcoming WHERE eventdate >= '".$today."' ORDER BY ID ASC LIMIT 10";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$date = date('M j', strtotime($row["eventdate"]));
		$value = $row["ID"];

		echo ("<tr><td><span class='upcoming-title'>".$row["title"]."<button style='margin-left: 5px;' onclick='deleteEvent(".$value.")'>Delete</button></span><span class='upcoming-date'>".$date."</span><span class='upcoming-description'>Description: ".$row["description"]."</span></td></tr>");
		}
	} else {
		echo ("<tr><td style='text-align: center;'>No Upcoming Spirit Events</td></tr>");
	}

}

?>