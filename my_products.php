<?php

session_start();
include "configure.php";


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM products 
WHERE user_id = $user_id ORDER BY id DESC";

$result = mysqli_query($conn, $sql);
?>



<!DOCTYPE html>
<html>
<head>
    <title>My Products</title>
</head>
<body>

<h2>My Products</h2>

<?php
if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
?>

    <div style="border:1px solid gray; padding:10px; margin:10px;">

        <!-- Product Name -->
        <h3><?php echo $row['product_name']; ?></h3>

        <!-- Price -->
        <p>
            <b>Price:</b>
            ₦<?php echo $row['price']; ?>
        </p>

        <!-- Quantity -->
        <p>
            <b>Quantity:</b>
            <?php echo $row['quantity']; ?>
        </p>

        <!-- Category -->
        <p>
            <b>Category:</b>
            <?php echo $row['category']; ?>
        </p>

        <!-- Description -->
        <p>
            <?php echo $row['descriptions']; ?>
        </p>

        <!-- Date -->
        <p>
            <small>
                <?php echo $row['created_at']; ?>
            </small>
        </p>

    </div>

<?php
    }

}else{

    echo "No products added yet";

}
?>

</body>
</html>