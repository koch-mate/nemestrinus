<?php
use Medoo\Medoo;

function woodTypesRadioButtons($supply=true, $callback=""){
    foreach(array_keys(FATIPUSOK) as $rk){
        if($supply){$me  = woodGetSumByType($rk);}
?>
    <div class="radio">
        <label for="r_cs_<?=$rk?>">
            <input type="radio" name="r_cs" id="r_cs_<?=$rk?>" value="<?=$rk?>" onchange="<?=$callback?>" <?=($rk==array_keys(FATIPUSOK)[0]? ' checked="checked"': '')?> >
            <span style="width: 3em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=FATIPUSOK[$rk][0]?>" style="height:2em;" /></span>
            <b><?=FATIPUSOK[$rk][0]?></b>
            <?php if($supply){?> <span class="label label-<?=($me>10?'success':($me<0?'danger':'warning'))?>"><?=number_format(rnd($me), 2, '.', ' ' )?>&nbsp;<?=U_NAMES[U_STD][1]?></span>
                <?php }?>
        </label>
    </div>
    <?php
    }
}

function woodAdd($fatipus, $mennyiseg, $beszallito, $szamlaszam, $szallitolevelszam, $datum, $megjegyzes, $forgalom, $ekaer, $cmr, $fuvarozo, $knkod, $import, $kitermeles, $faanyagID=null, $megrendelesTetelID=null){
    global $db;
      $db->insert('faanyag', [
        'Fatipus' => $fatipus,
        'Mennyiseg' => $mennyiseg,
        'BeszallitoID' => $beszallito,
        'Szamlaszam' => $szamlaszam,
        'Szallitolevelszam' =>$szallitolevelszam,
        'EKAER' => $ekaer,
        'CMR' => $cmr,
        'Fuvarozo' => $fuvarozo,
        'Datum' => $datum,
        'Megjegyzes' => $megjegyzes,
        'Forgalom' => $forgalom,
        'FaanyagID' => $faanyagID,
        'MegrendelesTetelID' => $megrendelesTetelID,
        'KNkod'=>  $knkod,
        'ImportSzarmazas'=>  $import,
        'KitermelesHelye'=>  $kitermeles
    ]);
}

function woodGetSuppliers(){
    global $db;
    return $db->select('faanyag', 'Beszallito', ['GROUP'=>'Beszallito']);
}

function woodGetUsageByWoodID($wid){
  global $db;
  return $db->select('faanyag', ['ID', 'Mennyiseg', 'MegrendelesTetelID', 'Forgalom'], ['Deleted'=>0, 'FaanyagID'=>$wid]);
}

function woodGetSumByType($type){
    global $db;
    return rnd($db->sum('faanyag', 'Mennyiseg', ["AND"=> ['Fatipus'=>$type, 'Deleted'=>0]]));
}

function woodGetAllByTrafficAndDate($forg, $sd, $ed){
    global $db;
    return $db->select('faanyag', ['ID', 'Mennyiseg', 'Beszallito', 'BeszallitoID', 'Szamlaszam', 'Fatipus','Szallitolevelszam', 'EKAER', 'CMR', 'Fuvarozo', 'Datum', 'Megjegyzes','Forgalom','FaanyagID','MegrendelesTetelID', 'KNkod','ImportSzarmazas','KitermelesHelye'], ["AND"=>['Deleted'=>0,'Forgalom'=>$forg, 'Datum[<>]'=>[$sd,$ed]]]);
}

function woodGetSupplierSumByTrafficAndDate($forg, $sd, $ed,$bid=false){
    global $db;
    if($bid){
      return $db->sum('faanyag', 'Mennyiseg', ['Deleted'=>0,'Forgalom'=>$forg, 'Datum[<>]'=>[$sd,$ed], 'BeszallitoID'=>$bid]);      
    }
    else{
      return $db->select('faanyag', ['Mennyiseg'=>Medoo::raw('SUM(<Mennyiseg>)'), 'BeszallitoID'], ['GROUP'=>'BeszallitoID','Deleted'=>0,'Forgalom'=>$forg, 'Datum[<>]'=>[$sd,$ed], 'ORDER'=>'BeszallitoID']);
    }
}


function woodGetDetailsByType($type){
    global $db;
    return $db->select('faanyag', ['ID', 'Mennyiseg', 'Beszallito', 'BeszallitoID', 'Szamlaszam', 'Szallitolevelszam', 'EKAER', 'CMR', 'Fuvarozo', 'Datum', 'Megjegyzes','Forgalom','FaanyagID','MegrendelesTetelID', 'KNkod','ImportSzarmazas','KitermelesHelye'], ["AND"=>['Fatipus'=>$type, 'Deleted'=>0]]);
}

