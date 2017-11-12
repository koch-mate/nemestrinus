<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");
require_once("../lib/prices.php");
require_once("../lib/utility.php");

require_once('../lib/log.php');
require_once('../lib/log_events.php');

if(empty($_SESSION['activeLogin']) || empty($_GET['fafaj']) ){
    ?>

Hibás autentikáció.

<?php
}
else {
  $p =  getUnitPrice($_GET['csom'], $_GET['fafaj']);?>
  <span onclick="edit(<?=$_GET['tid']?>, '<?=$_GET['csom']?>', '<?=$_GET['fafaj']?>', <?=$p?>)">
    <span style="cursor:pointer;" title="Szerkesztés"><?php
      echo ezres($p)."&nbsp;Ft/";
      echo CSOMAGOLASTIPUSOK[$_GET['csom']][1];
      ?>
    </span>
  </span>
  <?php
} ?>
