<script src="js/Chart.min.js"></script>
<h1>Áttekintés</h1>

<?php $ev = date('Y'); ?>

<div class="row" style=";">

<?php

use Medoo\Medoo;

foreach([P_EURO, P_FORINT] as $p){ ?>
  <?php

  $fh   = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> <= <FizetesiHatarido>)"));
  $fht  = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> > <FizetesiHatarido>)"));
  $nfh  = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' <= <FizetesiHatarido>)"));
  $nfht = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND <SzallitasStatusza> != '".SZ_S_LESZALLITVA."' AND(<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido>)"));
  $nfhtk = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND <SzallitasStatusza> = '".SZ_S_LESZALLITVA."' AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido>)"));

   ?>

  <div class="col-md-4 clearfix">
    <h3>Fizetési státusz - <?=$p?></h3>
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
          NFHT - Lejárt határidejű, befizetetlen, még nem kiszállított megrendelések: <?=ezres($nfht)?>&nbsp;<?=$p?>
        </li>
        <li>
          NFHTK - Lejárt határidejű, befizetetlen, kiszállított megrendelések: <?=ezres($nfhtk)?>&nbsp;<?=$p?>
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
