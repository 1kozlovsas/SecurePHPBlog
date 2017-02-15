<?php
/**
 * For Development Purposes
 */
ini_set("display_errors", "on");

require __DIR__ . "/LS.php";
$LS = new \Fr\LS(array(
  "db" => array(
    "type" => "postgresql",
    "host" => "localhost",
    "port" => 5432,
    "username" => "postgres",
    "password" => "postgres",
    "name" => "postgres",
    "table" => "users"
  ),
  "features" => array(
    "auto_init" => true
  ),
  "pages" => array(
    "no_login" => array(
      "/Assignment 2/",
      "/Assignment 2/view-users.php",
      "/Assignment 2/view-recent.php",
      "/Assignment 2/view-posts.php",
      "/Assignment 2/create-account.php",
      "/Assignment 2/index.php"
    ),
    "everyone" => array(
      "/examples/basic/status.php"
    ),
    "login_page" => "/Assignment 2/login.php",
    "home_page" => isset($_SESSION['current_page'])?$_SESSION['current_page']:"/Assignment 2/index.php"
  )
));
