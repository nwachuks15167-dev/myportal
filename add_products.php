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

     // Image
    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    // Move image to uploads folder
    move_uploaded_file($tmp, "uploads/" . $image);


    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO products
    (product_name, price, quantity, category, descriptions, user_id, image)
    
    VALUES
    ('$product_name', '$price', '$quantity', '$category', '$descriptions', '$user_id', '$image')";

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

<form method="POST" enctype="multipart/form-data">

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

    <input type="file" name="image" required>

    <button type="submit" name="submit">
        Add Product
    </button>

</form>

<br>

<a href="products.php">Products</a><br>
<a href="my_products.php">View My Products</a><br>
<a href="dashboard.php">Back to Dashboard</a><br>

</body>
</html>