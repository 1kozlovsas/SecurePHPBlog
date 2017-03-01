<?php

session_start();

$_SESSION['old_page'] = 'manage-account.php';



include('requires/header.php');

$username = $LS->getUser("username");
    
if($LS->getUser("role") === "admin"){
	$username = !empty($_POST['username'])?$_POST['username']:(!empty($_SESSION['username'])?$_SESSION['username']:$LS->getUser("username"));
}

$id = $LS->getUID($username);


if(is_null($id)){
    //admin probably entered a bad username.
    //If a standard user doesn't have an id somehow
    //this will cause a redirect loop.
    header("Location: administrate.php");
    die();
}



//If code below is executing then user can see page, i.e. successful login.

//Make sure to clear the redirect var.

$_SESSION['old_page'] = ''; 
$_SESSION['username'] = $username;
$_SESSION['id'] = $id;
?>

<h1>PROFILE INFORMATION</h1>

<?php

$target_dir = "images/".$username."/avatar";

$profpic = scandir($target_dir);

//echo $profpic;
if(sizeof($profpic) > 2){
echo '<img src="'.$target_dir.'/'.$profpic[2].'" style="max-width:250px; max-height:250px">';
                     }
else{
    echo '<img src="profiletemp.jpg" style="max-width:250px; max-height:250px">';
}
?>


<h2>Change profile picture:</h2>

<form action="upload_avatar.php" method="post" enctype="multipart/form-data">

    Select image to upload (NO FUNNY BUSINESS):

    <input type="file" name="fileToUpload" id="fileToUpload">

    <input type="submit" value="I solemnly swear that I am uploading an image" name="submit">
	<input type="hidden" name="token" value="<?php echo $token; ?>">
</form>
<br>
<h2>Change profile:</h2><br>
<form action="change-profile.php" method="POST">
<textarea name="profile" cols=50 rows=10><?php echo $LS->getUser("profile", $id); ?></textarea>
<button style="display: block;margin-top: 10px;" name='change_profile' type='submit'>Change Profile</button>
	<input type="hidden" name="token" value="<?php echo $token; ?>">
</form>

<br>
<h2>Change Name of User (NOT USERNAME)</h2>
<form action = "change-name.php" method="POST">

    <label>Enter name you wish to change your name to.</label><br>
    <input type="text" name="new_name" placeholder="<?php echo $LS->getUser("name", $id); ?>"><br>

	 	<input type="submit" value="Change name pls" name="submit">
	<input type="hidden" name="token" value="<?php echo $token; ?>">
</form>

<br>
<h2>Delete account (In case of leaked emails)</h2>
<form action = "delete-account.php" method="POST">
    <button type = "submit" name="delete">Delete your account</button>
	<input type="hidden" name="token" value="<?php echo $token; ?>">
</form>

<br>
    <?php echo isset($_SESSION['passfail'])?$_SESSION['passfail']:"";
          echo "<br>";
          unset($_SESSION['passfail']);
    ?>
    <form action="manage-account.php" method='POST'>
        <input type='password' name='current_password' placeholder='Current Password'/>
        <input type='password' name='new_password' placeholder='New Password'/>
        <input type='password' name='retype_password' placeholder='Retype Password'/>
      <button style="display: block;margin-top: 10px;" name='change_password' type='submit'>Change Password</button>
	    <input type="hidden" name="token" value="<?php echo $token; ?>">
    </form>


<?php

include('requires/footer.php');

?>
