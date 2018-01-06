<?php

session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");


if(empty($_SESSION['activeLogin']) || empty($_GET['id']) ){
    ?>

Hibás autentikáció.

<?php
}
else {

$faid = $_GET['id'];

$dd = woodGetUsageByWoodID($faid);
if(count($dd)==0){
  ?>
  <p>
    <em>Nincs felhasználás</em>
  </p>
  <?
}
else {
  ?>

  <table class="table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          Forg.
        </th>
        <th>
          Menny.
        </th>
        <th>
          Megr. tétel ID
        </th>
        <th>
          Megr.  ID
        </th>
      </tr>
    </thead>
  <?php

foreach($dd as $d){
  $orderId = orderGetIDByOrderLineID($d['MegrendelesTetelID']);
  ?>

  <tr>
    <td><?=$d['ID']?></td>
    <td><span class="glyphicon <?=FORGALOM_ICON[$d['Forgalom']]?>" title="<?=FORGALOM_DICT[$d['Forgalom']]?>"></span></td>
    <td><?=-rnd($d['Mennyiseg'])."&nbsp;".U_NAMES[U_STD][1]?></td>
    <td><?=$d['MegrendelesTetelID']?></td>
    <td><a href="?mode=megrendeles-osszesites&id=<?=$orderId?>"><?=$orderId?></a></td>
  </tr>

  <?php

}
?>
</table>
<?php
}
}
 ?>
