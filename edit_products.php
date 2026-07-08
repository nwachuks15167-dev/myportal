<?php
session_start();
include "configure.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['product_name'];
    $description = $_POST['descriptions'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];

     // Image
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // Check if new image was uploaded
    if ($image != "") {
        move_uploaded_file($tmp, "uploads/" . $image);
    } else {
        // Keep old image
        $image = $product['image'];
    }

    $sql = "UPDATE products SET 
    product_name='$name', 
    descriptions='$description', 
    price='$price', 
    quantity='$quantity', 
    category='$category',
    image='$image' 

    WHERE id='$id'";

    if(mysqli_query($conn, $sql)){
        echo "Product Updated Successfully";
    } else {
        echo "Update Failed";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>

     <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }

        .container {
            width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #555;
        }

        .back:hover {
            color: black;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Edit Product</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Product Name</label>
        <input type="text" name="product_name"
               value="<?php echo $product['product_name']; ?>">

        <label>Price</label>
        <input type="text" name="price"
               value="<?php echo $product['price']; ?>">

        <label>Quantity</label>
        <input type="text" name="quantity"
               value="<?php echo $product['quantity']; ?>">

        <label>Category</label>
        <input type="text" name="category"
               value="<?php echo $product['category']; ?>">

        <label>Description</label>
        <textarea name="descriptions"><?php echo $product['descriptions']; ?></textarea>

        <label>Image</label>
        <input type="file" name="image">

        <button type="submit" name="update">Update Product</button>

    </form>

    <a class="back" href="products.php">← Back to Products</a>

</div>

</body>
</html>

 