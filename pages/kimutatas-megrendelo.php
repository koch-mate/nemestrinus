<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Megrendelő szerinti kimutatás", 'cnt', $honapraugras=false);

function label($cnt, $style){
    return "<span class='label label-$style'>$cnt</span>";
}

function cnt(){
  global $ev, $db;
?>

<div class="row">

<?php

foreach([M_LAKOSSAGI, M_EXPORT] as $megr){
  ?>
  <div class=" col-md-11" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">
    <h3><?=mb_ucfirst(MEGRENDELES_TIPUS_NEVEK[$megr])?> megrendelések</h3>
<p>
xxx</p>
<table class="table">
  <thead>
    <tr>
      <th>
        Megrendelő
      </th>
<?php foreach(MONTHS as $month){ ?>
      <th>
        <?=mb_ucfirst($month)?>
      </th>
    <?php } ?>
      <th>
        Összesen
      </th>
    </tr>
  </thead>
  <tbody>
<?php

$lak = $db->select('megrendeles', 'MegrendeloNev', ['Deleted'=>0, 'Tipus'=>M_LAKOSSAGI, 'Statusz'=>M_S_NEMTOROLT, 'KertDatum[<>]'=>[$ev.'-01-01', $ev.'-12-31'], 'ORDER'=>'MegrendeloNev', 'GROUP'=>['MegrendeloNev','MegrendeloTel']]);
foreach($lak as $mn){
 ?>
    <tr>
      <th><?=$mn?></th>
      <?php foreach(array_keys(MONTHS) as $month){ ?>
      <td>

      </td>
    <?php } ?>
      <th>
        <?=spanify('x')?>
      </th>
    </tr>
  <?php } ?>
  </tbody>
</table>
  </div>
<?php }?>
</div>

<?php
}
?>
