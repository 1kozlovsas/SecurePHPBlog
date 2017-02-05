<?php
session_start();
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
$dbname = "";
$user = "";
$password = "";
$dbconn = pg_connect('host = localhost dbname='.$dbname.' user='.$user.' password='.$password)	
or die("Could not connect");	
?>	
<?php	
$res = pg_query_params($dbconn, 'SELECT username, body, created FROM posts where username = $1',[$_GET["username"]]);	
while($line = pg_fetch_all($res)){ ?>	
<tr>		
<?php foreach($line as $cell){ ?>	
<td>	
<?php echo $cell;?> 
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
