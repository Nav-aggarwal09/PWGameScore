<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$logfile = "pointslog.txt";
	require("mysqlinfo.php");
	$user = $_SESSION["user"];
	$date = date("Y-m-d");
	switch($_POST["Action"]) {
		case "add":

			$grade = getGrade();
			$points = $_POST["Points"];
			$conn = mysqli_connect($ip, $uname, $pass, $dbname);
			$reason = mysqli_real_escape_string($conn, $_POST["Reason"]);
			$sql = "UPDATE points SET ".$grade." = ".$grade." + ".$points."";
			$conn->query($sql);

			//write to log
			if(file_exists($logfile)) {
				//write to file
				$handle = fopen($logfile, 'a');
				$data = $date . ": ".$user." Added ".$points." Spirit Points to ".$grade.". (Reason: " . $reason . ")" . PHP_EOL;
				fwrite($handle, $data);
				fclose($handle);
			} else {
				//create file
				$handle = fopen($logfile, 'w');
				$data = $date . ": ".$user." Added ".$points." Spirit Points to ".$grade.". (Reason: " . $reason . ")" . PHP_EOL;
				fwrite($handle, $data);
				fclose($handle);
			}
			$sql = "INSERT INTO log (eventdate, user, points, grade, reason, action) VALUES ('".$date."', '".$user."', ".$points.", '".$grade."', '".$reason."', 'gave')";
			$conn->query($sql);
			$conn->close();
			break;
		case "subtract":

			$grade = getGrade();
			$points = $_POST["Points"];
			$conn = mysqli_connect($ip, $uname, $pass, $dbname);
			$reason = mysqli_real_escape_string($conn, $_POST["Reason"]);
			$sql = "UPDATE points SET ".$grade." = ".$grade." - ".$points."";
			$conn->query($sql);

			//write to log
			if(file_exists($logfile)) {
				//write to file
				$handle = fopen($logfile, 'a');
				$data = $date . ": ".$user." Took ".$points." Spirit Points from ".$grade.". (Reason: " . $reason . ")" . PHP_EOL;
				fwrite($handle, $data);
				fclose($handle);
			} else {
				//create file
				$handle = fopen($logfile, 'w');
				$data = $date . ": ".$user." Took ".$points." Spirit Points to ".$grade.". (Reason: " . $reason . ")" . PHP_EOL;
				fwrite($handle, $data);
				fclose($handle);
			}
			$sql = "INSERT INTO log (eventdate, user, points, grade, reason, action) VALUES ('".$date."', '".$user."', ".$points.", '".$grade."', '".$reason."', 'took')";
			$conn->query($sql);
			$conn->close();
			break;
		default:
			break;
	}
}

function getGrade() {
	switch($_POST["Grade"]) {
		case "Seniors":
			return "Seniors";
			break;
		case "Juniors":
			return "Juniors";
			break;
		case "Sophomores":
			return "Sophomores";
			break;
		case "Freshmen":
			return "Freshmen";
			break;
		default:
			break;
	}
}
?>