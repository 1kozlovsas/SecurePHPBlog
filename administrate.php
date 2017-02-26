<?php
session_start();
$_SESSION['old_page'] = 'administrate.php';
include('requires/header.php');
//User has logged in, but hasn't yet been authenticated as an admin
if($LS->getUser("role") !== "admin"){
    //User is logged in, but isn't an admin. Send them home.
    //Sending them to login.php led to a redirect loop
    header('Location: index.php');
    die("YOU ARE NOT ADMIN LEAVE THIS PLACE MORTAL");
}
//If code below is executing then user can see page, i.e. successful login.
//Make sure to clear the redirect var.
$_SESSION['old_page'] = ''; 
?>
<h1>Welcome, Administrator.</h1>
<br>
<h2>Your command list awaits.</h2>
<form action = "manage-account.php" method="POST">
	<input type="text" name="username">Edit a user's profile
	<input type="submit" name="submit">
</form>
<br>
<form action = "create-account.php" method="POST">
	<input type="submit" name="submit">Create a new user
</form>
<br>
<form action = "view-users.php" method="POST">
	<input type="submit" name="submit">Check out a list of users
</form>
<br>
<form action="delete-account.php">
	<input type="text" name="username">Username to delete
	<input type="submit" name="submit">Delete
</form>
	
<?php
include('requires/footer.php');
?>
