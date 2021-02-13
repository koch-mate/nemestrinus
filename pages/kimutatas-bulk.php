<?php

use Medoo\Medoo;
require("lib/report_temp.php");

function haviNezet(){

  global $db, $mode, $ev, $lak_exp;
?>


<style>
.table tbody tr td,  .table tbody tr th, .table thead tr th {
  padding:2px 5px 2px 5px;
  vertical-align: middle;
}
.table {
  border: 0;
}
p.light {
  margin:0;
  padding: 0;
}
</style>

<div class="row" style="margin:2em;">


<div id="main_table" >

<?php
foreach(MONTHS as $mi => $mn){
  $ii = 1;
   ?>

<div id="hodiv<?=$mi?>" <?=($mi == date('m') ? '':'style=""')?>>
<h3><?=$ev.". ".$mn?></h3>

<table class="table"   style="font-size:80%;padding:2px;">
  <thead>
    <tr>
      <th>#</th>
      <th>ID</th>
      <th title="Típus">T.</th>
      <th>Státusz</th>
      <th>Megrendelő</th>
      <th>Rögzítés<br>dátuma</th>
      <th>Ígért<br>teljesítés<br>dátuma</th>
      <th>Szállítás dátuma</th>
      <th>Megrendelés</th>
      <th>Ár</th>
      <th>Fuvardíj</th>
      <th>Fizetési<br />határidő</th>
      <th>Fizetés</th>
      <th>Gyártó</th>
      <th>Megjegyzés</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $even = 0;
    $filters = [
      'KertDatum'=> [$ev.'-'.str_pad($mi,2, '0',STR_PAD_LEFT).'-'.'01', $ev.'-'.str_pad($mi,2,'0',STR_PAD_LEFT).'-'.date('t', strtotime($ev.'-'.str_pad($mi,2,'0',STR_PAD_LEFT).'-'.'01'))],
      'Tipus'=> [$lak_exp == 'lakossagi' ? M_LAKOSSAGI : ($lak_exp == 'export' ? M_EXPORT : '')],
      'OrderBy'=>['Tipus'=>'DESC','KertDatum'=>'ASC']
    ];
    if($lak_exp =='mind'){
      unset($filters['Tipus']);
    }
    foreach (ordersGetAllData($filters) as $i) {
      $ois = ordersGetItemsByID($i['ID']);
      $oin = count($ois);
      $even = 1-$even;
    ?>
    <tr style="background:<?=colourBrightness(M_S_SZINEK[$i['Statusz']][0],0.35 + 0.05*$even)?>;">
      <th>
        <?=$ii++?>
      </th>
      <th>ID: <?=$i[ID]?></th>
      <td><?=['lakossagi'=>'lakossági','export'=>'export'][$i[Tipus]]?></td>
      <td>
            <?=$i['Statusz']?>
      </td>
      <td><?=($i[Tipus]==M_LAKOSSAGI?$i[MegrendeloNev].'<br/>'.$i[MegrendeloCim].'<br/>Tel: '.$i[MegrendeloTel].'':exportCustomerGetNameById($i[MegrendeloID]))?></td>
      <td><?=$i[RogzitesDatum]?></td>
      <td><?=$i[KertDatum]?></td>
      <td><?=$i[SzallitasTenylegesDatuma]?></td>
      <td>
        <?php foreach($ois as $oi){ ?>
          <p class="light">
            <?=FATIPUSOK[$oi[Fafaj]][0]?>,&nbsp;<?=$oi[Hossz]?>&nbsp;cm,&nbsp;<?=$oi[Mennyiseg]?>&nbsp;<?=CSOMAGOLASTIPUSOK[$oi[Csomagolas]][1]?>&nbsp;<?=mb_strtolower(CSOMAGOLASTIPUSOK[$oi[Csomagolas]][0])?>
          </p>
        <?php } ?>
      </td>

      <td><?=ezres(orderFullPrice($i[ID]) - ($i[Tipus]==M_EXPORT ? $i[Fuvardij]:0))?>&nbsp;<?=$i[Penznem]?></td>
      <td><?=ezres($i[Fuvardij])?>&nbsp;<?=$i[Penznem]?></td>
      <td <?=($i[FizetesStatusza]!=F_S_FIZETVE && date("Y-m-d")>$i[FizetesiHatarido] && $i[Statusz]!=M_S_VISSZAUTASITVA && $i[Statusz] != M_S_VISSZAMONDOTT ? 'style="background:#933;color:#fff;" ' : '')?>><?=$i[FizetesiHatarido]?></td>
      <td><?=$i[FizetesStatusza]?><?php
      if($i[FizetesStatusza]==F_S_FIZETVE){
        ?>
        <br /><span <?=($i[FizetesDatuma]>$i[FizetesiHatarido]?'style="color:#a00;"':'')?>>
        <?=$i[FizetesDatuma]?></span>
        <?php
      }?></td>
      <td><?=$i[Gyarto]?></td>
      <td><?=messageSimpleRender($i[Megjegyzes])?></td>
    </tr>
      <?php
    }
    ?>
  </tbody>
</table>
</div>

<?php } ?>
</div>


</div>


<?php } //func: haviNezet()?>

<?=kimutatasTemplate("Összes megrendelés", 'haviNezet', $honapraugras=false, $tipusSzures = false, $osszesEv = true)?>
