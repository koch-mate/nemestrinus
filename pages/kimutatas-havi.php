<h1>Megrendelések havi nézete</h1>

<style>
.table tbody tr td,  .table tbody tr th, .table thead tr th {
  padding:2px;
}
</style>
<?php
$ev = date('Y');
if(isset($_GET[ev]) && $_GET[ev]>2015 && $_GET[ev]<2100){
  $ev = $_GET[ev];
}
?>
<h2>Tárgyév: <?=$ev?></h2>

<p>Év váltása:
  <?php for($i=2017; $i<2027; $i++){
    if($ev != $i){
    ?>
    <a href="?mode=kimutatas-havi&ev=<?=$i?>"><?=$i?></a>,
  <?php }
    else {
      ?>
      <?=$i?>,
      <?php
    }
  }
  if($ev == $i){
    ?>
    <?=$i?>
    <?php
  }
  else {
    ?>
    <a href="?mode=kimutatas-havi&ev=<?=$i?>"><?=$i?></a>
    <?php
  }
  ?>

</p>

<p>
  Hónap: <?php
  foreach(MONTHS as $mi => $mn){ ?>
    <a href="#hodiv<?=$mi?>" onclick="toggle(this, $('#hodiv<?=$mi?>'));"><?=$mn?></a><?=$mi<12?', ':''?>
    <?php } ?>
</p>
<script>
function toggle(link, div){
  div.toggle();
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

<div id="hodiv<?=$mi?>" <?=($mi == date('m') ? '':'style="display:none;"')?>>
<h3><?=$ev.". ".$mn?></h3>

<table class="table"   style="font-size:80%;padding:2px;">
  <thead>
    <tr>
      <th>#</th>
      <th>ID</th>
      <th>Tipus</th>
      <th>Státusz</th>
      <th>Megrendelő</th>
      <th>Rögzítés<br>dátuma</th>
      <th>Ígért<br>teljesítés<br>dátuma</th>
      <th>Szállítás dátuma</th>
      <th>Megrendelés</th>
      <th>Ár</th>
      <th>Fuvardíj</th>
      <th>Fizetési határidő</th>
      <th>Fizetés</th>
      <th>Gyártó</th>
      <th>Megjegyzés</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $even = 0;
$filters=['RogzitesDatum'=> [$ev.'-'.str_pad($mi,2, '0',STR_PAD_LEFT).'-'.'01', $ev.'-'.str_pad($mi,2,'0',STR_PAD_LEFT).'-'.date('t', strtotime($ev.'-'.str_pad($mi,2,'0',STR_PAD_LEFT).'-'.'01'))]];
    foreach (ordersGetAllData($filters) as $i) {
      $ois = ordersGetItemsByID($i['ID']);
      $oin = count($ois);
      $even = 1-$even;
    ?>
    <tr style="background:<?=colourBrightness(M_S_SZINEK[$i['Statusz']][0],0.15 + 0.03*$even)?>;">
      <th>
        <?=$ii++?>
      </th>
      <th><a href="?mode=megrendeles-osszesites&id=<?=$i[ID]?>"><?=$i[ID]?></a></th>
      <td><?=['lakossagi'=>'LAK.','export'=>'EXP.'][$i[Tipus]]?></td>
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
          <p>
            <?=FATIPUSOK[$oi[Fafaj]][0]?>,&nbsp;<?=$oi[Hossz]?>&nbsp;cm,&nbsp;<?=$oi[Mennyiseg]?>&nbsp;<?=CSOMAGOLASTIPUSOK[$oi[Csomagolas]][1]?>&nbsp;<?=mb_strtolower(CSOMAGOLASTIPUSOK[$oi[Csomagolas]][0])?>
          </p>
        <?php } ?>
      </td>
      <td><?=ezres($i[Vegosszeg])?>&nbsp;<?=$i[Penznem]?></td>
      <td><?=ezres($i[Fuvardij])?>&nbsp;<?=$i[Penznem]?></td>
      <td><?=$i[FizetesiHatarido]?></td>
      <td><?=$i[FizetesStatusza]?><?php
      if($i[FizetesStatusza]==F_S_FIZETVE){
        ?>
        <br />
        <?=$i[FizetesDatuma]?>
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
