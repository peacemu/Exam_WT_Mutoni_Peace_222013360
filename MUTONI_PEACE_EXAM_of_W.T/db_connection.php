<?php
// Connection details
$host = "localhost";
$user = "Mutoni";
$pass = "PEACE$07.";
$database = "parent_teacher_communication_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>