<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Beszállítók", 'cnt', $honapraugras=false);

function label($cnt, $style){
    return "<span class='label label-$style'>$cnt</span>";
}

function cnt(){
  global $ev, $db;
?>

<div class="row" style="margin:2em;">

<?php
$d = woodGetSupplierSumByTrafficAndDate(FORGALOM_BEVETEL, $ev.'-01-01', $ev.'-12-31');
?>
<p>
  A kimutatás az egyes beszállítóktól származó havi forgalmat mutatja.
</p>

<table class="table" style="width:90%">
  <thead>
    <tr>
      <th>
        Beszállító
      </th>
<?php foreach(MONTHS as $mi => $mn){?>
          <th>
            <?=$mn?>
          </th>
<?php      }?>
      <th>
        Összesen
      </th>
    </tr>
  </thead>
  <tbody>
<?php foreach($d as $i){ ?>
    <tr>
    <th>
      <?=getSupplierNameById($i['BeszallitoID'])?>
    </th>
<?php foreach(MONTHS as $mi => $mn){
  $sd = $ev.'-'.$mi.'-01';
  $ed = date('Y-m-t', strtotime($sd));
  ?>
        <td style="text-align:right;">

          <?=rnd(woodGetSupplierSumByTrafficAndDate(FORGALOM_BEVETEL, $sd, $ed, $i['BeszallitoID'])).'&nbsp;'.U_NAMES[U_STD][1]?>
        </td>
<?php      }?>
      <th style="text-align:right;">
        <?=rnd($i['Mennyiseg']).'&nbsp;'.U_NAMES[U_STD][1]?>
      </th>
    </tr>
<?php }?>
  </tbody>
</table>
</div>
<?php } ?>
