<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Megrendelő szerinti kimutatás - Összes megrendelés", 'cnt', $honapraugras=false);

function label($cnt, $style){
    return "<span class='label label-$style'>$cnt</span>";
}

function cnt(){
  global $ev, $db;
?>

<div class="row">

  <div class=" col-md-11" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">

    <p>
      Az alábbi kimutatásban a tárgyévben (<?=$ev?>) leadott, teljesült, teljesítésre váró, és meghiúsult megrendelések szerepelnek.
    </p>
    <p>
      Jelmagyarázat:
      <ul>
        <li><?=lbl(1234, $prefix = '', U_NAMES[U_STD][1],$style='primary')?> - Összes leadott megrendelés</li>
        <li><?=lbl(1234, $prefix = '', U_NAMES[U_STD][1],$style='success')?> - Teljesített megrendelés</li>
        <li><?=lbl(1234, $prefix = '', U_NAMES[U_STD][1],$style='warning')?> - Még nem teljesített megrendelés</li>
        <li><?=lbl(1234, $prefix = '', U_NAMES[U_STD][1],$style='danger')?> - Vevő által visszamondott megrendelés</li>
      </ul>
      A megrendelések az esedékességüknek megfelelő hónapban jelennek meg. Ha egy megrendelés áprilisra volt esedékes, akkor ott jelenik meg, a report nem tesz különbséget a határidőre és a határidőn túl elkészült rendelések között.
    </p>

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
    <tr style="background:#eee;">
      <th>
        Összes lakossági
      </th>
      <?php
      $vossz = [];
      $fossz = [];
      $tossz = [];
      foreach(array_keys(MONTHS) as $i){
        $vossz[$i]=0;
        $tossz[$i]=0;
        $fossz[$i]=0;
      }

      $ossz = 0;
      $osszt = 0;
      $osszv = 0;
      foreach(array_keys(MONTHS) as $month){
        $sd = $ev.'-'.$month.'-01';
        $ed = date('Y-m-t', strtotime($sd));
        $s = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_NEMTOROLT, 'megrendeles.Tipus'=>M_LAKOSSAGI, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0 ] );
        $s_tel = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_TELJESITVE, 'megrendeles.Tipus'=>M_LAKOSSAGI, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0 ] );
        $s_visz = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_VISSZAUTASITVA, 'megrendeles.Tipus'=>M_LAKOSSAGI, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0 ] );
        $ossz += $s;
        $osszt += $s_tel;
        $osszv += $s_visz;
        $vossz[$month]+= rnd($s_visz);
        $fossz[$month]+= rnd($s-$s_tel);
        $tossz[$month]+= rnd($s_tel);
        ?>
        <th  style="text-align:right;">
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s), $prefix = '', U_NAMES[U_STD][1],$style='primary')?></span><br />
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s_tel), $prefix = '', U_NAMES[U_STD][1],$style='success')?></span><br />
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s-$s_tel), $prefix = '', U_NAMES[U_STD][1],$style='warning')?></span><br />
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s_visz), $prefix = '', U_NAMES[U_STD][1],$style='danger')?></span>
        </th>
        <?php
      }?>
      <th  style="text-align:right;">
        <?=lbl(rnd($ossz), $prefix = '', U_NAMES[U_STD][1],$style='primary')?><br />
        <?=lbl(rnd($osszt), $prefix = '', U_NAMES[U_STD][1],$style='success')?><br />
        <?=lbl(rnd($ossz-$osszt), $prefix = '', U_NAMES[U_STD][1],$style='warning')?><br />
        <?=lbl(rnd($osszv), $prefix = '', U_NAMES[U_STD][1],$style='danger')?>
      </th>
    </tr>
    <tr style="background:#ccc;">
      <th>
        Összes export
      </th>
      <?php
      $ossz = 0;
      $osszt = 0;
      $osszv = 0;
      foreach(array_keys(MONTHS) as $month){
        $sd = $ev.'-'.$month.'-01';
        $ed = date('Y-m-t', strtotime($sd));
        $s = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_NEMTOROLT, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0 ] );
        $s_tel = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_TELJESITVE, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0 ] );
        $s_visz = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_VISSZAUTASITVA, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0 ] );
        $ossz += $s;
        $osszt += $s_tel;
        $osszv += $s_visz;
        $vossz[$month]+= rnd($s_visz);
        $fossz[$month]+= rnd($s-$s_tel);
        $tossz[$month]+= rnd($s_tel);

        ?>
        <th  style="text-align:right;">
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s), $prefix = '', U_NAMES[U_STD][1],$style='primary')?></span><br />
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s_tel), $prefix = '', U_NAMES[U_STD][1],$style='success')?></span><br />
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s-$s_tel), $prefix = '', U_NAMES[U_STD][1],$style='warning')?></span><br />
          <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s_visz), $prefix = '', U_NAMES[U_STD][1],$style='danger')?></span>
        </th>
        <?php
      }?>
      <th  style="text-align:right;">
        <?=lbl(rnd($ossz), $prefix = '', U_NAMES[U_STD][1],$style='primary')?><br />
        <?=lbl(rnd($osszt), $prefix = '', U_NAMES[U_STD][1],$style='success')?><br />
        <?=lbl(rnd($ossz-$osszt), $prefix = '', U_NAMES[U_STD][1],$style='warning')?><br />
        <?=lbl(rnd($osszv), $prefix = '', U_NAMES[U_STD][1],$style='danger')?>
      </th>
    </tr>


  </thead>
  <tbody>
