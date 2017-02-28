<?php
$dbname = "postgres";
$user = "postgres";
$password = "postgres";
$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
$db = pg_connect($connect);
?>