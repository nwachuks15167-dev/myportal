<?php
session_start();
include "configure.php";

/*
========================
GET USER ID
========================
*/

$user_id = $_SESSION['user_id'];

/*
========================
GET PRODUCT ID
========================
*/

$product_id = $_GET['id'];

/*
========================
DELETE USER PRODUCT
========================
*/

$sql = "DELETE FROM user_products

        WHERE user_id='$user_id'

        AND product_id='$product_id'";

if(mysqli_query($conn, $sql)){

    echo "Product Removed Successfully";

    header("refresh:2; url=my_products.php");

} else {

    echo "Delete Failed";
}
?>