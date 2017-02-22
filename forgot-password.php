<?php
session_start();
include ('requires/header.php');
$token = $_GET['token'];
$dbname = "";
$user = "";
$password = "";

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
          $change_password = $LS->changePassword($new_password);
          if($change_password === true){
            echo "<h2>Password Changed Successfully</h2>";
          }
        }
      }else{
        echo "<p><h2>Password Fields was blank</h2><p>Form fields were left blank</p></p>";
      }
    }
    ?>

    <form action="<?php echo $LS->curPageURL();?>" method='POST'>
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