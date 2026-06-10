<?php
session_start();
include "configure.php";

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }

        .profile-card {
            width: 350px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>

</head>

<body>

<div class="profile-card">

    <h2>PROFILE</h2>

    <img src="uploads/<?php echo $user['profile_pic']; ?>" class="profile-img">

    <h2><?php echo $user['username']; ?></h2>

    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
    <p><strong>Age:</strong> <?php echo $user['age']; ?></p>

    <a href="edit_profile.php" class="btn">Edit Profile</a>
    <br><br>
    <a href="dashboard.php" class="btn">Back to Dashboard</a>

</div>

</body>
</html>
