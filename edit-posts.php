<?php
session_start();
include('requires/header.php');

$username = $LS->getUser("username");

include ('requires/database-preamble.php');
$detailset = pg_query_params($db, 'SELECT name, profile FROM users WHERE username = $1 ORDER BY id DESC', [$username]);	

$details = pg_fetch_row($detailset);    
    
$res = pg_query_params($db, 'SELECT id, username, body, created FROM posts WHERE username = $1 ORDER BY id DESC', [$username]);	

$avatar_dir = "images/".$username."/avatar";

$profpic = scandir($avatar_dir);

?>

<link rel="stylesheet" href="css/blog.css"> <!-- Limits image size -->      
<center>
<h1>Manage Blog</h1>
<br>
       
<table style="width: 85%;">		

		

<?php	
while($line = pg_fetch_row($res)){ ?>
<tbody>
<tr>		
<td style="background-color: #eeeeee; border-style:solid; border-width: 2px">
<div>
<?php echo $line[2];?>
</div>
<div style="background-color: #eeeeee; border-style:solid; border-width: 0px">	
<center>
    <img src="images/<?php echo $username;?>/avatar/<?php echo $profpic[2];?>" style="background-color: #ffffff; border-style:solid; border-width: 1px">
    <br>
    Posted by <?php echo $line[1];?> at <?php echo $line[3];?> 
</center>
</div>
<div>
            <a href="edit-post.php?id=<?php echo $line[0];?>">                
            <button type="button" class="btn btn-success btn-lg btn-block">Edit Post
            </button>                
            </a>  
            <a href="delete-post.php?id=<?php echo $line[0];?>">                
            <button type="button" class="btn btn-danger btn-lg btn-block">Delete Post
            </button>                
            </a>  
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
