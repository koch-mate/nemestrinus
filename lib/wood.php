<?php

function woodTypesRadioButtons(){
    foreach(array_keys(FATIPUSOK) as $rk){
?>
    <div class="radio">
        <label for="r_cs_<?=$rk?>">
            <input type="radio" name="r_cs" id="r_cs_<?=$rk?>" value="<?=$rk?>" <?=($rk==array_keys(FATIPUSOK)[0]? ' checked="checked"': '')?> >
            <span style="width: 3em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=FATIPUSOK[$rk][0]?>" style="height:2em;" /></span>
            <b><?=FATIPUSOK[$rk][0]?></b>
        </label>
    </div>
    <?php
    }
}

function woodAdd($fatipus, $mennyiseg, $beszallito, $szamlaszam, $szallitolevelszam, $datum, $megjegyzes){
    global $db;
    $db->insert('faanyag', [
        'Fatipus' => $fatipus,
        'Mennyiseg' => $mennyiseg,
        'Beszallito' => $beszallito,
        'Szamlaszam' => $szamlaszam,
        'Szallitolevelszam' =>$szallitolevelszam,
        'Datum' => $datum,
        'Megjegyzes' => $megjegyzes
    ]);
    
}

function woodGetSuppliers(){
    global $db;
    return $db->select('faanyag', 'Beszallito', ['GROUP'=>'Beszallito']);
    
}

?>