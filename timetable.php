<?php
define('SITE', 1);
define('SITE_ROOT', './');
define('PAGE_TITLE', 'Расписание');
require SITE_ROOT . 'includes/header.php';
?>

  <section>
    <div id="timetable">
    <?php
$query = mysqli_query($link, "SELECT tr.`name`, tr.surname, t.time, t.day_of_week, d.`name` AS dirname  FROM `timetable` AS t JOIN `direction` AS d ON t.direction_id=d.id JOIN `trainer` AS tr ON t.trainer_id=tr.id ORDER BY t.day_of_week, t.time");
$res = "";
$days = [[],[],[],[],[],[],[]];
$day_keys = ['понедельник','вторник','среда','четверг','пятница','суббота','вокресенье'];
while($row = mysqli_fetch_assoc($query)) {
    $day = (int)$row['day_of_week'];
    $days[$day - 1][] = '<div class="timetable-cell"><span class="timetable-cell_time">' . date('H:i',strtotime($row['time'])) . '</span><span class="timetable-cell_trainer">' . $row['name'] . " " . $row['surname'] . '</span><span class="timetable-cell_direction">' . $row['dirname'] . '</span></div>';
    //echo $day;
}
$res = "";
foreach ($days as $day_idx => $day_values) {
    $day_column = '<div class="timetable-column">';
    $day_column .= '<div class="timetable-header-cell">' . $day_keys[$day_idx] . '</div>';
    foreach ($day_values as $cell) {
        $day_column .= $cell;
    }
    $day_column .= '</div>';
    $res .= $day_column;
}
echo $res;
    ?>
    </div>
  </section>

<?php
require SITE_ROOT . 'includes/footer.php';
?>
