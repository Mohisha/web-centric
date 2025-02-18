<?php
// Database configuration
$servername = "localhost"; // Server where your database is hosted
$username = "ayushee"; // 
$password = "ayushee1"; // 
$dbname = "jobrecruitment"; // 

// Creates a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// it checks if the connection was successful
if ($conn->connect_error) {
   // validation
    die("Connection failed: " . $conn->connect_error);
}

// Optionally set the character set for the connection to UTF-8
$conn->set_charset("utf8");
?>
