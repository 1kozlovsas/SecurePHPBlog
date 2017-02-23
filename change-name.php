<?php
session_start();
include ('requires/header.php');
?>
<?php		
$dbname = "postgres";
$user = "postgres";
$password = "postgres";
$username = $LS->getUser("username");
$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
$db = pg_connect($connect);
pg_prepare($db, "query1","UPDATE users SET name = $1 WHERE username = $2");
pg_execute($db, "query1", array("$_POST[new_name]", "$username"));

?>


<?php
pg_close($db);
include ('requires/footer.php');
?>