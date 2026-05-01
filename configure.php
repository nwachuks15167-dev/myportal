<?php
$conn = mysqli_connect("localhost", "root", "", "myportal");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_errno());
}
