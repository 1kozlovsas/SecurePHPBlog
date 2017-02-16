<?php
session_start();
$_SESSION['old_page'] = 'manage-posts.php';
include('requires/header.php');
//If code below is executing then user can see page, i.e. successful login.
//Make sure to clear the redirect var.
$_SESSION['old_page'] = ''; 
?>

<center><h2>
<a href="new-post.php">Create a new post!</a>
<br><br>
<a href="edit-posts.php">Edit or delete previous posts.</a>
</h2></center>

<?php
include('requires/footer.php');
?>