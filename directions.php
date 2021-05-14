<?php
define('SITE', 1);
define('SITE_ROOT', './');
define('PAGE_TITLE', 'Направления');
require SITE_ROOT . 'includes/header.php';
?>

  <section>

    <p>В нашей студии существует несколько направлений тренировок. Выбирайте себе по душе!</p>

    <?php

$query = mysqli_query($link, "SELECT * FROM `direction`");
$res = "";
while($row = mysqli_fetch_assoc($query)) {

    $res .= '<h2 class="sub-header">' . $row['name'] . '</h2>'."\n";

    $res .= "<p>" . $row['desc'] . "</p>\n";
    if ($row['photo'])
        $res .= '<br /><img src="' . $row['photo'] . '" width="95%" alt="Фото '. $row['name'] . '" />'."\n";
}
echo $res;
    ?>

  </section>

<?php
require SITE_ROOT . 'includes/footer.php';
?>
