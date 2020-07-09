<?php
require_once("./vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define("HOST",$_ENV['DB_HOST']);
define("USERNAME",$_ENV['DB_USERNAME']);
define("PASSWORD",$_ENV['DB_PASSWORD']);
define("DB",$_ENV['DB_NAME']);

$connection = new mysqli(HOST, USERNAME, PASSWORD, DB);

if ($connection->connect_error) {
    die('Connect Error (' . $connection->connect_errno . ') '
            . $connection->connect_error);
}

$personalToken = $_ENV['DO_PERSONAL_TOKEN'];
$authorization = "Authorization: Bearer ".$personalToken;
?>