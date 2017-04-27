<div>
    <table class="table table-striped table-hover display">
        <thead style="font-weight:bold;">
            <tr>
                <td>Fafaj</td>
                <td>Készlet</td>
                <td>Előjegyzés</td>
                <td>Különbség</td>
            </tr>
        </thead>
        <tbody>
            <?php
        foreach(array_keys(FATIPUSOK) as $rk){ 
                $keszlet  = rnd(woodGetSumByType($rk));
                $elojegyzes = rnd(orderGetFutureSumByType($rk));

            ?>
                <tr>
                    <td>
                        <span style="width: 2em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=FATIPUSOK[$rk][0]?>" style="height:1em;" /></span><?=FATIPUSOK[$rk][0]?>
                    </td>
                    <td>
                        <?=spanify($keszlet)?>
                    </td>
                    <td>
                        <?=spanify($elojegyzes, $min = ($keszlet-$elojegyzes < 0 ? $elojegyzes+1 : 0), $max = ($keszlet-$elojegyzes < 0 ? $elojegyzes + 2 : 0))?>
                    </td>
                    <td>
                        <?=spanify($keszlet-$elojegyzes)?>
                    </td>
                </tr>

                <?php }?>
        </tbody>
    </table>
</div>
