<?php

function woodTypesRadioButtons($supply=true){
    foreach(array_keys(FATIPUSOK) as $rk){
        if($supply){$me  = woodGetSumByType($rk);}
?>
    <div class="radio">
        <label for="r_cs_<?=$rk?>">
            <input type="radio" name="r_cs" id="r_cs_<?=$rk?>" value="<?=$rk?>" <?=($rk==array_keys(FATIPUSOK)[0]? ' checked="checked"': '')?> >
            <span style="width: 3em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=FATIPUSOK[$rk][0]?>" style="height:2em;" /></span>
            <b><?=FATIPUSOK[$rk][0]?></b>
            <?php if($supply){?> <span class="label label-<?=($me>10?'success':($me<0?'danger':'warning'))?>"><?=$me?>&nbsp;<?=U_NAMES[U_STD][1]?></span>
                <?php }?>
        </label>
    </div>
    <?php
    }
}

function woodAdd($fatipus, $mennyiseg, $beszallito, $szamlaszam, $szallitolevelszam, $datum, $megjegyzes, $forgalom, $refID=0){
    global $db;
    $db->insert('faanyag', [
        'Fatipus' => $fatipus,
        'Mennyiseg' => $mennyiseg,
        'Beszallito' => $beszallito,
        'Szamlaszam' => $szamlaszam,
        'Szallitolevelszam' =>$szallitolevelszam,
        'Datum' => $datum,
        'Megjegyzes' => $megjegyzes,
        'Forgalom' => $forgalom,
        'RefID' => $refID
    ]);
    
}

function woodGetSuppliers(){
    global $db;
    return $db->select('faanyag', 'Beszallito', ['GROUP'=>'Beszallito']);
    
}


function woodGetSumByType($type){
    global $db;
    return rnd($db->sum('faanyag', 'Mennyiseg', ["AND"=> ['Fatipus'=>$type, 'Deleted'=>0]]));
}

function woodGetDetailsByType($type){
    global $db;
    return $db->select('faanyag', ['ID', 'Mennyiseg', 'Beszallito', 'Szamlaszam', 'Szallitolevelszam', 'Datum', 'Megjegyzes','Forgalom'], ["AND"=>['Fatipus'=>$type, 'Deleted'=>0]]);
}

function woodGetStock(){
    global $db;
    return $db->select('faanyag', ['ID', 'Mennyiseg', 'Beszallito', 'Fatipus','Szamlaszam', 'Szallitolevelszam', 'Datum', 'Megjegyzes','Forgalom'], ["AND"=>[ 'Deleted'=>0, 'Forgalom'=>FORGALOM_BEVETEL]]);
    //FIXME - le kell vonni a felhasznalast
}

function woodGetMaxQty($type){
    global $db;
    return max([$db->max('faanyag','Mennyiseg', ['Fatipus'=>$type]), -1.0*$db->min('faanyag','Mennyiseg', ["AND"=>['Fatipus'=>$type, 'Deleted'=>0]])]);
}

function woodDel($id){
    global $db;
    $db->update('faanyag',['Deleted'=>1],['ID'=>$id]);
}

function woodJsUnitConversion(){
    ?>
        <script>
            var factor = 1.0;

            function btnClick(btn, txt, fact) {
                <?php foreach(array_keys(U_NAMES) as $un){?>
                $('#me_btn_<?=$un?>').removeClass().addClass('btn btn-default');
                <?php } ?>
                btn.addClass('btn-primary');
                $("#mertekegyseg").html(txt);
                factor = fact;
                recalc();
            }

            function recalc() {
                cval = parseFloat($('#mennyiseg').val()) / factor;
                if (isNaN(cval)) {
                    cval = 0;
                }
                $("#cmenny").html('' + Math.round(cval * 100) / 100.0 + ' <?=U_NAMES[U_STD][0]?>');
                $("#cmennyiseg").val(Math.round(cval * 100) / 100.0);
            }
        </script>
        <?php
}

?>