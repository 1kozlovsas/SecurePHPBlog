<?php
session_start();
include('requires/header.php');
?>

      
        <form action="logintester.php" method="POST" style="margin:0px auto;display:table;">
          <label>
            <p>Username / E-Mail</p>
            <input name="login" type="text"/>
          </label><br/>
          <label>
            <p>Password</p>
            <input name="password" type="password"/>
          </label><br/>
          <label>
            <p>
              <input type="checkbox" name="remember_me"/> Remember Me
            </p>
          </label>
          <div clear></div>
          <button style="width:150px;" name="action_login">Log In</button>
        </form>
<?php
include ('requires/footer.php');
?>