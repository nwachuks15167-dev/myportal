<?php
session_start();
include "configure.php";

// Fetch all products
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>

 <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }

        .card h3 {
            margin: 10px 0 5px;
        }

        .price {
            color: green;
            font-weight: bold;
        }

        .meta {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .buttons {
            margin-top: 10px;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-right: 5px;
        }

        .edit {
            background: #3498db;
            color: white;
        }

        .delete {
            background: #e74c3c;
            color: white;
        }

        .add {
            background: #2ecc71;
            color: white;
        }
    </style>
</head>

<body>

 <!-- Dashboard Link -->
    <a href="dashboard.php" class="btn">Back to Dashboard</a>
    <hr>

<h2 style="text-align:center;">All Products</h2>

<div class="container">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card">

        <img src="uploads/<?php echo $row['image']; ?>">

        <h3><?php echo $row['product_name']; ?></h3>

        <p class="price">₦<?php echo $row['price']; ?></p>

        <p class="meta">Quantity: <?php echo $row['quantity']; ?></p>

        <p class="meta">Category: <?php echo $row['category']; ?></p>

        <p class="meta">
            <?php echo $row['descriptions']; ?>
        </p>

        <p class="meta">
            Created: <?php echo $row['created_at']; ?>
        </p>

        <div class="buttons">

            <a class="btn add" href="add_to_my_products.php?id=<?php echo $row['id']; ?>">
                Add Product
            </a>

            <a class="btn edit" href="edit_products.php?id=<?php echo $row['id']; ?>">
                Edit
            </a>

            <a class="btn delete" href="delete_products.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Are you sure?')">
                Delete
            </a>

        </div>

    </div>

<?php } ?>

</div>

</body>
</html>