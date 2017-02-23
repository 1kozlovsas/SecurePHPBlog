<?php
session_start();
include('requires/header.php');

include ('requires/database-preamble.php');
pg_prepare($db, "insertPost","UPDATE posts SET (body, date) = ($1, $2) WHERE id = $3");

pg_execute($db, "insertPost", array($_POST['post-html'], date("Y-m-d H:i:s"), $_POST['id']));

//echo $_POST['post-html'];

include('requires/footer.php');
header("Location: view-posts.php?username=".$username);
die();
?>
