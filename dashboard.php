<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$_SESSION['user_id']
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome to Dashboard</h2>
<p><?php echo "Welcome " . $_SESSION['username'];?></p>

</body>

<a href="profile.php">Profile</a><br>
<a href="products.php">Products</a><br>
<a href="add_products.php">Add Product</a><br>
<a href="logout.php">Logout</a>


