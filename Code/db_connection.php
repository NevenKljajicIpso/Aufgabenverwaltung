<?php

// Connection parameters
$host = "localhost";
$username = "tester";
$password = "1234";
$dbname = "todo";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>