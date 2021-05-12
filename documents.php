<?php
define('SITE', 1);
define('SITE_ROOT', './');
define('PAGE_TITLE', 'Документация');
require SITE_ROOT . 'includes/header.php';
?>

  <section>
    <h2>Стоимость занятий</h2>
    <table width="600" border="1" cellpadding="4" cellspacing="0">
   <tr>
    <th colspan="2">Разовое занятие</th>
   </tr>
   <tr>
    <th>Пробное занятие</th><th>200</th>
   </tr>
   <tr>
    <th>Разовое заянтие</th><th>375</th>
   </tr>
   <tr>
    <th>Разовое заянтие (акробатика)</th><th>400</th>
   </tr>
   <tr>
    <th>Индивидуальное заянтие</th><th>1250</th>
   </tr>
   <tr>
    <th colspan="2">Абонементы (30 дней)</th>
   </tr>
   <tr>
    <th>4 занятия</th><th>1400</th>
   </tr>
   <tr>
    <th>8 занятий</th><th>2600</th>
   </tr>
   <tr>
    <th>12 занятий</th><th>3500</th>
   </tr>
   <tr>
    <th>16 занятий</th><th>4400</th>
   </tr>
   <tr>
    <th colspan="2">Абонементы акробатика</th>
   </tr>
   <tr>
    <th>4 занятия (на 45 дней)</th><th>1500</th>
   </tr>
   <tr>
    <th>8 занятий (на 90 дней)</th><th>2800</th>
   </tr>
  </table>
    <p>
      <object width="1000" height="1000">
        <details><summary>Правила посещения студии</summary><embed src="../docs/pravila_pos.pdf" width="1000" height="1000" /></details>
        <details><summary>Правила пользования абонемента</summary><embed src="../docs/pravila_abons.pdf" width="1000" height="1000" /></details>
      </object>
    </p>

  </section>

<?php
require SITE_ROOT . 'includes/footer.php';
?>
