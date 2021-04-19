<?php if (!defined('SITE')) exit; ?>

        <nav>
            <ul>
<?php
$menu = [
    "Тренеры" => "/trainers.php",
    "Расписание" => "/timetable.php",
    "Главная" => "/index.php",
    "Направления" => "/directions.php",
    "Документация" => "/documents.php"
];
$res = "";
$current = $_SERVER['REQUEST_URI'];
foreach ($menu as $item => $url) {
    $res .= "\t\t\t\t<li" . (strpos($current, $url) === 0 || $current == '/' && $url == '/index.php' ? ' class="active"' : '')
        . '><a href="' . $url . '">' . $item . "</a></li>\n";
}
echo $res;
?>
            </ul>
        </nav>