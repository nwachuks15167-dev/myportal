<?php
include "configure.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    $profile_pic = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $profile_pic);

    $sql = "INSERT INTO users (username, email, pwd, phone, age, profile_pic)
            VALUES ('$username', '$email', '$pwd', '$phone', '$age', '$profile_pic');";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful";
    } else {
        echo "Error " . mysqli_errno($conn);
    }header("Location: login.php"); 
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
    <title>Register</title>

      <style>

        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
            margin:0;
            padding:0;
        }

        .container{
            width:400px;
            margin:50px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            color:#333;
        }

        input{
            width:100%;
            padding:10px;
            margin:8px 0;
            border:1px solid #ccc;
            border-radius:5px;
            box-sizing:border-box;
        }

        input[type="submit"]{
            background:#007bff;
            color:white;
            border:none;
            cursor:pointer;
        }

        input[type="submit"]:hover{
            background:#0056b3;
        }

        .login-link{
            text-align:center;
            margin-top:15px;
        }

        .login-link a{
            text-decoration:none;
            color:#007bff;
        }

    </style>
</head>

<body>
   <div class="container">

    <h2>Register</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text"
               name="username"
               placeholder="Enter Username"
               required>

        <input type="email"
               name="email"
               placeholder="Enter Email"
               required>

        <input type="text"
               name="phone"
               placeholder="Enter Phone Number"
               required>

        <input type="number"
               name="age"
               placeholder="Enter Age"
               required>

        <input type="password"
               name="pwd"
               placeholder="Enter Password"
               required>

        <input type="file"
               name="image"
               required>

        <input type="submit"
               name="register"
               value="Register">

    </form>

    <div class="login-link">
        Already have an account?
        <a href="login.php">Login Here</a>
    </div>

</div>

</body>
</html>


