<?php
session_start();
include('requires/header.php');
include ('requires/database-preamble.php');
$res = pg_query($db, 'SELECT username, body, created FROM posts ORDER BY id DESC LIMIT 10');	
?>

<link rel="stylesheet" href="css/blog.css"> <!-- Limits image size -->      
<center>
<h1>Recent Posts!</h1>


       
<table style="width: 85%;">		


<?php	
while($line = pg_fetch_row($res)){ 
    $avatar_dir = "images/".$line[0]."/avatar";
    $profpic = scandir($avatar_dir);
?>
<tbody>
<tr>		
<td style="background-color: #eeeeee; border-style:solid; border-width: 2px">
<div>
<?php echo $line[1];?>
</div>
<div style="background-color: #eeeeee; border-style:solid; border-width: 0px">	
<center>
<?php
    if(sizeof($profpic) > 2){
    echo '<img src="images/'.$line[0].'/avatar/'.$profpic[2].'" style="background-color: #ffffff; border-style:solid; border-width: 1px">';
                     }
else{
    echo '<img src="profiletemp.jpg" style="max-width:250px; max-height:250px">';
}
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
