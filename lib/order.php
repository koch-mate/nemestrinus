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
            'Nedvesseg' => $o->nedv
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
            'Nedvesseg' => $o->nedv
        ]);
    }
    return $new_id;
}

?>