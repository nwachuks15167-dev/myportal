<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome to Dashboard</h2>
</body>

<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}


echo "Welcome " . $_SESSION['user'];
?>

<br>
<a href="profile.php">Profile</a><br>
<a href="logout.php">Logout</a>