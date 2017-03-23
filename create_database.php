<?php

$username = "root";
$password = "root";
$servername = "localhost";
$database = "myDB";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DROP TABLE sports";
$conn->query($sql);

//create table
$sql = "CREATE TABLE sports (
		GameID integer NOT NULL AUTO_INCREMENT,
		Sport varchar(32),
		Level varchar(16),
		GameDate Date,
		Homescore integer,
		Awayscore integer,
		PRIMARY KEY (GameID)
		)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>