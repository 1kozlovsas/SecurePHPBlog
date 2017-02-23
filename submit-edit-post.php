<?php
session_start();
include('requires/header.php');

include ('requires/database-preamble.php');
pg_prepare($db, "editPost","UPDATE posts SET (body, created) = ($1, $2) WHERE id = $3");

pg_execute($db, "editPost", array($_POST['post-html'], date("Y-m-d H:i:s"), $_POST['id']));

//echo $_POST['post-html'];

include('requires/footer.php');
header("Location: edit-posts.php");
die();
?>
