<?php
header('Content-Type: text/html; charset=utf-8');
//define('SITE_ROOT', './');
define('SITE_TITLE', 'Студия воздушного танца');

$config_db = [
    "host" => "localhost",
    "user" => "f0538536_user",
    "pass" => "f0538536pass",
    "name" => "f0538536_db",
    "port" => "3306"
];

$link = mysqli_connect($config_db['host'], $config_db['user'], $config_db['pass']) or die('unable to connect. ' . mysqli_connect_error());
mysqli_select_db($link, $config_db['name']) or die('cannot select db');s

?>
