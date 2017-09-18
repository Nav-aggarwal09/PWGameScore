<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require("mysqlinfo.php");
	$conn = mysqli_connect($ip, $uname, $pass, $dbname);
	$sql = "SELECT * FROM log ORDER BY ID DESC LIMIT 10";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

		$date = date('M j', strtotime($row["eventdate"]));
		$prep = "";
		$plusminus = "";

		//choose 'to' or 'from' as the preposition
		//choose red or green background for + or -
		if($row["action"] == "gave") {
			$prep = "to";
			$plusminus = "green";

		} elseif($row["action"] == "took") {
			$prep = "from";
			$plusminus = "red";
		}

		echo ("<tr><td><span class='log-main'>".$row["user"]." ".$row["action"]." <span class='".$plusminus."'>".$row["points"]."</span> Points ".$prep." the ".$row["grade"].".</span><span class='log-reason'>Reason: ".$row["reason"]."</span><span class='log-date'>".$date."</span></td></tr>");
		}
	} else {
		echo ("<tr><td style='text-align: center;'>No Recent Activity</td></tr>");
	}
	$conn->close();
}

?>