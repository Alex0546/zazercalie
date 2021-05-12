<?php
define('SITE', 1);
define('SITE_ROOT', './');
define('PAGE_TITLE', 'Тренеры');
require SITE_ROOT . 'includes/header.php';
?>

  <section>
    <?php

$query = mysqli_query($link, "SELECT * FROM `trainer`");
$res = "";
while($row = mysqli_fetch_assoc($query)) {
    $res .= '<h2 class="sub-header">' . $row['name'] . " " . $row['surname'] . " &mdash; <em>" . $row['desc'] . '</em></h2>'."\n";
    if ($row['photo'])
        $res .= '<img src="' . $row['photo'] . '" width="300" alt="Фото ' . $row['name'] .'" />'."\n";
    $res .= "<p>" . $row['full_desc'] . "</p>\n";
}
echo $res;
      ?>

  </section>

<?php
require SITE_ROOT . 'includes/footer.php';
?>
