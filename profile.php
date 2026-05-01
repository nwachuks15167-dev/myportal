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

<?php if ($user['image']) { ?>
    <img src="uploads/<?php echo $user['image']; ?>" width="120">
<?php } ?>

<!-- Upload form -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <button type="submit">Upload Profile Image</button>
</form>  