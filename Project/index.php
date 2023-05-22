<?php

$host = "localhost";
$username = "admin";
$password = "Mjones00";
$database = "bookstore";


/ Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$query = "SELECT * FROM books Limit 5";
$result = $conn->query($query);
