<style>
  span.szam {
    display: inline-block;
    width: 3em;
    text-align: right;
  }
</style>
<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Faanyag áttekintés", 'faanyagAttekintes');

function label($cnt, $style){
    return "<span class='label label-$style'>$cnt</span>";
}

function faanyagAttekintes(){
  global $ev, $db;
?>
<div class="row">

  <div class=" col-md-4" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">
    <h3>Éves statisztika</h3>
    <p>
      A tárgyévben (<?=$ev?>) fafajonkénti <?=label('bevétel','success')?>, <?=label('korrekció','info')?>, <?=label('felhasználás','warning')?> (minden érték <?=U_NAMES[U_STD][1]?>-ben)
    </p>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Fafaj</th>
          <th>Bevétel</th>
          <th>Korrekció</th>
          <th>Felhasználás</th>
          <th>Értékesítés</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach(array_keys(FATIPUSOK) as $f){
          $bev = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_BEVETEL, 'Datum[<>]'=>[$ev.'-01-01', $ev.'-12-31']]]);
          $kor = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_KORREKCIO, 'Datum[<>]'=>[$ev.'-01-01', $ev.'-12-31']]]);
          $felh = -$db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_FELHASZNALAS, 'Datum[<>]'=>[$ev.'-01-01', $ev.'-12-31']]]);
          $ert = -$db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_KIADAS, 'Datum[<>]'=>[$ev.'-01-01', $ev.'-12-31']]]);
        ?>
        <tr>
          <th><span style="display:inline-block;width:2em;"><img src="/img/<?=$f?>.png" class="zoom" style="height:1em;"></span><?=FATIPUSOK[$f][0]?></td>
          <td style="text-align:right;"><?=label(rnd(0+$bev),'success')?></td>
          <td style="text-align:right;"><?=label(rnd(0+$kor),'info')?></td>
          <td style="text-align:right;"><?=label(rnd(0+$felh),'warning')?></td>
          <td style="text-align:right;"><?=label(rnd(0+$ert),'primary')?></td>
        </tr>

        <?php } ?>
      </tbody>
    </table>

  </div>
</div>

<div class="row">


  <div class="col-md12" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">
    <h3>Havi statisztika</h3>
    <p>
      A tárgyévben (<?=$ev?>) havonta fafajonkénti <?=label('bevétel (B)','success')?>, <?=label('korrekció (K)','info')?>, <?=label('felhasználás (F)','warning')?>, <?=label('értékesítés (É)','primary')?> (minden érték <?=U_NAMES[U_STD][1]?>-ben)
    </p>

    <table class="table table-sm table-hover" >
      <thead>
        <tr>
          <th>Fafaj</th>
          <th> </th>
          <?php
          foreach(MONTHS as $month){ ?>
          <th style="text-align:right;"><?=$month?></th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach(array_keys(FATIPUSOK) as $f){
        ?>
        <tr>
          <th><span style="display:inline-block;width:2em;"><img src="/img/<?=$f?>.png" class="zoom" style="height:1em;"></span><?=FATIPUSOK[$f][0]?></th>
          <td>
            <?=label('B', 'success')?><br />
            <?=label('K', 'info')?><br />
            <?=label('F', 'warning')?><br />
            <?=label('É', 'primary')?>
          </td>

          <?php
          foreach(MONTHS as $month){
            $mn = array_search($month, MONTHS);
            $bev = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_BEVETEL, 'Datum[<>]'=>[$ev.'-'.$mn.'-01', date("Y-m-t", strtotime($ev.'-'.$mn.'-01'))]]]);
            $kor = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_KORREKCIO, 'Datum[<>]'=>[$ev.'-'.$mn.'-01', date("Y-m-t", strtotime($ev.'-'.$mn.'-01'))]]]);
            $felh = -$db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_FELHASZNALAS, 'Datum[<>]'=>[$ev.'-'.$mn.'-01', date("Y-m-t", strtotime($ev.'-'.$mn.'-01'))]]]);
            $ert  = -$db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_KIADAS, 'Datum[<>]'=>[$ev.'-'.$mn.'-01', date("Y-m-t", strtotime($ev.'-'.$mn.'-01'))]]]);
            ?>
          <td style="text-align:right;">
            <?=rnd(0+$bev)?><br />
            <?=rnd(0+$kor)?><br />
            <?=rnd(0+$felh)?><br />
            <?=rnd(0+$ert)?>
          </td>
          <?php } ?>
        </tr>

        <?php } ?>
      </tbody>
    </table>

  </div>
