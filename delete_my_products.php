<?php
session_start();
include "configure.php";


// Check if product id exists
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    // Delete ONLY from my_products table
    $sql = "DELETE FROM user_products WHERE product_id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {

        header("Location: my_products.php");
        exit();

    } else {

        echo "Product not deleted";

    }

} else {

    echo "No product ID found";

}
?>