<?php
//session_start();
//include('requires/header.php');
?>
      <?php
      $two_step_login_active = false;
      if($LS->twoStepLogin() === false && isset($_POST['action_login'])){
        $identification = $_POST['login'];
        $password = $_POST['password'];
        if($identification == "" || $password == ""){
        }
        else{
            if($LS->getActivationStatus($identification)){
                echo "User is activated!";
            }
            else{
                echo "User is not activated!";
            }
            echo "<br>";
            echo print($LS->getActivationStatus($identification));
            echo "<br>";
            echo "<h2>Error</h2><p>Username hasn't been activated!</p>";
        }
      }
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