<?php

$exp = $db->select('megrendelo',['ID','MegrendeloNev'], ['Deleted'=>0 ]);
// export
foreach($exp as $mn){
  $sd = $ev.'-01-01';
  $ed = $ev.'-12-31';
  $s = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_NEMTOROLT, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0, 'megrendeles.MegrendeloID'=>$mn['ID'] ] );
  if($s == 0){
    continue;
  }
  $s_tel = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_TELJESITVE, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0, 'megrendeles.MegrendeloID'=>$mn['ID'] ] );
  $s_visz = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_VISSZAUTASITVA, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0, 'megrendeles.MegrendeloID'=>$mn['ID'] ] );
  $ossz=0;
  $osszt=0;
  $osszv=0;
 ?>
    <tr>
      <th><span title="ID: <?=$mn['ID']?>"><?=$mn['MegrendeloNev']?> </span></th>
      <?php foreach(array_keys(MONTHS) as $month){
        $sd = $ev.'-'.$month.'-01';
        $ed = date('Y-m-t', strtotime($sd));
        $s = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_NEMTOROLT, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0, 'megrendeles.MegrendeloID'=>$mn['ID'] ] );
        $s_tel = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_TELJESITVE, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0, 'megrendeles.MegrendeloID'=>$mn['ID'] ] );
        $s_visz = $db->sum('megrendeles_tetel', ['[>]megrendeles'=>['MegrendelesID'=>'ID']],'megrendeles_tetel.MennyisegStd', ['megrendeles.Deleted'=>0, 'megrendeles.Statusz'=>M_S_VISSZAUTASITVA, 'megrendeles.Tipus'=>M_EXPORT, 'megrendeles.KertDatum[<>]'=>[$sd,$ed], 'megrendeles_tetel.Deleted'=>0, 'megrendeles.MegrendeloID'=>$mn['ID'] ] );
        $ossz += $s;
        $osszt += $s_tel;
        $osszv += $s_visz;
        ?>
      <td style="text-align:right;">
        <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s), $prefix = '', U_NAMES[U_STD][1],$style='primary')?></span><br />
        <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s_tel), $prefix = '', U_NAMES[U_STD][1],$style='success')?></span><br />
        <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s-$s_tel-$s_visz), $prefix = '', U_NAMES[U_STD][1],$style='warning')?></span><br />
        <span title="<?=MONTHS[$month]?>"><?=lbl(rnd($s_visz), $prefix = '', U_NAMES[U_STD][1],$style='danger')?></span>
      </td>
    <?php } ?>
      <th style="text-align:right;">
        <?=lbl(rnd($ossz), $prefix = '', U_NAMES[U_STD][1],$style='primary')?><br />
        <?=lbl(rnd($osszt), $prefix = '', U_NAMES[U_STD][1],$style='success')?><br />
        <?=lbl(rnd($ossz-$osszt-$osszv), $prefix = '', U_NAMES[U_STD][1],$style='warning')?><br />
        <?=lbl(rnd($osszv), $prefix = '', U_NAMES[U_STD][1],$style='danger')?>
      </th>
    </tr>
  <?php } ?>
  </tbody>
</table>
<h4>Az alábbi grafikon a lakossági és az export megrendelések is látszanak</h4>


  <div style="width:50%;min-width:400px;">
    <canvas id="lakch" width="400" height="400"></canvas>
  </div>
</div>



<script>
$(function() {

  var barChartData = {
            labels: ["<?=implode('", "', array_values(MONTHS))?>"],
            datasets: [
              {
                label: 'Visszamondott megrendelés [<?=U_NAMES[U_STD][0]?>]',
                backgroundColor: 'rgba(217,83,79, 0.6)',
                data: [
                  <?=implode(', ', $vossz)?>
                ]
              },
              {
                label: 'Függő megrendelés [<?=U_NAMES[U_STD][0]?>]',
                backgroundColor: 'rgba(240,173,78, 0.6)',
                data: [
                  <?=implode(', ', $fossz)?>
                ]
              },
              {
                label: 'Teljesített megrendelés [<?=U_NAMES[U_STD][0]?>]',
                backgroundColor: 'rgba(92,184,92, 0.6)',
                data: [
                  <?=implode(', ', $tossz)?>
                ]
              },

           ]

        };
    var ctx = document.getElementById("lakch").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            scales: {
              xAxes: [{
                stacked: true,
              }],
              yAxes: [{
                stacked: true
              }]
            },

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
