<script src="js/Chart.min.js"></script>
<h1>Áttekintés</h1>

<?php $ev = date('Y'); ?>

<div class="row">

<?php

use Medoo\Medoo;

foreach([P_EURO, P_FORINT] as $p){ ?>
  <div class="col-md-4 clearfix">

  <h3>Lejárt határidejű, befizetetlen, teljesített megrendelések - <?=$p?></h3>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>T</th>
        <th>Megrendelő</th>
        <th>Összeg</th>
        <th>Fizetési határidő lejárt</th>
      </tr>
    </thead>
    <tbody>
      <?php
    $d= $db->select('megrendeles', ['ID', 'Tipus', 'MegrendeloID', 'MegrendeloNev', 'FizetesiHatarido', 'Vegosszeg', 'Penznem', 'FizetesiHatarido'], ['AND'=>['Deleted'=>0, 'Penznem'=>$p, 'Statusz'=>M_S_TELJESITVE, 'SzallitasStatusza'=>SZ_S_LESZALLITVA, 'FizetesStatusza'=>F_S_FIZETESRE_VAR, 'FizetesiHatarido[<]'=>date('Y-m-d')], 'ORDER'=>['FizetesiHatarido'=>'ASC']]);

    foreach($d as $di){
?>
      <tr>
        <th><a href="?mode=megrendeles-osszesites&id=<?=$di[ID]?>"><?=$di[ID]?></a></th>
        <td><span class="glyphicon glyphicon-<?=($di['Tipus']==M_LAKOSSAGI ? 'home" title="lakossági':'globe" title="export')?>" aria-hidden="true"></span></td>
        <td><?=($di['Tipus']==M_LAKOSSAGI ? $di['MegrendeloNev'] : exportCustomerGetNameById($di['MegrendeloID']))?></td>
        <td style="text-align:right;"><?=$di['Vegosszeg']?>&nbsp;<?=$di['Penznem']?></td>
        <td style="text-align:right;"><?=daysToToday($di['FizetesiHatarido'])?>&nbsp;napja</td>
      </tr>
  <?php

}
   ?>
 </tbody>
</table>

  <?php

  $fh   = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> <= <FizetesiHatarido>)"));
  $fht  = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> > <FizetesiHatarido>)"));
  $nfh  = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' <= <FizetesiHatarido>)"));
  $nfht = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND <SzallitasStatusza> != '".SZ_S_LESZALLITVA."' AND(<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido>)"));
  $nfhtk = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND <SzallitasStatusza> = '".SZ_S_LESZALLITVA."' AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido>)"));

   ?>

    <p>
      Minden adat a tárgyévben (<?=$ev?>) <i>rögzített</i> megrendelésekre vonatkozik.
      <ul>
        <li>
          F - Határidőig kifizetett megrendelések a tárgyévben: <?=ezres($fh)?>&nbsp;<?=$p?>
        </li>
        <li>
          FHT - Határidőn túl kifizetett megrendelések a tárgyévben: <?=ezres($fht)?>&nbsp;<?=$p?>
        </li>
        <li>
          NF - Határidőn belüli, fizetésre váró megrendelések: <?=ezres($nfh)?>&nbsp;<?=$p?>
        </li>
        <li>
          NFHT - Lejárt határidejű, kifizetetlen, még nem kiszállított megrendelések: <?=ezres($nfht)?>&nbsp;<?=$p?>
        </li>
        <li>
          NFHTK - Lejárt határidejű, kifizetetlen, kiszállított megrendelések: <?=ezres($nfhtk)?>&nbsp;<?=$p?>
        </li>
      </ul>
    </p>
    <canvas id="fiz_<?=$p?>" width="400" height="400"></canvas>

    <script type="text/javascript">

    new Chart(
      document.getElementById("fiz_<?=$p?>"),
      {
        "type" : "doughnut",
        "data": {
          "labels" : ["F","FHT","NF","NFHT","NFHTK"],
          "datasets" : [
            {
              "label" : "<?=$p?>",
              "data" : [<?=rnd($fh)?>,<?=rnd($fht)?>,<?=rnd($nfh)?>,<?=rnd($nfht)?>,<?=rnd($nfhtk)?>],
              "backgroundColor" : [
                "rgb(2 , 54, 0)",
                "rgb(205, 239, 48)",
                "rgb(90, 150, 19)",
                "rgb(169, 3, 6)",
                "rgb(249, 3, 6)"
              ]
            }
          ]
        }
      }
    );

    </script>
</div>

<?php }
?>

</div>
