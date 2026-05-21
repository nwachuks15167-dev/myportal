<?php
session_start();
include("configure.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])) {

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $descriptions = $_POST['descriptions'];

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO products
    (product_name, price, quantity, category, descriptions, user_id)
    
    VALUES
    ('$product_name', '$price', '$quantity', '$category', '$descriptions', '$user_id')";

    mysqli_query($conn,$sql);

    echo "Product Added Successfully";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h2>Add Product</h2>

<form method="POST">

    <input type="text" name="product_name" placeholder="Product Name" required>
    <br><br>

    <input type="text" name="price" placeholder="Price" required>
    <br><br>

    <input type="number" name="quantity" placeholder="Quantity" required>
    <br><br>

    <input type="text" name="category" placeholder="Category" required>
    <br><br>

    <textarea name="descriptions" placeholder="Product Descriptions"></textarea>
    <br><br>


    <button type="submit" name="submit">
        Add Product
    </button>

</form>

<br>

<a href="my_products.php">View My Products</a><br>
<a href="dashboard.php">Back to Dashboard</a><br>

</body>
</html>