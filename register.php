<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatibe" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>

<body>
    <h3>Register</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone" placeholder="Phone Number" required><br>
        <input type="number" name="age" placeholder="Age" required><br>
        <input type="file" name="image" required><br>
        <input type="password" name="pwd" placeholder="Password" required><br>
        <button name="register">Register</button>

        <a href="index.php">Already have an account? Login</a>
    </form>
</body>
</html>


<?php
include "configure.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $image);

    $sql = "INSERT INTO users (username, email, pwd, phone, age, profile_pic)
            VALUES ('$username', '$email', '$pwd', '$phone', '$age', '$image');";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful";
    } else {
        echo "Error " . mysqli_errno($conn);
    }header("Location: index.php"); 
}
?>