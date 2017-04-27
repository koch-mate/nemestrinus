<h1>Függő megrendelések</h1>

<?php function spanify($x, $min=0, $max=0){ ?>
    <span class="label label-<?=($x>$max?'success':($x<$min?'danger':'default'))?>"><?=($x==0?'-':$x)?>&nbsp;<?=U_NAMES[U_STD][1]?></span>
<?php }

$cm = intval(date('m'));
$cy = intval(date('Y'));
?>
<div style="overflow-x:auto;">
    <style>
        td {
            text-align: right;
        }
        br {
            
        }
    </style>
<table class="table table-hover table-striped">
    <thead >
        <tr>
            <th rowspan="2">Fatípus</th>
            <th rowspan="2"></th>
            <th rowspan="2">Aktuális készlet</th>
            <th colspan="12" style="text-align:center;">Havi előjegyzés</th>
        </tr>
        <tr>
            <th><?=$cy?>.<br><?=mb_ucfirst(MONTHS[$cm])?><br>(és&nbsp;korábbi)</th>
<?php for($i=$cm; $i<$cm+11; $i++){ ?>
            <th><?php if($i%12+1==1){ ?><?=($cy+1)?>.<br><?php } ?>
                <?=mb_ucfirst(MONTHS[$i % 12+1])?>
                <?php if($i == $cm + 11-1){?><br>(és&nbsp;későbbi)<?php } ?>
            </th>
    
<?php } ?>
            
        </tr>
    </thead>
    <tbody>
<?php
foreach(array_keys(FATIPUSOK) as $rk){
?>
        <tr>
            <th style="width:10em;text-align:center;">
                <label for="r_cs_<?=$rk?>">
                    <span style="width: 3em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=FATIPUSOK[$rk][0]?>" style="height:2em;" /></span>
                    <b><?=FATIPUSOK[$rk][0]?></b>
                </label>
            </th>
            <?php
                $keszlet  = woodGetSumByType($rk);
                $elojegyzes = orderGetFutureSumByTypeBetweenDates($rk, "2000-01-01", date("Y-m-t", mktime(0,0,0,$cm, 15,$cy)));

            ?>
            <th style="white-space:nowrap;">
                <p>Havi előjegyzés:</p><p>Kumulált készlet:</p> 
            </td>
            <td>
                <p>&nbsp;</p>
                <p><?=spanify($keszlet)?></p>
            </td>
            <td>
                <p><?=spanify($elojegyzes)?></p>
                <p><?=spanify($keszlet-$elojegyzes)?></p>
            </td>
            <?php 
                $keszlet -= $elojegyzes;
                for($i=$cm; $i<$cm+10; $i++){
                    $elojegyzes = orderGetFutureSumByTypeBetweenDates($rk, date("Y-m-d", mktime(0,0,0,$i+1, 1, $cy)), date("Y-m-t", mktime(0,0,0,$i+1, 15, $cy)));
                    $keszlet -= $elojegyzes;
                ?>
            <td>
                <p><?=spanify($elojegyzes)?></p>
                <p><?=spanify($keszlet)?></p>
            </td>
            
            <?php
                
            }
            
            ?>
            <td>
                <?php 
                $elojegyzes = orderGetFutureSumByTypeBetweenDates($rk, date("Y-m-d", mktime(0,0,0,$i+11, 1, $cy)), date("Y-m-t", mktime(0,0,0,$i+1, 15, 2099)));

                ?>
                <p><?=spanify($elojegyzes)?></p>
                <p><?=spanify($keszlet-$elojegyzes)?></p>
            </td>
            
        </tr>
    <?php
    }

?>
    </tbody>
</table>
</div>