</div>

<div class="row">

<?php

foreach(array_keys(FATIPUSOK) as $f){

?>

  <div class="col-md6" style="background:rgba(255, 255, 255, 0.9);margin:2em 0 0 2em; float:left;padding:1em; width:47%;">
<h3><?=mb_ucfirst(FATIPUSOK[$f][0])?> éves mozgás [<?=U_NAMES[U_STD][0]?>] <span style="display:inline-block;width:2em;"><img src="/img/<?=$f?>.png" class="zoom" style="height:1em;"></span></h3>
<div >
  <canvas id="fachart_<?=$f?>" width="200" height="200"></canvas>

</div>

<?php
$date = $ev.'-01-01';
$be = 0;
$ki = 0;
$er = 0;
$bes = "";
$kis = "";
$ers = "";
$lbls = "";

$lbe = 0;
$lki = 0;
$ler = 0;

$nbe = 0;
$nki = 0;
$ner = 0;

$limit = 7;
while(strtotime($date) <= strtotime($ev.'-12-31')){

  $bev = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_BEVETEL, 'Datum'=>$date]]);
  $kor = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_KORREKCIO, 'Datum'=>$date]]);
  $felh = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_FELHASZNALAS, 'Datum'=>$date]]);
  $ert = $db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$f, 'Forgalom'=>FORGALOM_KIADAS, 'Datum'=>$date]]);
  $be += rnd($bev + $kor);
  $ki += rnd($felh + $ert);
  $er = $ki + $be;

  if($lbe != $be || $date == $ev.'-01-01' || $date == $ev.'-12-01' || $nbe > $limit){
    $bes .= "{y: $be, x: '$date' }, ";
    $lbe = $be;
    $nbe = 0;
  }
  else {
    $nbe += 1;
  }

  if($lki != $ki || $date == $ev.'-01-01' || $date == $ev.'-12-01' || $nki > $limit){
    $kis .= "{y: $ki, x: '$date' }, ";
    $lki = $ki;
    $nki = 0;
  }
  else {
    $nki += 1;
  }

  if($ler != $er || $date == $ev.'-01-01' || $date == $ev.'-12-01' || $ner > $limit){
    $ers .= "{y: $er, x: '$date' }, ";
    $ler = $er;
    $ner = 0;
  }
  else {
    $ner += 1;
  }

  $lbls .= "'$date', ";
  $date = date('Y-m-d', strtotime("+1 day", strtotime($date)));

}
 ?>
<script>
var ctx = document.getElementById("fachart_<?=$f?>");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?=$lbls?>],
        datasets: [
          {
            backgroundColor: 'rgba(0, 255, 0, 0.1)',
            borderColor: 'rgba(0, 255, 0, 1)',
            label: 'Bevétel + korrekció',
            data: [<?=$bes?>],
            lineTension: 0,
          },
          {
            backgroundColor: 'rgba(255, 0, 0, 0.1)',
            borderColor: 'rgba(255, 0, 0, 1)',
            label: 'Felhasználás + értékesítés',
            data: [<?=$kis?>],
            lineTension: 0,
          },
          {
            backgroundColor: 'rgba(0, 0, 255, 0.1)',
            borderColor: 'rgba(0, 0, 255, 1)',
            label: 'Relatív készlet (Bevétel + korrekció - felhasználás - értékesítés)',
            data: [<?=$ers?>],
            fill: true,
            lineTension: 0,
          },

        ]
    },
    options: {
      animation: {
          duration: 0, // general animation time
      },
      hover: {
          animationDuration: 0, // duration of animations when hovering an item
      },
      responsiveAnimationDuration: 0, // animation duration after a resize

      elements: {
        point: {
          //radius: 0,
          hitRadius: 3,
        }
      }
    }
});
</script>
  </div>

<?php
}
?>
</div>
<?php
}
?>
