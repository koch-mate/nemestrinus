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
<div style="max-height:300px;overflow:auto;">
<?php
$d= $db->select('megrendeles', ['ID', 'Tipus', 'MegrendeloID', 'SzamlaSzam', 'MegrendeloNev', 'FizetesiHatarido', 'Vegosszeg', 'Penznem', 'FizetesiHatarido'], ['AND'=>['Deleted'=>0, 'Penznem'=>$p, 'Statusz'=>M_S_TELJESITVE, 'SzallitasStatusza'=>SZ_S_LESZALLITVA, 'FizetesStatusza'=>F_S_FIZETESRE_VAR, 'FizetesiHatarido[<]'=>date('Y-m-d')], 'ORDER'=>['FizetesiHatarido'=>'ASC']]);
if(empty($d)){
  ?>
<p>
<em>A nincs lejárt fizetésű, kiszállított rendelés.</em>
</p>
  <?php
}
  else{
 ?>
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

    foreach($d as $di){
?>
      <tr>
        <th><a href="?mode=megrendeles-osszesites&id=<?=$di['ID']?>"><?=$di['ID']?></a></th>
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
<?php } ?>
</div>
<p style="margin-top:2em;">
  A tárgyévben (<?=$ev?>) <i>teljesített/teljesítendő</i> megrendelések:
</p>


  <?php

  $fh    = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<KertDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> <= <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))"));
  $fht   = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<KertDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> > <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))"));
  $nfh   = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<KertDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' <= <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))"));
  $nfht  = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<KertDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <SzallitasStatusza> != '".SZ_S_LESZALLITVA."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))"));
  $nfhtk = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<KertDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <SzallitasStatusza> =  '".SZ_S_LESZALLITVA."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))"));
  $vv    = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<KertDatum> BETWEEN '".$ev."-01-01' AND '".$ev."-12-31') AND <Penznem> = '".$p."' AND <Statusz> IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))"));

   ?>



<table class="table">
  <tr>
    <th>F+FHT</th>
    <th>Teljes bevétel </th>
    <th><span class="badge badge-pill " ><?=ezres($fh+$fht)?>&nbsp;<?=$p?></span></th>
  </tr>
  <tr>
    <td>F</td>
    <td>Határidőig <?=($p==P_EURO?'kifizetett':'kiszállított')?> megrendelések a tárgyévben </td>
    <td><span class="badge badge-pill " style="background:rgb(2 , 124, 0);"><?=ezres($fh)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <td>FHT  </td>
    <td>Határidőn túl <?=($p==P_EURO?'kifizetett':'kiszállított')?> megrendelések a tárgyévben  </td>
    <td><span class="badge badge-pill "  style="background:rgb(125, 189, 48)"><?=ezres($fht)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <th>NF+NFHT+NFHTK</th>
    <th>Teljes kintlevőség </th>
    <th><span class="badge badge-pill " ><?=ezres($nfh+$nfht+$nfhtk)?>&nbsp;<?=$p?></span></th>
  </tr>

  <tr>
    <td>NF  </td>
    <td>Határidőn belüli, <?=($p==P_EURO?'fizetésre':'szállításra')?> váró megrendelések  </td>
    <td>  <span class="badge badge-pill "  style="background:orange"><?=ezres($nfh)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <td>NFHT  </td>
    <td>Lejárt határidejű,  <?=($p==P_EURO?'kifizetetetlen,':'')?> még nem kiszállított megrendelések  </td>
    <td>  <span class="badge badge-pill "  style="background:rgb(169, 3, 6)"><?=ezres($nfht)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <td>NFHTK  </td>
    <td>Lejárt határidejű, kifizetetlen, kiszállított megrendelések  </td>
    <td><span class="badge badge-pill "  style="background:rgb(249, 3, 6)"><?=ezres($nfhtk)?>&nbsp;<?=$p?></span></td>
  </tr>
  <tr>
    <th>VV</th>
    <th>Visszamondott és visszautasított rendelések </th>
    <th><span class="badge badge-pill " ><?=ezres($vv)?>&nbsp;<?=$p?></span></th>
  </tr>

