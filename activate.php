<?php
session_start();
include('requires/csrf.php');
include('requires/header.php');

if(!isset($_GET['token'])){
    header("Location: index.php");
    die();
}

$token = $_GET['token'];
include ('requires/database-preamble.php');

pg_prepare($db, "updateActivation","UPDATE users SET active = TRUE WHERE  activation_token = $1");
pg_prepare($db, "deleteActivation","UPDATE users SET activation_token = '' WHERE  activation_token = $1");
pg_execute($db, "updateActivation", array($token));
pg_execute($db, "deleteActivation", array($token));

?>

<?php
include ('requires/footer.php');
pg_close($db);
header("Location: login.php");
die();
?>