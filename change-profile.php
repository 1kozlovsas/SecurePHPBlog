<?php

session_start();
include('requires/csrf.php');

include('requires/header.php');

if(isset($_POST['change_profile'])){
      if(isset($_POST['profile'])){          
          $LS->updateUser(array(
            "profile" => $_POST['profile']),
                          ,
            $_SESSION['id']
          );
        }
    }

header("Location: manage-account.php");
die();
