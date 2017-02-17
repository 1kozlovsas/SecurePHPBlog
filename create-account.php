<?php
session_start();
include('requires/header.php');
?>

 <h1>Create an account on our blog!</h1>  
 <br>
<div class="content">
      <h1>Register</h1>
      <form action="create-account.php" method="POST">
        <label>
          <input name="username" placeholder="Username" />
        </label>
        <label>
          <input name="email" placeholder="E-mail" /> 
        </label>
        <label>
          <input name="pass" type="password" placeholder="Password" />
        </label>
        <label>
          <input name="retyped_password" type="password" placeholder="Retype Password" />
        </label>
        <label>
          <input name="name" placeholder="Name" />
        </label>
        <label>
          <button name="submit">Register</button>
        </label>
      </form>
      <?php
      if( isset($_POST['submit']) ){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $retyped_password = $_POST['retyped_password'];
        $name = $_POST['name'];
        if( $username == "" || $email == "" || $password == '' || $retyped_password == '' || $name == '' ){
            echo "<h2>Fields Left Blank</h2>", "<p>Some Fields were left blank. Please fill all fields.</p>";
        }elseif( !$LS->validEmail($email) ){
            echo "<h2>E-Mail Is Not Valid</h2>", "<p>The e-mail you have entered is not valid</p>";
        }elseif( !ctype_alnum($username) ){
            echo "<h2>Invalid Username</h2>", "<p>Your username is not valid. Only alphanumeric characters are allowed.</p>";
        }elseif($password != $retyped_password){
            echo "<h2>Passwords Don't Match</h2>", "<p>The passwords you entered didn't match</p>";
        }else{
          $createAccount = $LS->register($username, $password,
            array(
              "email" => $email,
              "name" => $name,
              "created" => date("Y-m-d H:i:s") // Just for testing
            )
          );
          if($createAccount === "exists"){
            echo "<label>User already exists.</label>";
          }elseif($createAccount === true){
            echo "<label>Success. Created account. <a href='login.php'>Log in</a></label>";
                if(!mkdir(__DIR__."/images/".$username."/")){
                    header("HTTP/1.0 500 Permission denied.");
                    return;
                }
              copy(__DIR__."/profiletemp.jpg", __DIR__."/images/".$username."/profiletemp.jpg");
          }
        }
      }
      ?>
      <style>
        label{
          display: block;
          margin-bottom: 5px;
        }
      </style>
    </div>
<?php
include ('requires/footer.php');
?>
