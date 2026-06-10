<?php
session_start();
include "configure.php";

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];

    /*PROFILE PICTURE*/
    if(!empty($_FILES['image']['name'])) {

        $profile_pic = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $new_profile_pic = time() . "_" . $profile_pic;

        move_uploaded_file($tmp, "uploads/" . $new_profile_pic);
         
    } else {
        $new_profile_pic = $user['profile_pic'];
    }

    /*PASSWORD*/
    if(!empty($_POST['pwd'])) {
        $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    } else {
        $pwd = $user['pwd'];
    }

    /*UPDATE SQL*/
    $sql = "UPDATE users SET
            username = '$username',
            email = '$email',
            phone = '$phone',
            age = '$age',
            profile_pic = '$new_profile_pic',
            pwd = '$pwd'
            WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['username'] = $username;
        echo "Profile Updated";
    } else {
        echo "Update Failed";
    }

}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit profile</title>

      <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 420px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .profile-img {
            text-align: center;
            margin-bottom: 15px;
        }

        .profile-img img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Edit Profile</h2>

    <div class="profile-img">
        <img src="uploads/<?php echo $user['profile_pic']; ?>">
    </div>

    <form method="POST" enctype="multipart/form-data">

        <label>Username</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>">

        <label>Phone</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>">

        <label>Age</label>
        <input type="number" name="age" value="<?php echo $user['age']; ?>">

        <label>Profile Picture</label>
        <input type="file" name="image">

        <label>Password</label>
        <input type="password" name="pwd">

        <button type="submit" name="update">Update Profile</button>

    </form>

</div>

</body>
</html>