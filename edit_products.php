<?php
include "configure.php";

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
</head>
<body>

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">

    <!-- PRODUCT NAME -->

    <input type="text"
           name="product_name"
           value="<?php echo $product['product_name']; ?>"
           placeholder="Name" required>

    <br><br>

    <!-- PRODUCT PRICE -->

    <input type="text"
           name="price"
           value="<?php echo $product['price']; ?>"
           placeholder="Price" required>

    <br><br>

    <!-- PRODUCT QUANTITY -->

    <input type="text"
           name="quantity"
           value="<?php echo $product['quantity']; ?>"
           placeholder="Quantity" required>
        <br><br>

    <!-- PRODUCT CATEGORY -->
    <input type="text"
           name="category"
           value="<?php echo $product['category']; ?>"
           placeholder="Category" required>

    <br><br>

    <!-- PRODUCT DESCRIPTION -->
    <textarea name="descriptions" placeholder="Descriptions"><?php echo $product['descriptions']; ?></textarea>
    <br><br>


    <!-- Current Image -->
    <img src="uploads/<?php echo $product['image']; ?>" width="150">

    <br><br>

    <!-- Upload New Image -->
    <input type="file" name="image">

        <br><br>
    

    <!-- UPDATE BUTTON -->
    <button type="submit" name="update">

        Update Product

    </button>
    <br><br>

    <a href="products.php">View All Products</a><br>
    <a href="dashboard.php">Back to Dashboard</a>

</form>