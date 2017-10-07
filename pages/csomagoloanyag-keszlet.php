<h1>Csomagolóanyag raktárkészlet</h1>

<div class="alert alert-info" role="alert">A raktárkészlet csak az aktuális készletet jeleníti meg. A <a href="?mode=faanyag-keszletmozgas">Készletmozgás</a> menü alatt minden bevételezés, értékesítés, felhasználás és korrekció megjelenik.</div>

<div style="text-align:center;">

<?php
foreach (array_keys(CSOMAGOLOANYAGOK) as $rk) {
    $me  = packagingGetSumByType($rk); ?>
        <div style="margin-top:1em;">
          <span style="width: 6em; display:inline-block;"><img src="/img/<?=$rk?>.png" title="<?=CSOMAGOLOANYAGOK[$rk][0]?>" style="height:3em;" /></span>
          <b><?=CSOMAGOLOANYAGOK[$rk][0]?></b> <span class="label label-<?=($me>10?'success':($me<0?'danger':'warning'))?>"><?=rnd($me*10)/10?>&nbsp;<?=CSOMAGOLOANYAGOK[$rk][1]?></span>
        </div>
<?php
}
?>
</div>
