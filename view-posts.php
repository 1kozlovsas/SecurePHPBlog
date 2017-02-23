<?php
session_start();
include('requires/header.php');
if(!isset($_GET["username"])){
    header("Location: view-users.php");
    die();
}
$username = $_GET["username"];

include ('requires/database-preamble.php');
$detailset = pg_query_params($db, 'SELECT name, profile FROM users WHERE username = $1 ORDER BY id DESC', [$username]);	

$details = pg_fetch_row($detailset);    
    
$res = pg_query_params($db, 'SELECT username, body, created FROM posts WHERE username = $1 ORDER BY id DESC', [$username]);	

$avatar_dir = "images/".$username."/avatar";

$profpic = scandir($avatar_dir);

?>

<link rel="stylesheet" href="css/blog.css"> <!-- Limits image size -->      
<center>
<h1><?php echo $details[0];?>'s Blog</h1>

<table style="width: 85%;">
<div style="background-color: #eeeeee; border-style:solid; border-width: 2px; width: 85%;">	
Welcome to <?php echo $details[0];?>'s blog!
<br>
<img src="images/<?php echo $username;?>/avatar/<?php echo $profpic[2];?>" style="background-color: #ffffff; border-style:solid; border-width: 1px">
<br>
<?php echo nl2br($details[1]);?>
</div>
</table>
<br>
       
<table style="width: 85%;">		

		

<?php	
while($line = pg_fetch_row($res)){ ?>
<tbody>
<tr>		
<td style="background-color: #eeeeee; border-style:solid; border-width: 2px">
<div>
<?php echo $line[1];?>
</div>
<div style="background-color: #eeeeee; border-style:solid; border-width: 0px">	
<center>
    <img src="images/<?php echo $username;?>/avatar/<?php echo $profpic[2];?>" style="background-color: #ffffff; border-style:solid; border-width: 1px">
    <br>
    Posted by <?php echo $line[0];?> at <?php echo $line[2];?> 
</center>
</div>
</td>			
</tr>
</tbody> 
<?php		
}	
?>	


</table>
</center>

<!--
<link rel="stylesheet" href="css/blog.css">     
<center>
<h1>{name}'s Blog</h1>

<table style="width: 85%;">
<div style="background-color: #eeeeee; border-style:solid; border-width: 2px">	
Welcome to {name}'s blog!
<br>
<img src="images/blobid1487276403551.png" style="background-color: #ffffff; border-style:solid; border-width: 1px">
<br>
{profile}
</div>
</table>
<br> 
    
<table style="width: 85%;">

<div style="background-color: #eeeeee; border-style:solid; border-width: 2px">	
<tbody>		
<tr>		
<td>	
    <p>!!!Create a nonce for this form!!!</p>
    <p><img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Pleiades_large.jpg" alt="original.jpg (335&times;352)" /></p>
    <p>fgsfds</p>
    <p>&nbsp;</p>
</td>				
</tr>	
</tbody>
<div style="background-color: #eeeeee; border-style:solid; border-width: 0px">	
<center>
    <img src="images/blobid1487276403551.png" style="background-color: #ffffff; border-style:solid; border-width: 1px">
    <br>
    Posted by test at 2017-02-07 21:16:09 
</center>
</div>
</div>
</table>
</center>-->

<?php
include ('requires/footer.php');
?>
