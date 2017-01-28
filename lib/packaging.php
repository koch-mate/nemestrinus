<?php

function packagingAdd($tipus,$menny,$szlsz,$datum,$megj,$forg){
    global $db;
    $db->insert('csomagoloanyag', ['Tipus'=>$tipus, 'Mennyiseg'=>$menny, 'Szamlaszam'=>$szlsz, 'Datum'=>$datum, 'Megjegyzes'=>$megj, 'Forgalom'=>$forg]);
}

function packagingGetSumByType($type){
    global $db;
    return $db->sum('csomagoloanyag', 'Mennyiseg', ['Tipus'=>$type]);
}

function packagingGetDetailsByType($type){
    global $db;
    return $db->select('csomagoloanyag', ['ID', 'Mennyiseg', 'Szamlaszam', 'Datum', 'Megjegyzes','Forgalom'], ['Tipus'=>$type]);
}

function packagingGetMaxQty($type){
    global $db;
    return max([$db->max('csomagoloanyag','Mennyiseg', ['Tipus'=>$type]), -1.0*$db->min('csomagoloanyag','Mennyiseg', ['Tipus'=>$type])]);
}

function packagingRadioButtons(){
    foreach(array_keys(CSOMAGOLOANYAGOK) as $rk){
        $me  = packagingGetSumByType($rk);
?>
    <div class="radio">
        <label for="r_cs_<?=$rk?>">
            <input type="radio" onclick=" $('#menny_me').html('<?=CSOMAGOLOANYAGOK[$rk][1]?>');" name="r_cs" id="r_cs_<?=$rk?>" value="<?=$rk?>" <?=($rk==array_keys(CSOMAGOLOANYAGOK)[0]? ' checked="checked"': '')?> >
            <span style="width: 6em; display:inline-block;"><img src="/img/<?=$rk?>.png" title="<?=CSOMAGOLOANYAGOK[$rk][0]?>" style="height:3em;" /></span>
            <b><?=CSOMAGOLOANYAGOK[$rk][0]?></b> <span class="label label-<?=($me>10?'success':($me<0?'danger':'warning'))?>"><?=$me?>&nbsp;<?=CSOMAGOLOANYAGOK[$rk][1]?></span>
        </label>
    </div>
    <?php
                }
}
?>