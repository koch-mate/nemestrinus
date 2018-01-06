<?php

session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");
require_once("../lib/packaging.php");


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
      <div>
        <p >
          <b>Tétel ID: <?=$tetel['ID']?></b> <br />Rendelt: <?=rnd($tetel['MennyisegStd'])."&nbsp".U_NAMES[U_STD][1]?> <?=FATIPUSOK[$tetel['Fafaj']][0]?>&nbsp;<span style="display:inline-block;width:2em;"><img src="/img/<?=$tetel['Fafaj']?>.png" class="zoom" style="height:1em;"></span>
          <br />Gyártott:
        </p>
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
              <td><?=FATIPUSOK[$i['Fatipus']][0]?>&nbsp;<span style="display:inline-block;width:2em;"><img src="/img/<?=$i['Fatipus']?>.png" class="zoom" style="height:1em;"></span></td>
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
      </div>
      <p >
        Csomagolóanyag:
      </p>
      <?php
      $dcs = packagingGetUsedOnOrderItem($tetel['ID']);
      if(count($dcs)==0){
        ?>
        <p>
          <i>Nincs felhasznált elem</i>
        </p>
        <?php
      }
      else {
        ?>
        <table class="table table-sm">
          <?php
          foreach($dcs as $di){
            ?>
            <tr>
              <td><?=$di['ID']?></td>
              <td><?=CSOMAGOLOANYAGOK[$di['Tipus']][0]?>&nbsp;<span style="display:inline-block;width:2em;"><img src="/img/<?=$di['Tipus']?>.png" class="zoom" style="height:1em;"></span></td>
              <td><?=-$di['Mennyiseg']."&nbsp;".CSOMAGOLOANYAGOK[$di['Tipus']][1]?></td>
            </tr>
            <?php
          }
          ?>
        </table>
        <?php
      }
      ?>
      </div>
      <?php
    }
  }
}
 ?>
