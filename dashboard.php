<?php
session_start();
include "configure.php";

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

      <style>

        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
            margin:0;
            padding:0;
        }

        .header{
            background:#007bff;
            color:white;
            padding:20px;
            text-align:center;
        }

        .container{
            width:90%;
            margin:30px auto;
        }

        .cards{
            display:flex;
            flex-wrap:wrap;
            gap:20px;
        }

        .card{
            background:white;
            width:220px;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
            text-align:center;
        }

        .card h3{
            margin-bottom:10px;
        }

        .card a{
            text-decoration:none;
            background:#007bff;
            color:white;
            padding:10px 15px;
            border-radius:5px;
            display:inline-block;
        }

        .card a:hover{
            background:#0056b3;
        }

    </style>
</head>
<body>

<h2>Welcome to Dashboard</h2>

<div class="header">
    <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
</div>

<div class="container">

    <div class="cards">

        <div class="card">
            <a href="profile.php">My Profile</a>
        </div>

        <div class="card">
            <a href="edit_profile.php">Edit Profile</a>
        </div>

        <div class="card">
            <a href="add_products.php">Add Product</a>
        </div>

        <div class="card">
            <a href="products.php">Products</a>
        </div>

        <div class="card">
            <a href="my_products.php">My Products</a>
        </div>

        <div class="card">
            <a href="logout.php">Logout</a>
        </div>

    </div>

</div>

</body>
</html>



