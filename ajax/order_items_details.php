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

$mid = $_GET['id'];

$dd = ordersGetItemsByID($mid);
  if(count($dd)==0)
  {
    ?>
    <p>
      <em>Nincsenek tételek</em>
    </p>
    <?
  }
  else
  {
    foreach($dd as $tetel){
      ?>
      <div style="width:100%;height:100%;background:#ddd;border-radius:5px;padding:5px;">
      <p>
        <b>ID: <?=$tetel['ID']?></b> Rendelt: <?=rnd($tetel['MennyisegStd'])."&nbsp".U_NAMES[U_STD][1]?> <?=FATIPUSOK[$tetel['Fafaj']][0]?>
        <?php
        $de = woodGetUsedForOrder($tetel['ID']);
        if(count($de)==0){
          ?>
          <p>
            <i>Nincs legyártott elem</i>
          </p>
          <?php
        }
        else {
        ?>
        <table class="table table-sm" >
          <?php
          $sum = 0;
          foreach($de as $i){
            $sum += $i['Mennyiseg'];
            ?>
            <tr>
              <td><?=$i['ID']?></td>
              <td><?=FATIPUSOK[$i['Fatipus']][0]?></td>
              <td><?=-rnd($i['Mennyiseg'])."&nbsp".U_NAMES[U_STD][1]?></td>
            </tr>
            <?php
          }
          ?>
          <tfoot>
            <tr>
              <th>Összesen:</th>
              <th></th>
              <th><?=-rnd($sum)."&nbsp".U_NAMES[U_STD][1]?></th>
            </tr>
          </tfoot>
        </table>
        <?php }
        ?>
      </p>
      </div>
      <?php
    }
  }
}
 ?>
