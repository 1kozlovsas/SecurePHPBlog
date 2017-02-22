<?php
session_start();
include('requires/header.php');
?>
    <div class="content">
      <?php
      $two_step_login_active = false;
      if($LS->twoStepLogin() === false && isset($_POST['action_login'])){
        $identification = $_POST['login'];
        $password = $_POST['password'];
        if($identification == "" || $password == ""){
          $msg = array("Error", "Username / Password Wrong !");
        }elseif($LS->userExists($identification) && $LS->getActivationStatus($identification) === false){
            echo "<h2>Error</h2><p>Username hasn't been activated!</p>";
        }else{
          $login = $LS->twoStepLogin($identification, $password, isset($_POST['remember_me']));
          if($login === false){
            echo "<h2>Error</h2><p>Username / Password Wrong !</p>";
          }else if(is_array($login) && $login['status'] == "blocked"){
            echo "<h2>Error</h2><p>Too many login attempts. You can attempt login after ". $login['minutes'] ." minutes (". $login['seconds'] ." seconds)</p>";
          }else{
            $two_step_login_active = true;
          }
        }
      }
      if(!$two_step_login_active){
      ?>
        <form action="login.php" method="POST" style="margin:0px auto;display:table;">
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
      }
      ?>
      <style>
        input[type=text], input[type=password]{
          width: 230px;
        }
      </style>
      <p>
        <p>Don't have an account?</p>
        <a class="button" href="create-account.php">Register</a>
      </p>
      <p>
        <p>Forgot Your Password?</p>
        <a class="button" href="reset.php">Reset Password</a>
      </p>
    </div>
<?php
include ('requires/footer.php');
?>
