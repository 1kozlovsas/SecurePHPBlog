<<<<<<< HEAD
<?php
session_start();
include ('requires/header.php');
?>
<h1>Pick a user. Any user. I dare you.</h1>

<table>		
<thead>			
<tr>				
	<td>Usernames:</td>			
</tr>		
</thead>		
<tbody>		 
<?php
$dbname = ""
$user = ""
$password = ""
$connect = 'host=localhost dbname='.$dbname.' user='.$user.' password='.$password; 
$db = pg_connect($connect);
$query = "SELECT username FROM users";             
$result = pg_query($query);            
if (!$result) {                
echo "Problem with query " . $query . "<br/>";                
echo pg_last_error();                            
}             
while($row = pg_fetch_assoc($result)) {                
echo '<tr>                
<td>                
<a href="view-posts.php?username='.$row['username'].'">                
<button type="button" class="btn btn-info">'.$row['username'].'
</button>                
</a>            
</tr>';            
}            
?>				
</tbody>	
</table>	
<?php
include ('requires/footer.php');
?>
=======
<?php
include ('requires/header.php');
?>
<h1>Pick a user. Any user. I dare you.</h1>

<table>		
<thead>			
<tr>				
	<td>Usernames:</td>			
</tr>		
</thead>		
<tbody>		 
<?php
$dbname = "";
$user = "";
$password = "";              
$db = pg_connect('host=localhost dbname='.$dbname.'user='.$user.'password='.$password);             
$query = "SELECT username FROM users";             
$result = pg_query($query);            
if (!$result) {                
echo "Problem with query " . $query . "<br/>";                
echo pg_last_error();                            
}             
while($row = pg_fetch_assoc($result)) {                
echo '<tr>                
<td>                
<a href="view-posts.php?username='.$row['username'].'">                
<button type="button" class="btn btn-info">'.$row['username'].'
<button>                
</a>            
</tr>';            
}            
?>				
</tbody>	
</table>	
<?php
include ('requires/footer.php');
?>
>>>>>>> c35aaaf86b0a57ca175320d8217fef7dabb8e196
