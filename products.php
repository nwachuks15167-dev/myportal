<?php
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

<!-- Date -->
<p><b>Date Posted:</b> <?php echo date("d M Y", strtotime($row['created_at'])); ?></p>

<br>

<!-- Delete Button (optional admin feature) -->
<a href="delete_product.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this product?')">
Delete
</a>


<?php
    }

} else {
    echo "No products available";
}
?>

</body>
</html>