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
    ),
    "everyone" => array(
      "/Assignment%202/",
      "/Assignment%202/view-users.php",
      "/Assignment%202/view-recent.php",
      "/Assignment%202/view-posts.php",
      "/Assignment%202/create-account.php",
      "/Assignment%202/index.php"
    ),
    "login_page" => "/Assignment%202/login.php",
    "home_page" => "/Assignment%202/manage-account.php"
  )
));
