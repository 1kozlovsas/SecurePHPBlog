<?php
session_start();
include ('requires/header.php');
?>
<?php		
$dbname = "";
$user = "";
$password = "";
$username = $_SESSION['username'];
$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
$db = pg_connect($connect);
pg_prepare($db, "query1","DELETE FROM users WHERE username = $1");
pg_prepare($db, "query2","DELETE FROM posts WHERE username = $1");
//$result = pg_prepare($db, "query3","SELECT uid FROM user_devices WHERE username = $1");

//$result = pg_execute($db, "query3", array("$username"));

pg_prepare($db, "query3", "DELETE FROM user_devices AND user_tokens WHERE uid = $1");
pg_execute($db, "query3", array("$LS->getUser("id")"));
pg_execute($db, "query1", array("$username"));
pg_execute($db, "query2", array("$username"));
?>


<?php
pg_close($db);
include ('requires/footer.php');
?>
