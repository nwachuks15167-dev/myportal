<?php
session_start();
include "configure.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $check_sql = "SELECT id FROM user_products 
                  WHERE user_id='$user_id' 
                  AND product_id='$product_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) == 0) {
        $insert_sql = "INSERT INTO user_products 
                       (user_id, product_id) 
                       VALUES 
                       ('$user_id', '$product_id')";

        if(mysqli_query($conn, $insert_sql)) {        
                echo "<p style='color:green;'>Product added successfully!</p>";
        } else {
            echo "<p style='color:orange;'>You already have this product.</p>";
        }

    } else {
        echo "You Already Added This Product";
    }
}

$sql = "SELECT * FROM user_products JOIN products
ON user_products.product_id = products.id
WHERE user_products.user_id='$user_id'";

$result = mysqli_query($conn, $sql);
?>



<!DOCTYPE html>
<html>
<head>
    <title>My Products</title>

      <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            background: #fff;
            width: 280px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }

        .card h3 {
            margin: 10px 0 5px;
            color: #333;
        }

        .info {
            font-size: 14px;
            color: #555;
            margin: 3px 0;
        }

        .price {
            color: green;
            font-weight: bold;
            margin: 5px 0;
        }

        .delete-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background: darkred;
        }
    </style>

</head>

<body>

<h2>My Products</h2>

<div class="container">

<?php while($product = mysqli_fetch_assoc($result)) { ?>

    <div class="card">

        <img src="uploads/<?php echo $product['image']; ?>">

        <h3><?php echo $product['product_name']; ?></h3>

        <p class="price">₦<?php echo $product['price']; ?></p>

        <p class="info">Quantity: <?php echo $product['quantity']; ?></p>

        <p class="info">Category: <?php echo $product['category']; ?></p>

        <p class="info"><?php echo $product['descriptions']; ?></p>

        <p class="info">Created At: <?php echo $product['created_at']; ?></p>

        <a class="delete-btn"
           href="delete_my_product.php?id=<?php echo $product['product_id']; ?>"
           onclick="return confirm('Are you sure you want to delete this product?')">
           Delete
        </a>

    </div>

<?php } ?>

</div>

<a href="dashboard.php">Back to Dashboard</a><br>

</body>
</html>