<?php
session_start();
include "configure.php";

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $sql = "DELETE FROM products WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {

        echo "Product deleted successfully";
        header("refresh:2; url=products.php");

    } else {

        echo "Delete failed: " . mysqli_error($conn);
    }

} else {

    echo "No product ID found";
}
?>