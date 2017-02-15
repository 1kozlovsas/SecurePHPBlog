<!DOCTYPE html>
<html lang = "en">
<head>	 
<meta charset="utf-8">        
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">        
<title>List of Users</title>        
<meta name="description" content="">        
<meta name="viewport" content="width=device-width, initial-scale=1">        
<link rel="apple-touch-icon" href="apple-touch-icon.png">        
<link rel="stylesheet" href="css/bootstrap.min.css">        
<style>            
body {               
padding-top: 50px;                
padding-bottom: 20px;            
}        
</style>        
<link rel="stylesheet" href="css/bootstrap-theme.min.css">        
<link rel="stylesheet" href="css/main.css">        
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>	
<title>List of Users</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">      
<div class="container">        
<div class="navbar-header">          
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">            
<span class="sr-only">Toggle navigation</span>            
<span class="icon-bar"></span>            
<span class="icon-bar"></span>            
<span class="icon-bar"></span>          
</button>          
<a class="navbar-brand" href="../index.html">Home page</a>        
</div>        
<div id="navbar" class="navbar-collapse collapse">        
</div><!--/.navbar-collapse -->      
</div>    
</nav>

<h1>Pick a user. Any user. I dare you.</h1>

<table>		
<thead>			
<tr>				
	<td>Usernames:</td>			
</tr>		
</thead>		
<tbody>		 
<?php              
$db = pg_connect('host=localhost dbname= user= password=');             
$result = pg_query($query);            
if (!$result) {                
echo "Problem with query " . $query . "<br/>";                
echo pg_last_error();                
exit();            
}             
while($row = pg_fetch_assoc($result)) {                
echo '<tr>                
<td>                
<a href="userdetails.php?username='.$row['username'].'">                
<button type="button" class="btn btn-info">'.$row['username'].'
<button>                
</a>            
</tr>';            
}            
?>				
</tbody>	
</table>	
</body>
</html>
