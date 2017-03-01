<?php
session_start();
include('requires/csrf.php');
include("requires/header.php");
?>
<?php
    if(isset($_POST['change_password'])){
      if(isset($_POST['current_password']) && $_POST['current_password'] != "" && isset($_POST['new_password']) && $_POST['new_password'] != "" && isset($_POST['retype_password']) && $_POST['retype_password'] != "" && isset($_POST['current_password']) && $_POST['current_password'] != ""){
          
        $curpass = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $retype_password = $_POST['retype_password'];
        $id = $_SESSION['id'];
          
        if($new_password != $retype_password){
          $_SESSION['passfail'] =  "<p><h2>Passwords Don't match</h2><p>The passwords you entered didn't match. Try again.</p></p>";
        }else if($LS->login($LS->getUser("username", $id), $curpass, false, false) == false){
          $_SESSION['passfail'] = "<h2>Current Password Wrong!</h2><p>The password you entered for your account is wrong.</p>";
        }else{
          $change_password = $LS->changePassword($new_password, $id);
          if($change_password === true){
            $_SESSION['passfail'] = "<h2>Password Changed Successfully</h2>";
          }
        }
      }else{
        $_SESSION['passfail'] = "<p><h2>Password Field was blank</h2><p>Form fields were left blank</p></p>";
      }
    }
    ?>
    
<?php
include("requires/footer.php");
header("Location: manage-account.php");
die();
?>