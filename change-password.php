<?php
session_start();
include ('requires/header.php');
?>

<?php		
include ('requires/database-preamble.php');
pg_prepare($db, "query1","SELECT password FROM users WHERE username = $1");
$result = pg_execute($db, "query1", array("s", "$username"));
$oldpass = password_hash($_POST['old_pass'].$LS->config['keys']['salt'], PASSWORD_DEFAULT);
if($oldpass !== $result[0]){
	die("Passwords did not match.");

}
else{
$LS->changePassword($_POST['new_pass']);
}

?>


<?php
pg_close($db);
include ('requires/footer.php');
?>