function woodGetDataById($id){
    global $db;
    return $db->get('faanyag', ['ID','Mennyiseg','Beszallito', 'BeszallitoID','Fatipus', 'Szamlaszam', 'Szallitolevelszam', 'EKAER', 'CMR', 'Fuvarozo', 'Datum', 'Megjegyzes','Forgalom','FaanyagID','MegrendelesTetelID', 'KNkod','ImportSzarmazas','KitermelesHelye'], ["AND" => ['ID'=>$id, 'Deleted'=>0]]);
}

function woodGetUsedForOrder($id){
    global $db;
    return $db->select('faanyag', ['ID','Mennyiseg','Beszallito', 'BeszallitoID','Fatipus', 'Szamlaszam', 'Szallitolevelszam', 'EKAER', 'CMR', 'Fuvarozo', 'Datum', 'Megjegyzes','Forgalom','FaanyagID','MegrendelesTetelID'], ["AND" => ['MegrendelesTetelID'=>$id, 'Deleted'=>0]]);
}

function woodGetUsedForOrderSum($id){
    global $db;
    return $db->sum('faanyag', 'Mennyiseg', ["AND" => ['MegrendelesTetelID'=>$id, 'Deleted'=>0]]);
}


function woodGetStock(){
    global $db;
    return $db->select('faanyag', ['ID', 'Mennyiseg', 'Beszallito',  'BeszallitoID','Fatipus','Szamlaszam', 'Szallitolevelszam', 'EKAER', 'CMR', 'Fuvarozo', 'Datum', 'Megjegyzes','Forgalom','FaanyagID','MegrendelesTetelID', 'KNkod','ImportSzarmazas','KitermelesHelye'], ["AND"=>[ 'Deleted'=>0, 'Forgalom'=>[FORGALOM_BEVETEL], 'Mennyiseg[>]'=>0]]);
}

function woodGetMaxQty($type){
    global $db;
    return max([$db->max('faanyag','Mennyiseg', ['Fatipus'=>$type]), -1.0*$db->min('faanyag','Mennyiseg', ["AND"=>['Fatipus'=>$type, 'Deleted'=>0]])]);
}

function woodDel($id){
    global $db;
    $db->update('faanyag',['Deleted'=>1],['ID'=>$id]);
}

function woodJsUnitConversion($maxVal = 0){
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
                <?php if($maxVal > 0){ ?>
                  if(cval > <?=$maxVal?>){cval = <?=$maxVal?>;}
                <?php } ?>
                $("#cmenny").html('' + Math.round(cval * 100) / 100.0 + ' <?=U_NAMES[U_STD][0]?>');
                $("#cmennyiseg").val(Math.round(cval * 100) / 100.0);
            }
        </script>
        <?php
}

function woodUsageTable($wid){
    $dat = woodGetUsedForOrder($wid);
    $sum = 0;
?>
<table class="table">
    <thead>
        <tr>
            <th>Alapanyag ID</th>
            <th>Fafaj</th>
            <th>Beérkezési dátum</th>
            <th>Mennyiség</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach($dat as $d){
        $sum += $d["Mennyiseg"];?>
        <tr>
            <td><?=$d['FaanyagID']?></td>
            <td><?=FATIPUSOK[$d['Fatipus']][0]?></td>
            <td><?=woodGetDataById($d['FaanyagID'])['Datum']?></td>
            <td><?=-rnd($d['Mennyiseg']).'&nbsp;'.U_NAMES[U_STD][1]?></td>
            <td><button class="btn btn-danger btn-sm" type="button" title="Törlés" onclick="if(confirm('Biztosan törli a sort?')){deleteWoodLine(<?=$d['ID']?>, <?=$wid?>)}"><span class="glyphicon glyphicon-trash"></span></button></td>
        </tr>
<?php }
if(!sizeof($dat)){
    ?>
       <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td></td>
        </tr>

<?php
}
?>

    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>Összesen:</th>
            <th><?=rnd(-$sum).'&nbsp;'.U_NAMES[U_STD][1]?></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<?php
$osszesenMennyiseg = rnd(-$sum);
}

function woodIsThereUse($id){
  // volt-e mar barmilyen felhasznalas az adott tetelbol?
  global $db;
  return $db->has('faanyag', ['AND' => ['FaanyagID'=>$id, 'Deleted'=>0]]);
}

function woodGetUsedPortion($id){
  global $db;
  return -1*$db->sum('faanyag', 'Mennyiseg', ['AND' => ['FaanyagID'=>$id, 'Deleted'=>0]]);
}
?>
