<?php
$servername = "localhost"; // Update this to your database server
$username = "root"; // Update this to your database username
$password = ""; // Update this to your database password
$dbname = "farm"; // Update this to your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
