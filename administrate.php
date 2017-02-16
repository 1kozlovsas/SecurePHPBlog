<?php
session_start();
$_SESSION['old_page'] = 'administrate.php';
include('requires/header.php');
//User has logged in, but hasn't yet been authenticated as an admin
if($LS->getUser("role") !== "admin")
header('Location: /manage-posts.php');
die();
//If code below is executing then user can see page, i.e. successful login.
//Make sure to clear the redirect var.
$_SESSION['old_page'] = ''; 
?>
<?php
include('requires/footer.php');
?>