<?php
require "requires/config.php";
if(isset($_POST['action_login'])){
	$identification = $_POST['login'];
	$password = $_POST['password'];
	if($identification == "" || $password == ""){
		$msg = array("Error", "Username / Password Wrong !");
	}else{
		$login = $LS->login($identification, $password, isset($_POST['remember_me']));
		if($login === false){
			$msg = array("Error", "Username / Password Wrong !");
		}else if(is_array($login) && $login['status'] == "blocked"){
			$msg = array("Error", "Too many login attempts. You can attempt login after ". $login['minutes'] ." minutes (". $login['seconds'] ." seconds)");
		}
	}
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/Assignment 2/">InterBlarg</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
      <!--   <form action="requires/header.php" method="POST" class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success" name="action_login">Sign in</button>
          </form> -->
 		<?php
        if(!$LS->isLoggedIn()){
          echo '<a class="navbar-brand navbar-right" href="create-account.php">Sign up</a>';
          echo '<a class="navbar-brand navbar-right" href="login.php">Login</a>';
        }
        else{
          echo '<a class="navbar-brand navbar-right" href="logout.php">Sign out</a>';
          echo '<a class="navbar-brand navbar-right" href="manage-posts.php">Blayrg!</a>';
	  echo '<a class="navbar-brand navbar-right" href="manage-account.php">Welcome '.$LS->getUser("username").'</a>';
        }
        ?>

        <?php
        	function store_in_session($key,$value)
				{
					if (isset($_SESSION))
						{
							$_SESSION[$key]=$value;
						}
				}
			function unset_session($key)
				{
					$_SESSION[$key]=' ';
					unset($_SESSION[$key]);
				}
			function get_from_session($key)
				{
					if (isset($_SESSION[$key]))
				{
					return $_SESSION[$key];
				}
					else {  
						return false; 
					}
				}
				function csrfguard_generate_token($unique_form_name)
					{
						$token = random_bytes(64); // PHP 7, or via paragonie/random_compat
						store_in_session($unique_form_name,$token);
						return $token;
					}
				function csrfguard_validate_token($unique_form_name,$token_value)
					{
						$token = get_from_session($unique_form_name);
						if (!is_string($token_value)) {
							return null;
							}
						$result = hash_equals($token, $token_value);
						unset_session($unique_form_name);
						return $result;
					}
				function csrfguard_replace_forms($form_data_html)
					{
						$count=preg_match_all("/<form(.*?)>(.*?)<\\/form>/is",$form_data_html,$matches,PREG_SET_ORDER);
						if (is_array($matches))
							{
								foreach ($matches as $m)
									{
										if (strpos($m[1],"nocsrf")!==false) 
											{ 
												continue; 
											}
										$name="CSRFGuard_".mt_rand(0,mt_getrandmax());
										$token=csrfguard_generate_token($name);
										$form_data_html=str_replace($m[0],
										"<form{$m[1]}>
										<input type='hidden' name='CSRFName' value='{$name}' />
										<input type='hidden' name='CSRFToken' value='{$token}' />{$m[2]}</form>",$form_data_html);
										}
							}
						return $form_data_html;
					}
				function csrfguard_inject()
					{	
						$data=ob_get_clean();
						$data=csrfguard_replace_forms($data);
						echo $data;
					}
				function csrfguard_start()
						{
							if (count($_POST))
								{
									if ( !isset($_POST['CSRFName']) or !isset($_POST['CSRFToken']) )
										{
											trigger_error("No CSRFName found, probable invalid request.",E_USER_ERROR);		
										} 
									$name =$_POST['CSRFName'];
									$token=$_POST['CSRFToken'];
									if (!csrfguard_validate_token($name, $token))
										{ 
											throw new Exception("NICE TRY CSRF GUY.");
										}
								}
							ob_start();
	/* adding double quotes for "csrfguard_inject" to prevent: 
          Notice: Use of undefined constant csrfguard_inject - assumed 'csrfguard_inject' */
							register_shutdown_function("csrfguard_inject");	
						}
				csrfguard_start();




        ?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
