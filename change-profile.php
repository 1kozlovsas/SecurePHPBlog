<?php

session_start();

include('requires/header.php');
include('requires/csrf.php');

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
