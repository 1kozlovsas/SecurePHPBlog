<?php
session_start();
include('requires/header.php');

include ('requires/database-preamble.php');
pg_prepare($db, "insertPost","INSERT INTO posts (username, body, created) VALUES ($1, $2, $3)");

pg_execute($db, "insertPost", array($username, $_POST['post-html'], date("Y-m-d H:i:s")));

//echo $_POST['post-html'];

include('requires/footer.php');
header("Location: view-posts.php?username=".$username);
die();
?>
