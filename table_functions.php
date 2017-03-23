<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
	switch($_POST["action"]) {
		case "delete":
		delete();
		exit;

		case "display":
		displayTable();
		exit;

		case "addscore":
		addScore();
		exit;

		case "subtractscore":
		subtractScore();
		exit;

		default:
		echo "No such function exists!";
		exit;
	}
}

function addScore() {
	$conn = new mysqli("localhost", "root", "root", "myDB");
		if($conn->connect_error) {
			die("Connection failed: " . $conn->error);
		}

		$length = count($_POST);
		if($_POST["scoreTeam"] == "home") {
			for($i=0;$i<$length;$i++){
				echo ($_POST[$i]);
				$sql = "UPDATE sports SET Homescore = Homescore + 2 WHERE GameID=".$_POST["$i"]."";
				$conn->query($sql);
			}
		}
		if($_POST["scoreTeam"] == "away") {
			for($i=0;$i<$length;$i++){
				echo ($_POST[$i]);
				$sql = "UPDATE sports SET Awayscore = Awayscore + 2 WHERE GameID=".$_POST["$i"]."";
				$conn->query($sql);
			}
		}

		$conn->close();
}

function subtractScore() {
	$conn = new mysqli("localhost", "root", "root", "myDB");
		if($conn->connect_error) {
			die("Connection failed: " . $conn->error);
		}

		$length = count($_POST);
		if($_POST["scoreTeam"] == "home") {
			for($i=0;$i<$length;$i++){
				echo ($_POST[$i]);
				$sql = "UPDATE sports SET Homescore = Homescore - 2 WHERE GameID=".$_POST["$i"]."";
				$conn->query($sql);
			}
		}
		if($_POST["scoreTeam"] == "away") {
			for($i=0;$i<$length;$i++){
				echo ($_POST[$i]);
				$sql = "UPDATE sports SET Awayscore = Awayscore - 2 WHERE GameID=".$_POST["$i"]."";
				$conn->query($sql);
			}
		}

		$conn->close();
}

function delete() {
		$conn = new mysqli("localhost", "root", "root", "myDB");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->error);
		}

		$length = count($_POST);
		for($i=0;$i<$length;$i++){
			$sql = "DELETE FROM sports WHERE GameID=".$_POST["$i"]."";
			$conn->query($sql);
		}

		$conn->close();
}

function displayTable() {
$conn = new mysqli("localhost", "root", "root", "myDB");

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->error);
	}

	$sql = "SELECT * FROM sports";
	$result = $conn->query($sql);
	if ($conn->query($sql)) {
		if ($result->num_rows > 0) {
		    echo "<table><tr>
		    <th>ID</th>
		    <th>Sport</th>
		    <th>Level</th>
		    <th>Date</th>
		    <th>Home</th>
		    <th>Away</th>
		    <th>Select</th>
		    </tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr>
		        <td>".$row["GameID"]."</td>
		        <td>".$row["Sport"]."</td>
		        <td>".$row["Level"]."</td>
		        <td>".$row["GameDate"]."</td>
		        <td>".$row["Homescore"]."</td>
		        <td>".$row["Awayscore"]."</td>
		        <td><input type='checkbox' name='game' value='".$row['GameID']."' id='".$row['GameID']."' onchange='setSelected(".$row["GameID"].", checked)'></td>
		        </tr>";
		    }
		    echo "</table>";
		} else {
		    echo "No results";
		}
	} else {
		echo "Error selecting: " . $conn->error;
	}
}

?>
<!-- REFERENCES
ACTION METHODS:
delete: Deletes data from table.
display: Dislplays current table. To edit table, Go to displayTable function and edit <th> and <td> tags.
addscore: Adds score to either home or away.
subtractscore: Subtracts score from either home or away.

ATTRIBUTES:
scoreTeam: "home", "away"; Tells which team to add/subtract the points to/from.

