<?php
session_start();
include ('requires/header.php');
include('requires/csrf.php');
include ('requires/database-preamble.php');
pg_prepare($db, "query1","UPDATE users SET name = $1 WHERE username = $2");
pg_execute($db, "query1", array($_POST["new_name"], $_SESSION["username"]));
pg_close($db);
include ('requires/footer.php');
header("Location: manage-account.php");
die();
?>