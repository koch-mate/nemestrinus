<?php

function orderResidentialAdd($felvette, $rogzitette, $datum, $teljesitesDatum, $megrendelo_nev, $megrendelo_cim, $megrendelo_tel, $kapcs_nev, $szall_cim, $kapcs_tel, $ar, $szall_ktsg, $megjegyzes, $order_json){
    global $db;
    $new_id = $db->insert('megrendeles', [
        'RogzitesDatum' => $datum,
        'KertDatum' => $teljesitesDatum,
        'Felvette' => $felvette,
        'RogzitetteID' => $_SESSION['userID'],
        'Tipus' => M_LAKOSSAGI,
//        'MegrendeloID' => '',
        'Statusz' => M_S_FELDOLGOZAS_ALATT,
        'Vegosszeg' => $ar,
        'Penznem' => P_FORINT,
        'Fuvardij' => $szall_ktsg,
        'Megjegyzes' => $megjegyzes,
        'MegrendeloNev' => $megrendelo_nev,
        'MegrendeloCim' => $megrendelo_cim,
        'MegrendeloTel' => $megrendelo_tel,
        'KapcsolattartoNev' => $kapcs_nev,
        'SzallitasiCim' => $szall_cim,
        'KapcsolattartoTel' => $kapcs_tel
    ]);
    
    foreach(json_decode($order_json) as $o){    
        $db->insert('megrendeles_tetel', [
            'MegrendelesID' => $new_id,
            'Fafaj' => $o->fafaj,
            'Hossz' => $o->hossz,
            'Huratmero' => $o->atm,
            'Csomagolas' => $o->csom,
            'Mennyiseg' => $o->menny,
            'MennyisegStd' =>unitChange(CSOMAGOLASTIPUSOK[$o->csom][3], U_STD, $o->menny * CSOMAGOLASTIPUSOK[$o->csom][2]),
            'Nedvesseg' => $o->nedv,
            'Ar' => $o->ar,
            'GyartasStatusza' => GY_S_VISSZAIGAZOLASRA_VAR,
            'GyartasDatuma' => null,
            'GyartasVarhatoDatuma' => null

        ]);
    }
    return $new_id;
}

function orderExportAdd($felvette, $rogzitette, $datum, $teljesitesDatum, $megrendeloID, $prioritas, $penznem, $ar, $szall_ktsg, $megjegyzes, $order_json){
    global $db;
    $new_id = $db->insert('megrendeles', [
        'RogzitesDatum' => $datum,
        'KertDatum' => $teljesitesDatum,
        'Felvette' => $felvette,
        'RogzitetteID' => $_SESSION['userID'],
        'Tipus' => M_EXPORT,
        'MegrendeloID' => $megrendeloID,
        'Statusz' => M_S_FELDOLGOZAS_ALATT,
        'Vegosszeg' => $ar,
        'Penznem' => $penznem,
        'Prioritas' => $prioritas,
        'Fuvardij' => $szall_ktsg,
        'Megjegyzes' => $megjegyzes,
    ]);
    
    foreach(json_decode($order_json) as $o){    
        $db->insert('megrendeles_tetel', [
            'MegrendelesID' => $new_id,
            'Fafaj' => $o->fafaj,
            'Hossz' => $o->hossz,
            'Huratmero' => $o->atm,
            'Csomagolas' => $o->csom,
            'Mennyiseg' => $o->menny,
            'MennyisegStd' =>unitChange(CSOMAGOLASTIPUSOK[$o->csom][3], U_STD, $o->menny * CSOMAGOLASTIPUSOK[$o->csom][2]),
            'Nedvesseg' => $o->nedv,
            'Ar' => $o->ar,
            'GyartasStatusza' => GY_S_VISSZAIGAZOLASRA_VAR,
            'GyartasDatuma' => null,
            'GyartasVarhatoDatuma' => null
        ]);
    }
    return $new_id;
}

function ordersGetAllData($filters = []){
    global $db;
    $where =  ['Deleted'=>0];
    if(array_key_exists('RogzitesDatum', $filters)){
        $where[ 'RogzitesDatum[<>]' ] = $filters['RogzitesDatum'];
    }
    if(array_key_exists('KertDatum', $filters)){
        $where[ 'KertDatum[<>]' ] = $filters['KertDatum'];
    }
    if(array_key_exists('Tipus', $filters)){
        /*if($filters['Tipus'] == [M_LAKOSSAGI, M_EXPORT]){
            // select all, no need for action
        }
        else if(in_array(M_LAKOSSAGI, $filters['Tipus'])){
            $where['Tipus'] = M_LAKOSSAGI;
        }
        else if(in_array(M_EXPORT, $filters['Tipus'])){
            $where['Tipus'] = M_EXPORT;
        }
        else{
            $where['Tipus'] = '';
        }*/
        $where['Tipus'] = $filters['Tipus'];
    }
    
    return    ($db->select('megrendeles', ['ID','RogzitesDatum', 'Felvette', 'RogzitetteID','Tipus','MegrendeloID','Statusz','GyartasVarhatoDatuma','GyartasTenylegesDatuma','SzallitasStatusza','SzallitasVarhatoDatuma', 'SzallitasTenylegesDatuma','Vegosszeg','Penznem', 'FizetesiHatarido', 'FizetesStatusza', 'Szamlaszam', 'Fuvardij','Megjegyzes','KertDatum', 'MegrendeloNev', 'MegrendeloCim', 'MegrendeloTel', 'KapcsolattartoNev', 'KapcsolattartoTel','SzallitasiCim','Prioritas'], ['AND' =>$where]));
}

function ordersGetItemsByID($id){
    global $db;
    return $db->select('megrendeles_tetel', ['ID', 'Fafaj', 'Hossz', 'Huratmero', 'Csomagolas', 'Mennyiseg', 'MennyisegStd', 'Nedvesseg', 'GyartasStatusza', 'GyartasDatuma', 'GyartasVarhatoDatuma', 'Ar'], ['AND' => ['Deleted'=>0, 'MegrendelesID'=>$id]]);
}

function orderFullPrice($id){
    // without shipping fee!!
    global $db;
    $s = $db->sum('megrendeles_tetel', 'Ar', ['AND' => ['Deleted'=>0, 'MegrendelesID'=>$id]]);
    return $s;
}
?>