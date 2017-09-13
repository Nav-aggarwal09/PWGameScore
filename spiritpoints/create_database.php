<?php 

$conn = mysqli_connect("pinewooddevclub.cqjjg96wderi.us-east-1.rds.amazonaws.com:3306", "dbadmin", "Pinewood22");

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
$conn = mysqli_connect("pinewooddevclub.cqjjg96wderi.us-east-1.rds.amazonaws.com:3306", "dbadmin", "Pinewood22", "main");

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

$sql = "INSERT INTO users (Username, Password) VALUES ('default', 'password')";
$conn->query($sql);

$sql = "INSERT INTO points (Seniors, Juniors, Sophomores, Freshmen) VALUES (100, 100, 100, 100)";
$conn->query($sql);

$conn->close();

?>