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
      "/",
      "/examples/basic/reset.php",
      "/examples/basic/register.php"
    ),
    "everyone" => array(
      "/examples/basic/status.php"
    ),
    "login_page" => "/examples/basic/login.php",
    "home_page" => "/examples/basic/home.php"
  )
));
