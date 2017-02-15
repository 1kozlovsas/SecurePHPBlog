<?php
include('requires/header.php');
?>

 <h1>Create an account on our blog!</h1>  
 <br>
 <h2>Form to create a new user is below.</h2>  
 <form action="submit.php" method="POST">  
 <input name="username" type="text">Username<br>
 <input type="text" name="email">Email<br>  
 <input type="password" name="password">Password<br> 
 <input type="submit" value="Submit">  
 </form>
<?php
include ('requires/footer.php');
?>
