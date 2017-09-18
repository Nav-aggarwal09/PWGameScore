<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

require("mysqlinfo.php");

$conn = mysqli_connect($ip, $uname, $pass);

$sql = "DROP DATABASE main";
$conn->query($sql);

$sql = "CREATE DATABASE main";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$sql = "DROP TABLE points";
$conn->query($sql);

$conn->close();
$conn = mysqli_connect($ip, $uname, $pass, $dbname);

$sql = "CREATE TABLE points (
		RowID integer NOT NULL AUTO_INCREMENT,
		Seniors integer,
		Juniors integer,
		Sophomores integer,
		Freshmen integer,
		PRIMARY KEY (RowID)
		)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "DROP TABLE users";
$conn->query($sql);

$sql = "CREATE TABLE users (
		RowID integer NOT NULL AUTO_INCREMENT,
		Username varchar(16),
		Password varchar(16),
		PRIMARY KEY (RowID)
		)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO users (Username, Password) VALUES ('default', 'password'), ('Jackee', 'password'), ('Mr. Lemmon', 'password')";
$conn->query($sql);

$sql = "DROP TABLE log";
$conn->query($sql);

$sql = "CREATE TABLE log (
		ID integer NOT NULL AUTO_INCREMENT,
		points integer,
		action varchar(12),
		grade varchar(12),
		user varchar(16),
		eventdate date,
		reason varchar(64),
		PRIMARY KEY (ID)
		)";
$conn->query($sql);

$sql = "INSERT INTO points (Seniors, Juniors, Sophomores, Freshmen) VALUES (0, 0, 0, 0)";
$conn->query($sql);

$sql = "DROP TABLE upcoming";
$conn->query($sql);

$sql = "CREATE TABLE upcoming (
		ID integer NOT NULL AUTO_INCREMENT,
		title varchar(64),
		description varchar(128),
		eventdate date,
		PRIMARY KEY (ID)
		)";
$conn->query($sql);

$conn->close();

}

?>