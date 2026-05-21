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

    /*
    PROFILE PICTURE
    */
    if(!empty($_FILES['image']['name'])) {

        $profile_pic = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $new_profile_pic = time() . "_" . $profile_pic;

        move_uploaded_file($tmp, "uploads/" . $new_profile_pic);
         
    } else {
        $new_profile_pic = $user['profile_pic'];
    }

    /*  
    PASSWORD
    */
    if(!empty($_POST['pwd'])) {
        $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    } else {
        $pwd = $user['pwd'];
    }

    /*
    UPDATE SQL
    */
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
</head>
<body>

<h2>Edit Profile</h2>

<form method="POST" enctype="multipart/form-data">

    <input  type="text"
            name="username"
            value="<?php echo $user['username']; ?>"
            placeholder="Name" required>
    <br><br>

    <input  type="email"
            name="email"
            value="<?php echo $user['email']; ?>"
            placeholder="Email" required>
    <br><br>    

    <input  type="number"
            name="age"
            value="<?php echo $user['age']; ?>"
            placeholder="Age" required>
    <br><br>

    <input  type="text"
            name="phone"
            value="<?php echo $user['phone']; ?>"
            placeholder="Phone Number" required>
    <br><br>

    <img src="uploads/<?php echo $user['profile_pic']; ?>" width="100">
    <br><br>

    <input type="file" name="image">
    <br><br>

    <input  type="password"
            name="pwd"
            placeholder="New Password">
    <br><br>

    <button type="submit" name="update">
        Update
    </button>
    <br><br>

    <a href="profile.php">Back to Profile</a>
</form>

</body>
</html>