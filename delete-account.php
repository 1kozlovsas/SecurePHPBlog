<?php
function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  } 

session_start();
include ('requires/header.php');
if($LS->getUser("role") === "admin"){
//Username is either sent by POST, SESSION, or
//is set to the administrators name.
$username = isset($_POST["username"])?$_POST["username"]:(isset($_SESSION["username"])?$_SESSION["username"]:$LS->getUser("username"));
}
else{
	$username = $LS->getUser("username");
}




include ('requires/database-preamble.php');
pg_prepare($db, "query1","DELETE FROM posts WHERE username = $1");
pg_prepare($db, "query2","DELETE FROM users WHERE username = $1");
pg_prepare($db, "query3", "DELETE FROM user_devices WHERE uid = $1");
pg_prepare($db, "query4", "DELETE FROM user_tokens WHERE uid = $1");
pg_execute($db, "query1", array($username));
pg_execute($db, "query2", array($username));
pg_execute($db, "query3", array($LS->getUser("id")));
pg_execute($db, "query4", array($LS->getUser("id")));

delTree("images/".$username."/");

    
pg_close($db);
include ('requires/footer.php');
$LS->logout();
header("Location: index.php");
die();
?>
