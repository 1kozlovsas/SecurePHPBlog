<?php
session_start();
include ('requires/header.php');
if($LS->getUser("role") !== "admin"){
header('Location: login.php');
die("YOU ARE NOT ADMIN LEAVE THIS PLACE MORTAL");
}
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
