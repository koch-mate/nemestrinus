<script src="js/Chart.min.js"></script>

<script>
function toInt(n){ return Math.round(Number(n)); };
const numberWithCommas = (x) => {
  x=toInt(x);
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


</script>
<h1>Áttekintés</h1>

<?php $ev = date('Y'); ?>

<div class="row">

<?php

use Medoo\Medoo;

foreach([P_EURO, P_FORINT] as $p){ ?>
  <div class="col-md-4 clearfix" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">

  <h3>Lejárt határidejű, befizetetlen, teljesített megrendelések - <?=$p?></h3>
  <p>
    Minden adat a tárgyévben (<?=$ev?>) <i>rögzített</i> megrendelésekre vonatkozik.
  </p>
<div style="max-height:300px;overflow:auto;">

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>T</th>
        <th>Megrendelő</th>
        <th style="text-align:right;">Számlaszám</th>
        <th style="text-align:right;">Összeg</th>
        <th style="text-align:right;">Fizetési<br />határidő<br />lejárt</th>
      </tr>
    </thead>
    <tbody>
      <?php
    $d= $db->select('megrendeles', ['ID', 'Tipus', 'MegrendeloID', 'SzamlaSzam', 'MegrendeloNev', 'FizetesiHatarido', 'Vegosszeg', 'Penznem', 'FizetesiHatarido'], ['AND'=>['Deleted'=>0, 'Penznem'=>$p, 'Statusz'=>M_S_TELJESITVE, 'SzallitasStatusza'=>SZ_S_LESZALLITVA, 'FizetesStatusza'=>F_S_FIZETESRE_VAR, 'FizetesiHatarido[<]'=>date('Y-m-d')], 'ORDER'=>['FizetesiHatarido'=>'ASC']]);

    foreach($d as $di){
?>
      <tr>
        <th><a href="?mode=megrendeles-osszesites&id=<?=$di[ID]?>"><?=$di[ID]?></a></th>
        <td><span class="glyphicon glyphicon-<?=($di['Tipus']==M_LAKOSSAGI ? 'home" title="lakossági':'globe" title="export')?>" aria-hidden="true"></span></td>
        <td><?=($di['Tipus']==M_LAKOSSAGI ? $di['MegrendeloNev'] : exportCustomerGetNameById($di['MegrendeloID']))?></td>
        <td style="text-align:right;"><?=$di['SzamlaSzam']?></td>
        <td style="text-align:right;"><?=$di['Vegosszeg']?>&nbsp;<?=$di['Penznem']?></td>
        <td style="text-align:right;"><?=daysToToday($di['FizetesiHatarido'])?>&nbsp;napja</td>
      </tr>
  <?php

}
   ?>
 </tbody>
</table>
</div>

  <?php

  $fh   = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> <= <FizetesiHatarido>)"));
  $fht  = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> > <FizetesiHatarido>)"));
  $nfh  = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' <= <FizetesiHatarido>)"));
  $nfht = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND <SzallitasStatusza> != '".SZ_S_LESZALLITVA."' AND(<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido>)"));
  $nfhtk = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND <SzallitasStatusza> = '".SZ_S_LESZALLITVA."' AND (<RogzitesDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido>)"));

   ?>



<table class="table">
  <tr>
    <td>F</td>
    <td>Határidőig kifizetett megrendelések a tárgyévben: </td>
    <td><span class="badge badge-pill " style="background:rgb(2 , 124, 0);"><?=ezres($fh)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <td>FHT  </td>
    <td>Határidőn túl kifizetett megrendelések a tárgyévben:  </td>
    <td><span class="badge badge-pill "  style="background:rgb(125, 189, 48)"><?=ezres($fht)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <td>NF  </td>
    <td>Határidőn belüli, fizetésre váró megrendelések:  </td>
    <td>  <span class="badge badge-pill "  style="background:rgb(120, 150, 19)"><?=ezres($nfh)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <td>NFHT  </td>
    <td>Lejárt határidejű, kifizetetlen, még nem kiszállított megrendelések:  </td>
    <td>  <span class="badge badge-pill "  style="background:rgb(169, 3, 6)"><?=ezres($nfht)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <td>NFHTK  </td>
    <td>Lejárt határidejű, kifizetetlen, kiszállított megrendelések:  </td>
    <td><span class="badge badge-pill "  style="background:rgb(249, 3, 6)"><?=ezres($nfhtk)?>&nbsp;<?=$p?></span></td>
  </tr>
</table>

    <canvas id="fiz_<?=$p?>" width="400" height="400"></canvas>

    <script type="text/javascript">
    new Chart(
      document.getElementById("fiz_<?=$p?>"),
      {
        "type" : "doughnut",
        "options" : {
          "responsive" : true,
          "tooltips": {
            "mode": 'index',
            "callbacks": {
              label: function(tooltipItems, data) {
                return (data.labels[tooltipItems.index])+" "+numberWithCommas(data.datasets[0].data[tooltipItems.index])+" "+ '<?=$p?>';
              },
            },
            "footerFontStyle": 'normal'
          },
          "hover": {
            "mode": 'index',
            "intersect": true
          },
        },
        "data": {
          "labels" : ["F: fizetve határidőig","FHT: fizetve határidőn túl","NF: nincs fizetve, határidőn belül","NFHT: nincs fizetve, határidőn túl, nincs kiszállítva","NFHTK: nincs fizetve, határidőn túl, kiszállítva"],
          "datasets" : [
            {
              "label" : "<?=$p?>",
              "data" : [<?=rnd($fh)?>,<?=rnd($fht)?>,<?=rnd($nfh)?>,<?=rnd($nfht)?>,<?=rnd($nfhtk)?>],
              "backgroundColor" : [
                "rgb(2 , 54, 0)",
                "rgb(125, 189, 48)",
                "rgb(120, 150, 19)",
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
