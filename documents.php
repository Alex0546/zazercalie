<?php
define('SITE', 1);
define('SITE_ROOT', './');
define('PAGE_TITLE', 'Документация');
require SITE_ROOT . 'includes/header.php';
?>

  <section>
    <h2>Стоимость занятий</h2>
    <table width="400" border="1" cellpadding="4" cellspacing="0">
   <tr>
    <td colspan="2" align="center">Разовое занятие</td>
   </tr>
   <tr>
    <td>Пробное занятие</td><td>200</td>
  </tr>
   <tr>
    <td>Разовое заянтие</td><td>375</td>
   </tr>
   <tr>
    <td>Разовое заянтие (акробатика)</td><td>400</td>
   </tr>
   <tr>
    <td>Индивидуальное заянтие</td><td>1250</td>
   </tr>
   <tr>
    <td colspan="2" align="center">Абонементы (30 дней)</td>
   </tr>
   <tr>
    <td>4 занятия</td><td>1400</td>
   </tr>
   <tr>
    <td>8 занятий</td><td>2600</td>
   </tr>
   <tr>
    <td>12 занятий</td><td>3500</td>
   </tr>
   <tr>
    <td>16 занятий</td><td>4400</td>
   </tr>
   <tr>
    <td colspan="2" align="center">Абонементы акробатика</td>
   </tr>
   <tr>
    <td>4 занятия (на 45 дней)</td><td>1500</td>
   </tr>
   <tr>
    <td>8 занятий (на 90 дней)</td><td>2800</td>
   </tr>
  </table>

  <h2>Правила студии</h2>
    <p>
      <object width="1000" height="1000">
        <details><summary>Правила посещения студии</summary><embed src="../docs/pravila_pos.pdf" width="1000" height="1000" /></details>
        <details><summary>Правила пользования абонементом</summary><embed src="../docs/pravila_abons.pdf" width="1000" height="1000" /></details>
      </object>
    </p>

  </section>

<?php
require SITE_ROOT . 'includes/footer.php';
?>
