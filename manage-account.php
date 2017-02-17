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
$profpic = scandir($target_dir);
//$profpic = array_diff(scandir($target_dir), array('..', '.'));//need to account for "." and ".." entries
echo "<b><h1><center>Oh shit, waddap?!</center></h1></b>";
echo "<img src=".$target_dir."/".$profpic[2]." width=\"125\" height=\"125\">";
?>





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
