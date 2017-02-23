<?php
session_start();
$_SESSION['old_page'] = 'edit-posts.php';
include('requires/header.php');
?>

<h1>LIST OF DETAILS:</h1>	
<table>		
<thead>			
<tr>				
<td>Username</td>				
<td>Post:</td>				
<td>Created on:</td>		
</tr>		
</thead>	
<tbody>		

<?php	
include ('requires/database-preamble.php');
$res = pg_query_params($db, 'SELECT username, body, created FROM posts where username = $1',[$_GET["username"]]);	
while($line = pg_fetch_row($res)){ ?>	
<tr>		
<?php foreach($line as $cell){ ?>	
<td>	
<?php print_r($cell);?> 
</td>			
<?php
}	
?> 	
</tr>	
<?php		
}	
?>	
</tbody>	
</table>
<?php
include ('requires/footer.php');
?>
