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

if(!$details){
    //There is no user with this name!
    header("Location: view-users.php");
    die();
}

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

<?php
include ('requires/footer.php');
?>
