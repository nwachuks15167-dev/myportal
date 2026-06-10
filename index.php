<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Portal</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h1 {
            margin-bottom: 10px;
            color: #333;
        }

        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        a {
            display: block;
            text-decoration: none;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .login {
            background: #28a745;
        }

        .login:hover {
            background: #218838;
        }

        .register {
            background: #007bff;
        }

        .register:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    
<div class="container">
    <h1>Welcome</h1>
    <p>Please login or register to continue</p>

    <a class="login" href="login.php">Login</a>
    <a class="register" href="register.php">Register</a>
</div>

</body>
</html>