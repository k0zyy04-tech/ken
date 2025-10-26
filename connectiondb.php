<?php
$servername = "sql102.infinityfree.com";
$username = "if0_40257075";     // Default XAMPP user
$password = "kenkhirby0415";         // Default password is blank
$database = "if0_40257075_cruddb";
$conn = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
