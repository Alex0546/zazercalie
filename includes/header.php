<?php 
if (!defined('SITE')) exit;
define('SITE_ROOT', '../');
require SITE_ROOT . 'includes/common.php';
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <header>

      <h1><img src="/img/logoMainB.png" width="150" alt="Логотип студии">Студия воздушного танца</h1>

    </header>

<?php
include(SITE_ROOT . 'includes/menu.php');
?>
