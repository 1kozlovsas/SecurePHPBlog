<?php
session_start();
include ('requires/header.php');
/*if(!isset($_SESSION['username'])){
	//User is not logged in. Send them to login page.	
	header('Location: login.php');
	die("You are not logged in!");
	
}
elseif($LS->getUser("role") !== "admin"){
    //User is logged in, but isn't an admin. Send them home.
    //Sending them to login.php led to a redirect loop
    header('Location: index.php');
    die("YOU ARE NOT ADMIN LEAVE THIS PLACE MORTAL");
}*/
//This page is public, everyone should be able
//to list the users
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
include ('requires/database-preamble.php');
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
</td>
</tr>';            
}            
?>				
</tbody>	
</table>	
<?php
include ('requires/footer.php');
?>
