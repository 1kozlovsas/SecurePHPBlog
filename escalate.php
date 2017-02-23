<?php
session_start();
include ('requires/header.php');
if($LS->getUser("role") !== "admin"){
    //User is logged in, but isn't an admin. Send them home.
    //Sending them to login.php led to a redirect loop
    header('Location: index.php');
    die("YOU ARE NOT ADMIN LEAVE THIS PLACE MORTAL");
}
else{
$username= $_POST['username'];
}
?>
<?php		
include ('requires/database-preamble.php');
pg_prepare($db, "query1","UPDATE TABLE users SET role = 'admin' WHERE username = $1");
pg_execute($db, "query1", array($username));

?>


<?php
pg_close($db);
include ('requires/footer.php');
?>
