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
</head>
<body>

<h2>My Products</h2>

<?php
if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
?>

    <div style="border:1px solid gray; padding:10px; margin:10px;">

        <!-- Product Image -->
        <img src="uploads/<?php echo $row['image']; ?>" width="200">
    
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

        <!-- DELETE BUTTON -->

        <a href="delete_my_products.php?id=<?php echo $row['product_id']; ?>">
            Remove Product
        </a>
    </div>

<?php
    }

}else{

    echo "No products added yet";

}
?>

<a href="dashboard.php">Back to Dashboard</a><br>

</body>
</html>