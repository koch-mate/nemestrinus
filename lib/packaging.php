<?php

function packagingAdd($tipus,$menny,$szlsz,$datum,$megj,$forg,$mid=0){
    global $db;
    $db->insert('csomagoloanyag', ['Tipus'=>$tipus, 'Mennyiseg'=>$menny, 'Szamlaszam'=>$szlsz, 'Datum'=>$datum, 'Megjegyzes'=>$megj, 'Forgalom'=>$forg, 'MegrendelesTetelID'=>$mid]);
}

function packagingGetSumByType($type){
    global $db;
    return $db->sum('csomagoloanyag', 'Mennyiseg', ["AND"=> ['Tipus'=>$type, 'Deleted'=>0]]);
}

function packagingGetDetailsByType($type){
    global $db;
    return $db->select('csomagoloanyag', ['ID', 'Mennyiseg', 'Szamlaszam', 'Datum', 'Megjegyzes','Forgalom', 'MegrendelesTetelID'], ["AND"=>['Tipus'=>$type, 'Deleted'=>0]]);
}

function packagingGetMaxQty($type){
    global $db;
    return max([$db->max('csomagoloanyag','Mennyiseg', ['Tipus'=>$type]), -1.0*$db->min('csomagoloanyag','Mennyiseg', ["AND"=>['Tipus'=>$type, 'Deleted'=>0]])]);
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

function packagingDel($id){
    global $db;
    $db->update('csomagoloanyag',['Deleted'=>1],['ID'=>$id]);
}

function packagingUseForProduction($mid,$id){ // megrendeles ID, megrendeles tetel ID
    global $db;
    // get package type
    $dat = $db->get('megrendeles_tetel', ['Csomagolas','Mennyiseg'], ['ID'=>$id]);
    // szukseges csomagoloanyagok
    foreach(array_keys(CS_FELHASZNALAS[$dat['Csomagolas']]) as $csa){
        if(CS_FELHASZNALAS[$dat['Csomagolas']][$csa] > 0){
            packagingAdd($csa,CS_FELHASZNALAS[$dat['Csomagolas']][$csa]*$dat['Mennyiseg'],'',date('Y-m-d'),'',FORGALOM_FELHASZNALAS,$mid=$id);
        }
    }
    
}
?>