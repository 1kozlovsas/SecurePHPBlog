<?php
$dbname = "";
$user = "";
$password = "";
$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
$db = pg_connect($connect);
?>