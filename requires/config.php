<?php
/**
 * For Development Purposes
 */
ini_set("display_errors", "on");

require __DIR__ . "/LS.php";
$LS = new \Fr\LS(array(
  "db" => array(
    "type" => "mysql",
    "host" => "158.85.107.106",
    "port" => 3306,
    "username" => "blog_admin",
    "password" => "Qh2v1?7o",
    "name" => "blog_base",
    "table" => "users"
  ),
  "features" => array(
    "auto_init" => true,
    "start_session" => false
  ),
  "keys" => array(
    "cookie" => "jj89j*J*(J(*JH98h98h9)&(*H(&H)))",
    "salt" => "s43s4zy5ydi76fo87go87ilyHTE^U$"
  ),
  "brute_force" => array(
    "tries" => "10"
  ),
  "pages" => array(
    "no_login" => array(
    ),
    "everyone" => array(
      "/Assignment%202/",
      "/Assignment%202/view-users.php",
      "/Assignment%202/view-recent.php",
      "/Assignment%202/view-posts.php",
      "/Assignment%202/create-account.php",
      "/Assignment%202/index.php",
      "/Assignment%202/forgot-password.php",
      "/Assignment%202/activate.php",
      "/Assignment%202/reset.php"
    
    ),
    "login_page" => "/Assignment%202/login.php",
    "home_page" => isset($_SESSION['old_page'])?
    "/Assignment%202/".$_SESSION['old_page']:
    "/Assignment%202/manage-posts.php"
  )
));
