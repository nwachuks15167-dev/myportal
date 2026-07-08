<?php
session_start();
include "configure.php";

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

    if(mysqli_query($conn, $sql)){
    $message = "Product Added Successfully";
    }else{
    $message = "Error: " . mysqli_error($conn);   
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>

     <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 25px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            color: green;
        }
    </style>
</head>

<body>

<div class="form-container">

    <?php if(isset($message)) { echo "<p class='message'>$message</p>"; } ?>
    
    <h2>Add Product</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Product Name</label>
        <input type="text" name="product_name" required>

        <label>Price</label>
        <input type="number" name="price" required>

        <label>Quantity</label>
        <input type="number" name="quantity" required>

        <label>Category</label>
        <input type="text" name="category" required>

        <label>Description</label>
        <textarea name="descriptions" required></textarea>

        <label>Image</label>
        <input type="file" name="image" required>

        <button type="submit" name="submit">Add Product</button>

    </form>

<a href="products.php" class="btn">Products</a><br>
<a href="my_products.php" class="btn">View My Products</a><br>
<a href="dashboard.php" class="btn">Back to Dashboard</a>

</div>

</body>
</html>