<?php

session_start();

$_SESSION['old_page'] = 'manage-account.php';

include('requires/header.php');

//If code below is executing then user can see page, i.e. successful login.

//Make sure to clear the redirect var.

$_SESSION['old_page'] = ''; 
$_SESSION['username'] = $LS->getUser("username");

?>

<h1>PROFILE INFORMATION</h1>

<?php

$target_dir = "images/".$_SESSION['username']."";

$profpic = array_diff(scandir($directory), array('..', '.'));//need to account for "." and ".." entries


?>

<img src="<?php echo $profpic ?>">



<h2>Change profile picture:</h2>

<form action="upload_avatar.php" method="post" enctype="multipart/form-data">

    Select image to upload (NO FUNNY BUSINESS):

    <input type="file" name="fileToUpload" id="fileToUpload">

    <input type="submit" value="I solemnly swear that I am uploading an image" name="submit">

</form>

<br>

<form action = "delete.php" method="POST">

		<label>

          <button name="delete">Delete your account.</button>

        </label>

</form>



<?php

include('requires/footer.php');

?>
