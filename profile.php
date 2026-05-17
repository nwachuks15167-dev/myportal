<?php
session_start();
include "configure.php";


$id = $_SESSION['user_id'];



$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<h2>USER PROFILE</h2>

<p>Name: <?php echo $user['username']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<p>Phone: <?php echo $user['phone']; ?></p>
<p>Age: <?php echo $user['age']; ?></p>


 <img src="uploads/<?php echo $user['profile_pic']; ?>" width="120">


<br><br>
<a href="edit_profile.php">Edit Profile</a><br>
<a href="dashboard.php">Back to Dashboard</a>
