<?php
session_start();
include ('requires/header.php');
if($LS->getUser("role") !== "admin"){
header('Location: login.php');
die("YOU ARE NOT ADMIN LEAVE THIS PLACE MORTAL");
}
else{
$username= $_POST['username'];
}
?>
<?php		
$dbname = "";
$user = "";
$password = "";
$username = $LS->getUser("username");
$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
$db = pg_connect($connect);
pg_prepare($db, "query1","UPDATE TABLE users SET role = 'admin' WHERE username = $1");
pg_execute($db, "query1", array($username));

?>


<?php
pg_close($db);
include ('requires/footer.php');
?>