<?php
session_start();
include "configure.php";


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($pwd, $user['pwd'])) {   
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid login";
    }
}
?>

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
    <h3>Login</h3>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="pwd" placeholder="Password" required><br>
        <button name="login">Login</button>

        <a href="register.php">Don't have an account? Register here</a> 
    </form>
     
</body>
</html>





