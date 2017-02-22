<?php

session_start();

$_SESSION['old_page'] = 'manage-account.php';

include('requires/header.php');

if($LS->getUser("role") === "admin"){
$_SESSION['username'] = $_POST['username'];
}
//If code below is executing then user can see page, i.e. successful login.

//Make sure to clear the redirect var.

$_SESSION['old_page'] = ''; 

?>

<h1>PROFILE INFORMATION</h1>

<?php

$target_dir = "images/".$_SESSION['username']."";

$profpic = scandir($target_dir);

echo $profpic;

?>

<img src="<?php echo $profpic ?>">



<h2>Change profile picture:</h2>

<form action="upload_avatar.php" method="post" enctype="multipart/form-data">

    Select image to upload (NO FUNNY BUSINESS):

    <input type="file" name="fileToUpload" id="fileToUpload">

    <input type="submit" value="I solemnly swear that I am uploading an image" name="submit">

</form>

<br>

<h2>Change Name of User(NOT USERNAME)</h2>
<form action = "change-name.php" method="POST">

		<label>
			<input type="text" name="new_name">Enter name you wish to change your name to.
		</label>
	 	<input type="submit" value="Change name pls" name="submit">
</form>

<br>
<h2>Delete account(In case of leaked emails)</h2>
<form action = "delete.php" method="POST">

		<label>

          <input type = "submit" name="delete">Delete your account.</button>

        </label>

</form>

<br>

<h2>Change password(I recommend hunter2)</h2>
<form action = "change-password.php" method="POST">

		<label>
			<input type="text" name="old_pass">Enter your current password.
		</label>
		<label>
			<input type="text" name="new_pass">Enter your new password. It can be the same, but I wouldn't recommend it.
		</label>
		 <input type="submit" value="Change password pls" name="submit">

</form>


<?php

include('requires/footer.php');

?>
