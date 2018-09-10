<?

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


<script>
function toggle(link, div){
  //div.toggle();
}

$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top-150
        }, 2000);
        return false;
      }
    }
  });
});

</script>


<div id="loading" style="padding-top:2em;padding-bottom:2em;text-align:center;font-size:40px;">
  <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
</div>

<div id="main_table" style="display:none;">

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
      <th><a href="?mode=megrendeles-osszesites&id=<?=$i[ID]?>"><?=$i[ID]?></a></th>
      <td><?=['lakossagi'=>'<i class="fa fa-home" title="Lakossági" aria-hidden="true"></i>','export'=>'<i title="Export" class="fa fa-globe" aria-hidden="true"></i>'][$i[Tipus]]?></td>
      <td>
        <span class="btn btn-xs btn-primary " style="cursor:default;background:<?=M_S_SZINEK[$i['Statusz']][0]?>;border-color:<?=M_S_SZINEK[$i['Statusz']][0]?>;font-weight:bold;" >
            <?=$i['Statusz']?>
        </span></td>
        <td><?=($i[Tipus]==M_LAKOSSAGI?$i[MegrendeloNev]:exportCustomerGetNameById($i[MegrendeloID]))?></td>
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

<script>

$(
  function(){
    $("#loading").hide();
    $("#main_table").show();
  }
);
</script>

</div>


<?php } //func: haviNezet()?>

<?=kimutatasTemplate("Megrendelések havi nézete", 'haviNezet', $honapraugras=true, $tipusSzures = true)?>
