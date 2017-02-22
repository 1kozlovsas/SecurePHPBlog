<?php
session_start();
include('requires/header.php');
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
pg_prepare($db, "updateActivation","UPDATE users SET active = TRUE WHERE  activation_token = $1");
pg_prepare($db, "deleteActivation","UPDATE users SET activation_token = "" WHERE  activation_token = $1");
pg_execute($db, "updateActivation", array($token));
pg_execute($db, "deleteActivation", array($token));

?>

<?php
pg_close($db);
include ('requires/footer.php');
?>