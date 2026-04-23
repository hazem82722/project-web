<?php
$conn = new mysqli("localhost", "root", "", "project_db");

if ($conn->connect_error) {
    die("Error");
}
?>
