<?php

session_start();

include('requires/header.php');

if(!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
	unset($_SESSION['token']);         
    } else {
	//if invalid token is provided.
        die("CSRF DETECTED CSRF DETECTED");
    }
}
else{
	die("CSRF DETECTED CSRF DETECTED");
}

if(isset($_POST['change_profile'])){
      if(isset($_POST['profile'])){          
          $LS->updateUser(array(
            "profile" => $_POST['profile']
            )
          );
        }
    }

header("Location: manage-account.php");
die();
