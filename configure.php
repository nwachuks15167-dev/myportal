<?php
$conn = mysqli_connect("localhost", "root", "", "myportal");

fopen("configure.php", "r");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_errno());
}
