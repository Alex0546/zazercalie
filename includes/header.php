<?php
if (!defined('SITE')) exit;
define('SITE_ROOT', '../');
require SITE_ROOT . 'includes/common.php';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php echo defined('PAGE_TITLE') ? PAGE_TITLE . " — " . SITE_TITLE : SITE_TITLE ?></title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="/css/style.css?v=25" />
        <script type="text/javascript" src="https://ajax.​googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body>
        <header>
            <a href="/">
                <h1>
                    <img src="/img/logoMainB.png" width="150" alt="Логотип студии" />
                    <?php echo SITE_TITLE . "\n"; ?>
                </h1>
            </a>
        </header>

<?php
include(SITE_ROOT . 'includes/menu.php');
?>
