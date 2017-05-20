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
        'FizetesStatusza' => F_S_FIZETESRE_VAR,
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
        'FizetesStatusza' => F_S_FIZETESRE_VAR,
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
    if(array_key_exists('Statuszok', $filters)){
        if($filters['Statuszok'] == 'aktiv'){
            $where['Statusz'] = M_S_AKTIV;
        }
        if($filters['Statuszok'] == 'lezart'){
            $where['Statusz'] = M_S_LEZART;
        }

    }
    if(array_key_exists('RogzitesDatum', $filters)){
        $where[ 'RogzitesDatum[<>]' ] = $filters['RogzitesDatum'];
    }
    if(array_key_exists('KertDatum', $filters)){
        $where[ 'KertDatum[<>]' ] = $filters['KertDatum'];
    }
    if(array_key_exists('Tipus', $filters)){
        $where['Tipus'] = $filters['Tipus'];
    }

    if(array_key_exists('ID', $filters)){
        $where = [ 'ID' => $filters['ID'] ];
    }

    return    ($db->select('megrendeles', ['ID','RogzitesDatum', 'Felvette', 'RogzitetteID','Tipus','MegrendeloID','Statusz','SzallitasStatusza','SzallitasVarhatoDatuma', 'SzallitasTenylegesDatuma','Vegosszeg','Penznem', 'FizetesiHatarido', 'FizetesStatusza', 'Szamlaszam', 'Fuvardij','Megjegyzes','KertDatum', 'MegrendeloNev', 'MegrendeloCim', 'MegrendeloTel', 'KapcsolattartoNev', 'KapcsolattartoTel','SzallitasiCim','Prioritas'], ['AND' =>$where]));
}

function orderGetIDByOrderLineID($id){
    global $db;
    return $db->get('megrendeles_tetel', 'MegrendelesID', ['ID'=>$id]);
}

function orderGetByID($id){
    global $db;
    $o = [];
    $o['data'] = $db->select('megrendeles', ['ID','RogzitesDatum', 'Felvette', 'RogzitetteID','Tipus','MegrendeloID','Statusz','SzallitasStatusza','SzallitasVarhatoDatuma', 'SzallitasTenylegesDatuma','Vegosszeg','Penznem', 'FizetesiHatarido', 'FizetesStatusza', 'Szamlaszam', 'Fuvardij','Megjegyzes','KertDatum', 'MegrendeloNev', 'MegrendeloCim', 'MegrendeloTel', 'KapcsolattartoNev', 'KapcsolattartoTel','SzallitasiCim','Prioritas'], ['AND' => ['Deleted'=>0, 'ID'=>$id]])[0];
    $o['items'] = ordersGetItemsByID($id);
    return $o;
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

function orderLineStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles_tetel', ['GyartasStatusza'=>$st], ['ID'=>$id]);
    $rid = $db->get('megrendeles_tetel', 'MegrendelesID', ['ID'=>$id]);
    // if all order lines completed ( GY_S_LEGYARTVA, GY_S_VISSZAUTASITVA )-> update shipping status
    // active status: GY_S_AKTIV = [ GY_S_VISSZAIGAZOLASRA_VAR, GY_S_GYARTASRA_VAR ]
    if( $db->count('megrendeles_tetel', ['AND' => ['MegrendelesID' => $rid, 'GyartasStatusza' => GY_S_AKTIV ]]) == 0 )
    {
        orderShippingStatusUpdate($rid, SZ_S_SZALLITASRA_VAR);
    }
}

function orderStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles', ['Statusz'=>$st], ['ID'=>$id]);
}

function orderPaidStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles', ['FizetesStatusza'=>$st], ['ID'=>$id]);
}

function orderShippingStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles', ['SzallitasStatusza'=>$st], ['ID'=>$id]);
}


function orderGetFutureSumByType($tipus){
    global $db;
    return rnd($db->sum('megrendeles_tetel', 'MennyisegStd', ['AND' => ['Deleted'=>0, 'Fafaj'=>$tipus, 'GyartasStatusza'=>GY_S_AKTIV]]));
}

function orderGetCompletedSumByType($tipus){
    global $db;
    return rnd($db->sum('megrendeles_tetel', 'MennyisegStd', ['AND' => ['Deleted'=>0, 'Fafaj'=>$tipus, 'GyartasStatusza'=>GY_S_LEGYARTVA]]));
}

function orderGetFutureSumByTypeBetweenDates($tipus, $from, $to){
    global $db;
    // adott honapig tarto megrendelesek
    $mids = $db->select('megrendeles', 'ID', ['AND' => ['Deleted'=>0, 'KertDatum[<>]'=>[$from,$to]]]);
    return rnd($db->sum('megrendeles_tetel', 'MennyisegStd', ['AND' => ['Deleted'=>0, 'Fafaj'=>$tipus, 'GyartasStatusza'=>GY_S_AKTIV, 'MegrendelesID'=>$mids]]));
}

function orderLineDateUpdate($id, $datum, $tipus){
    global $db;
    $_lookUp = ['varhato'=>'GyartasVarhatoDatuma','tenyleges'=>'GyartasDatuma'];
    $db->update('megrendeles_tetel', [ $_lookUp[$tipus] => $datum ], [ 'ID'=>$id ]);
}

function orderDel($id){
    global $db;
    $db->update('megrendeles', ['Deleted'=>1], ['ID'=>$id]);
    $db->update('megrendeles_tetel', ['Deleted'=>1], ['MegrendelesID'=>$id]);
    $mlids = $db->select('megrendeles_tetel', 'ID', ['MegrendelesID'=>$id]);
    $db->update('faanyag', ['Deleted'=>1], ['MegrendelesTetelID' => $mlids]);
    $db->update('csomagoloanyag', ['Deleted'=>1], ['MegrendelesTetelID' => $mlids]);
}   // FIXME: megrendelestetelid csomagoloanyag

?>
