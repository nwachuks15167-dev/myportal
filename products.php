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
    <title>Products Page</title>
</head>
<body>

<h2>All Products</h2>

 <!-- Dashboard Link -->
    <a href="dashboard.php">My Dashboard</a>
    <hr>

<?php
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
?>


<!-- Name -->
<p><b>Name:</b> <?php echo $row['product_name']; ?></p>

<!-- Price -->
<p><b>Price:</b> ₦<?php echo $row['price']; ?></p>

<!-- Quantity -->
<p><b>Quantity:</b> <?php echo $row['quantity']; ?></p>

<!-- Category -->
<p><b>Category:</b> <?php echo $row['category']; ?></p>

<!-- Description -->
<p><b>Descriptions:</b> <?php echo $row['descriptions']; ?></p>

<!-- Image -->
<img src="uploads/<?php echo $row['image']; ?>" width="200">

<!-- Date -->
<p><b>Date Posted:</b> <?php echo date("d M Y", strtotime($row['created_at'])); ?></p>


<!-- EDIT BUTTON -->
        <a href="edit_products.php?id=<?php echo $row['id']; ?>">
            Edit Product
        </a><br>

 <!-- ADD PRODUCT BUTTON -->
        <a href="my_products.php?id=<?php echo $row['id']; ?>">
            Add To My Products
        </a><br>

<!-- DELETE BUTTON -->
        <a href="delete_products.php?id=<?php echo $row['id']; ?>">
            Delete Product
        </a>

<?php
    }

} else {
    echo "No products available";
}
?>

</body>
</html>