</table>

    <canvas id="fiz_<?=$p?>" width="400" height="400"></canvas>

    <script type="text/javascript">
    new Chart(
      document.getElementById("fiz_<?=$p?>"),
      {
        type : "doughnut",
        options : {
          responsive : true,
          tooltips: {
            mode: 'index',
            callbacks: {
              label: function(tooltipItems, data) {
                return (data.labels[tooltipItems.index])+" "+numberWithCommas(data.datasets[0].data[tooltipItems.index])+" "+ '<?=$p?>';
              },
            },
            footerFontStyle: 'normal'
          },
          hover: {
            mode: 'index',
            intersect: true
          },
        },
        data: {
          labels : [
            "F: <?=($p==P_EURO?'fizetve':'szállítva')?> határidőig",
            "FHT: <?=($p==P_EURO?'fizetve':'szállítva')?> határidőn túl",
            "NF: nincs <?=($p==P_EURO?'fizetve':'szállítva')?>, határidőn belül",
            "NFHT: nincs fizetve, határidőn túl, nincs kiszállítva",
            "NFHTK: nincs fizetve, határidőn túl, kiszállítva",
            "VV: visszamondott és visszautasított"
          ],
          datasets : [
            {
              label : "<?=$p?>",
              data : [<?=rnd($fh)?>,<?=rnd($fht)?>,<?=rnd($nfh)?>,<?=rnd($nfht)?>,<?=rnd($nfhtk)?>,<?=rnd($vv)?>],
              backgroundColor : [
                "rgb(2 , 54, 0)",
                "rgb(125, 189, 48)",
                "rgb(255, 165, 0)",
                "rgb(169, 3, 6)",
                "rgb(249, 3, 6)",
                "rgb(90,70,70)"
              ]
            }
          ]
        }
      }
    );

    </script>


<div>
  <h3>Havi bontás - <?=$p?></h3>
  <canvas id="fizhavi_<?=$p?>" width="400" height="600"></canvas>
  <script>
    var myBarChart = new Chart($('#fizhavi_<?=$p?>'), {
      type: 'horizontalBar',
      data: {
        labels: ["<?=implode('", "', array_values(MONTHS))?>"],
        datasets: [

<?php

$labels = [
    "F: ".($p==P_EURO?'fizetve':'szállítva')." határidőig",
    "FHT: ".($p==P_EURO?'fizetve':'szállítva')." határidőn túl",
    "NF: nincs ".($p==P_EURO?'fizetve':'szállítva').", határidőn belül",
    "NFHT: nincs fizetve, határidőn túl, nincs kiszállítva",
    "NFHTK: nincs fizetve, határidőn túl, kiszállítva",
    "VV: visszamondott és visszautasított"
];
$bgs = [
  "rgb(2 , 54, 0)",
  "rgb(125, 189, 48)",
  "rgb(255, 165, 0)",
  "rgb(169, 3, 6)",
  "rgb(249, 3, 6)",
  "rgb(90,70,70)"
];
$sql= [
"' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> <= <FizetesiHatarido>  AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))",
"' AND <FizetesStatusza> = '".F_S_FIZETVE."' AND <FizetesDatuma> > <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))",
"' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' <= <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))",
"' AND <SzallitasStatusza> != '".SZ_S_LESZALLITVA."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))",
"' AND <SzallitasStatusza> =  '".SZ_S_LESZALLITVA."' AND <FizetesStatusza> = '".F_S_FIZETESRE_VAR."' AND '".date('Y-m-d')."' > <FizetesiHatarido> AND <Statusz> NOT IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'))",
"' AND <Statusz> IN ('".M_S_VISSZAUTASITVA."', '".M_S_VISSZAMONDOTT."'));"
];

for($i = 0; $i<6; $i ++){
    echo "{".PHP_EOL;
    echo "label: '".$labels[$i]."',".PHP_EOL;
    echo "backgroundColor: '".$bgs[$i]."',".PHP_EOL;
    echo "data: [".PHP_EOL;
    for($m = 1; $m<=12; $m ++){
      $fromDate = $ev."-".$m."-01";
      $toDate = date("Y-m-t", strtotime($fromDate));

      $fh   = 0+$db->sum('megrendeles', 'Vegosszeg', Medoo::raw("WHERE (<Deleted> = 0 AND (<KertDatum> BETWEEN '".$fromDate."' AND '".$toDate."') AND <Penznem> = '".$p.$sql[$i]));
      echo rnd($fh).",".PHP_EOL;
    }
    echo "]},".PHP_EOL;
  }
?>

]},
      options: {
          scales: {
              xAxes: [{
                  stacked: true
              }],
              yAxes: [{
                  stacked: true
              }]
          },
          legend: false,
          responsive : true,
          hover: {
            mode: 'index',
            intersect: true
          },

        }


    });

    function randomScalingFactor () {
		return Math.round(Math.random()*100);
	};
  </script>
</div>

</div>

<?php }
?>

</div>
