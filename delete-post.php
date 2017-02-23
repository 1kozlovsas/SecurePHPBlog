<?php
session_start();
include('requires/header.php');
include ('requires/database-preamble.php');

$res = pg_query_params($db, 'SELECT username FROM posts where id = $1', [$_POST['id']]);
$line = pg_fetch_row($res);
if($line[0] !== $LS->getUser("username")){
    //User is trying to delete someone elses posts!
    header("Location: edit-posts.php");
    die();
}

pg_prepare($db, "deletePost","DROP posts WHERE id = $1");

pg_execute($db, "deletePost", array($_POST['id']));

//echo $_POST['post-html'];

include('requires/footer.php');
header("Location: view-posts.php?username=".$LS->getUser("username"));
die();
?>
