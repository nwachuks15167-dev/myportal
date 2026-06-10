<?php
session_start();
include "configure.php";

/*CHECK LOGIN*/
if(!isset($_SESSION['user_id'])){
    die("Please Login First");
}
 
/*GET USER ID*/
$user_id = $_SESSION['user_id'];

/*GET PRODUCT ID*/
$product_id = $_GET['id'];

/*CHECK DUPLICATE*/
$check = "SELECT * FROM user_products
          WHERE user_id='$user_id'
          AND product_id='$product_id'";

$check_result = mysqli_query($conn, $check);

if(mysqli_num_rows($check_result) > 0){
    echo "Product Already Added";
} else {

    /*INSERT PRODUCT*/
    $sql = "INSERT INTO user_products(user_id, product_id)
            VALUES('$user_id', '$product_id')";

    if(mysqli_query($conn, $sql)){
        echo "Product Added Successfully";
        header("Location: my_products.php");
    } else {
        echo "Failed";
    }
}

?>