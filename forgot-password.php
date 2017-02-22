<?php
session_start();
include ('requires/header.php');
if(!isset($_GET['token'])){
    header("Location: index.php");
    die();
}
$token = $_GET['token'];
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
$db = pg_connect($connect);
?>

<?php
    if(isset($_POST['change_password'])){
      if(isset($_POST['new_password']) && $_POST['new_password'] != "" && isset($_POST['retype_password']) && $_POST['retype_password'] != ""){
          
        $new_password = $_POST['new_password'];
        $retype_password = $_POST['retype_password'];
          
        if($new_password != $retype_password){
          echo "<p><h2>Passwords Doesn't match</h2><p>The passwords you entered didn't match. Try again.</p></p>";
        }else{
          $newhash = password_hash($_POST['new_password'].$LS->config['keys']['salt'], PASSWORD_DEFAULT);
          pg_prepare($db, "updatePassword", "UPDATE users SET password =".$newhash." WHERE activation_token = $1");
          pg_prepare($db, "deleteActivation", "UPDATE users SET activation_token = '' WHERE  activation_token = $1");
          $success = pg_execute($db, "updatePassword", array($token));
          //$change_password = $LS->changePassword($new_password);
          if($success !== false){
            pg_execute($db, "deleteActivation", array($token));
            header("Location: login.php");
            die();
          }
        }
      }else{
        echo "<p><h2>Password Fields was blank</h2><p>Form fields were left blank</p></p>";
      }
    }
    ?>

    <form action="forgot-password.php" method='POST'>
      <label>
        <p>New Password</p>
        <input type='password' name='new_password' />
      </label>
      <label>
        <p>Retype New Password</p>
        <input type='password' name='retype_password' />
      </label>
      <button style="display: block;margin-top: 10px;" name='change_password' type='submit'>Change Password</button>
    </form>

<?php
pg_close($db);
include ('requires/footer.php');
?>