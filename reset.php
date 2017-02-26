<?php
session_start();
include ('requires/header.php');
	
if(isset($_POST["action_reset"])){
    $username= $_POST['username'];
    $token = $LS->rand_string(25);
    $id = $LS->getUID($username);
    $active = $LS->getUser("active", $id);
    if($active){
        include ('requires/database-preamble.php');
        pg_prepare($db, "query1","UPDATE users SET activation_token = $1 WHERE username = $2");
        pg_execute($db, "query1", array($token, $username));
        error_log($username.": 192.168.199.151/Assignment 2/activate.php?token=".$token);
    }
    header("Location: login.php");
    die();
}
?>
 <form action="reset.php" method="POST" style="margin:0px auto;display:table;">
          <label>
            <p>Username / E-Mail</p>
            <input name="username" type="text"/>
          </label><br/>
          <button style="width:150px;" name="action_reset">Reset Password</button>
        </form>
<?php
pg_close($db);
include ('requires/footer.php');
?>
