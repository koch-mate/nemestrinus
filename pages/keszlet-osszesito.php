<?php
?>
<h1>Készlet összesítő</h1>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Fatípus</th>
            <th style="text-align:center;">Aktuális készlet</th>
            <th></th>
            <th style="text-align:center;">Előjegyzés</th>
            <th></th>
            <th style="text-align:center;">Maradék</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach(array_keys(FATIPUSOK) as $rk){
    $keszlet  = woodGetSumByType($rk);
    $elojegyzes = orderGetFutureSumByType($rk);
?>
        <tr>
            <th>
                <label for="r_cs_<?=$rk?>">
                    <span style="width: 3em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=FATIPUSOK[$rk][0]?>" style="height:2em;" /></span>
                    <b><?=FATIPUSOK[$rk][0]?></b>
                </label>
            </th>
            <td style="text-align:center;">
                <?=spanify($keszlet)?>
            </td>
            <td><span class="glyphicon glyphicon-minus"></span></td>
            <td style="text-align:center;">
                <?=spanify($elojegyzes, $min = ($keszlet-$elojegyzes < 0 ? $elojegyzes+1 : 0), $max = ($keszlet-$elojegyzes < 0 ? $elojegyzes + 2 : 0))?>
            </td>
            <td><span class="glyphicon glyphicon-arrow-right"></span></td>
            <td style="text-align:center;">
                <?=spanify($keszlet-$elojegyzes)?>
            </td>
        </tr>
    <?php
    }

?>
    </tbody>
</table>