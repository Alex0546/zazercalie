<?php
define('SITE', 1);
define('SITE_ROOT', './');
require_once SITE_ROOT . 'includes/common.php';

if (isset($_GET['id'])) define('DIR_ID', intval($_GET['id']));
$query = mysqli_query($link, "SELECT * FROM `direction`" . (defined('DIR_ID') ? " WHERE `id`=". DIR_ID : ""));
if (mysqli_num_rows($query) > 0) define('DIR_OK', 1);
if (defined('DIR_ID') && defined('DIR_OK')) {
    $row = mysqli_fetch_assoc($query);
    define('PAGE_TITLE', 'Направления: ' . $row['name']);
} else {
    define('PAGE_TITLE', 'Направления');
}

require SITE_ROOT . 'includes/header.php';
?>

  <section>

<?php
//echo "SELECT * FROM `direction`" . (defined('DIR_ID') ? " WHERE `id`=". DIR_ID : "");
if (!defined('DIR_ID')) {
?>
    <p>В нашей студии существует несколько направлений тренировок. Выбирайте себе по душе!</p>
    <div id="main-table">

<?php

    $res = "";
    while($row = mysqli_fetch_assoc($query)) {

        $res .= "\t\t".'<div class="table-cell">'."\n\t\t\t".'<a href="/directions.php?id=' . $row['id'] . '">'."\n"
            . "\t\t\t\t".'<h2 class="sub-header">' . $row['name'] . '</h2>'."\n";

        //$res .= "<p>" . $row['desc'] . "</p>\n";
        if ($row['photo']) {
            $res .= "\t\t\t\t".'<img src="' . $row['photo'] . '" width="100%" alt="Фото '. $row['name'] . '" />'."\n";
        }

        $res .= "\t\t\t".'</a>'."\n\t\t".'</div>'."\n";
    }
    echo $res;
?>
    </div>
<?php    

?>

  </section>

<?php
require SITE_ROOT . 'includes/footer.php';
?>
