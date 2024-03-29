<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Megrendelő szerinti kimutatás - Lakossági megrendelések", 'cnt', $honapraugras=false);

function label($cnt, $style){
    return "<span class='label label-$style'>$cnt</span>";
}

function cnt(){
  global $ev, $db;
?>

<div class="row">

  <div class=" col-md-11" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">
    <p>
      Az alábbi kimutatásban a tárgyévben (<?=$ev?>) teljesítendő megrendelések szerepelnek. Mind a teljesített, mind a még gyártás/szállítás alatt álló megrendelések megjelennek itt.
    </p>

<div style="width:50%;min-width:400px;">
  <canvas id="lakch" width="400" height="400"></canvas>
</div>

<table class="table table-hover">
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

$lak = $db->select('megrendeles', ['MegrendeloNev', 'MegrendeloTel'], ['Deleted'=>0, 'Tipus'=>M_LAKOSSAGI, 'Statusz'=>M_S_NEMTOROLT, 'KertDatum[<>]'=>[$ev.'-01-01', $ev.'-12-31'], 'ORDER'=>'MegrendeloNev', 'GROUP'=>['MegrendeloNev']]);
$mossz = [];
foreach(array_keys(MONTHS) as $i){
  $mossz[$i]=0;
}
foreach($lak as $mn){
  $ossz=0;
 ?>
    <tr>
      <th><span title="Tel: <?=$mn['MegrendeloTel']?>"><?=$mn['MegrendeloNev']?> </span></th>
      <?php foreach(array_keys(MONTHS) as $month){
        $sd = $ev.'-'.$month.'-01';
        $ed = date('Y-m-t', strtotime($sd));
        $s = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_NEMTOROLT, 'megrendeles.Tipus'=>M_LAKOSSAGI, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0, 'megrendeles.MegrendeloNev'=>$mn['MegrendeloNev'] ] );
        $ossz += $s;
        $mossz[$month]+= rnd($s);
        ?>
      <td>
        <span title="<?=MONTHS[$month]?>"><?=($s>0?spanify(rnd($s)):'')?></span>
      </td>
    <?php } ?>
      <th>
        <?=spanify(number_format(rnd($ossz), 2, '.', ' ' ))?>
      </th>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th>
        Összesen
      </th>
      <?php foreach(array_keys(MONTHS) as $month){
        ?>
        <td>
          <span title="<?=MONTHS[$month]?>"><?=spanify(rnd($mossz[$month]))?></span>
        </td>
        <?php
      }?>
    </tr>
  </tfoot>
</table>
  </div>
<script>
$(function() {

  var barChartData = {
            labels: ["<?=implode('", "', array_values(MONTHS))?>"],
            datasets: [{
                label: 'Összes havi lakossági megrendelés [<?=U_NAMES[U_STD][0]?>]',
                backgroundColor: 'rgba(140,200,10, 0.6)',
                data: [
                  <?=implode(', ', $mossz)?>
                ]
            }, ]

        };
    var ctx = document.getElementById("lakch").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
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

<?php
}
?>
