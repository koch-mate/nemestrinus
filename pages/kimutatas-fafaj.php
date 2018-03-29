<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Fafaj szerinti kimutatás", 'cnt', $honapraugras=false);

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
  <div class=" col-md-5" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">
    <h3><?=mb_ucfirst(MEGRENDELES_TIPUS_NEVEK[$megr])?> megrendelések</h3>
<p>
  Az alábbi táblázat a választott év (<?=$ev?>) <?=MEGRENDELES_TIPUS_NEVEK[$megr]?> megrendeléseit és gyártásait mutatja. A megrendelések oszlop alatt a az adott évben kért megrendelési
  határidővel rendelkező tételek szerepelnek. (Tehát ha a következő áprilisra idén rögzítenek megrendelést, az a jövő év adatai közt fog megjelenni.)
   A legyártott oszlopban a kiválasztott évben történt gyártások összege látszik. Ha minden megrendelés legyártásra került, és mindenhez ugyanannyi
   és ugyanolyan faanyag került felhasználásra, ami a megrendelésben szerepelt, a Legyártott és a Megrendelt értékek meg fognak egyezni. A valóságban
   viszont ezek gyakran nem egyeznek meg, mivel más fát használtak fel, vagy a megrendelés még nem gyártódott le.
</p>
<p>
  A táblázat NEM tartalmazza a külső cégnél legyártott termékeket, és a közvetlen értékesítést sem. A megrendeléseknél viszont megjelenik minden megrendelés,
  az is, amit később külső gyártással készítenek el.
</p>
<table class="table">
  <thead>
    <tr>
      <th>
        Fafaj
      </th>
      <th>
        Megrendelt
      </th>
      <th>
        Legyártott
      </th>
      <th>
        Különbözet
      </th>
    </tr>
  </thead>
  <tbody>
<?php
$ma = [];
$la = [];
$da = [];
$fa = [];

foreach(array_keys(FATIPUSOK) as $f){
  $m = $db->sum('megrendeles_tetel',['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_NEMTOROLT, 'megrendeles.Tipus'=>$megr, 'megrendeles.KertDatum[<>]'=>[$ev.'-01-01',$ev.'-12-31'], 'megrendeles_tetel.Deleted'=>0, 'megrendeles_tetel.Fafaj'=>$f ] );
  $midk = $db->select('megrendeles', 'ID', ['Deleted'=>0, 'Statusz'=>M_S_NEMTOROLT, 'Tipus'=>$megr, 'KertDatum[<>]'=>[$ev.'-01-01',$ev.'-12-31']]);
  $mtidk = $db->select('megrendeles_tetel', 'ID', ['Deleted'=>0, 'MegrendelesID'=>$midk]);
  $l = $db->sum('faanyag', 'mennyiseg', ['Deleted'=>0, 'Forgalom'=>FORGALOM_FELHASZNALAS, 'Fatipus'=>$f, 'Datum[<>]'=>[$ev.'-01-01', $ev.'-12-31'], 'MegrendelesTetelID'=>$mtidk]);
  array_push($ma, rnd($m));
  array_push($la, rnd(-$l));
  array_push($da, rnd($m+$l));
  array_push($fa, '"'.FATIPUSOK[$f][0].'"');
 ?>
    <tr>
      <td><img src="img/<?=$f?>.png" class="zoom" style="height:1em;" title="<?=FATIPUSOK[$f][0]?>">&nbsp;<?=mb_ucfirst(FATIPUSOK[$f][0])?></td>
      <td style="text-align:right;"><?=spanify(number_format(rnd($m), 2, '.', ' ' ))?></td>
      <td style="text-align:right;"><?=spanify(number_format(rnd(-$l), 2, '.', ' ' ))?></td>
      <td style="text-align:right;"><?=spanify(number_format(rnd($m+$l), 2, '.', ' ' ))?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<p>
  <canvas id="ch_<?=$megr?>" width="400" height="400"></canvas>
</p>
<script>
$(function() {

  var barChartData_<?=$megr?> = {
            labels: [<?=implode(', ', $fa)?>],
            datasets: [{
                label: 'Megrendelt',
                backgroundColor: 'rgba(25,25,200, 0.6)',
                data: [
                  <?=implode(', ', $ma)?>
                ]
            }, {
                label: 'Legyártott',
                backgroundColor: 'rgba(25,200,25, 0.6)',
                data: [
                  <?=implode(', ', $la)?>
                ]
            }]

        };
    var ctx_<?=$megr?> = document.getElementById("ch_<?=$megr?>").getContext("2d");
    window.myBar_<?=$megr?> = new Chart(ctx_<?=$megr?>, {
        type: 'horizontalBar',
        data: barChartData_<?=$megr?>,
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
        }
    });

});


</script>
  </div>
<?php }?>
</div>

<?php
}
?>
