<?php

function orderResidentialAdd($felvette, $rogzitette, $datum, $teljesitesDatum, $fizhat, $megrendelo_nev, $megrendelo_cim, $megrendelo_tel, $kapcs_nev, $szall_cim, $kapcs_tel, $ar, $szall_ktsg, $megjegyzes, $gyarto, $order_json){
    global $db;

    $cmsg = '';
    if(strlen(trim($megjegyzes)) > 0){
      $cmsg = [[
          'u' => $_SESSION['userName'],
          'd' => date('Y-m-d H:i:s'),
          'm' => $megjegyzes
      ]];
    }

    $db->insert('megrendeles', [
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
        'Megjegyzes' => $cmsg,
        'MegrendeloNev' => $megrendelo_nev,
        'MegrendeloCim' => $megrendelo_cim,
        'MegrendeloTel' => $megrendelo_tel,
        'KapcsolattartoNev' => $kapcs_nev,
        'SzallitasiCim' => $szall_cim,
        'FizetesStatusza' => F_S_FIZETESRE_VAR,
        'FizetesiHatarido' => $fizhat,
        'KapcsolattartoTel' => $kapcs_tel,
        'Gyarto' => $gyarto
    ]);
    $new_id = $db->id();

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
            'GyartasVarhatoDatuma' => null,
            'GyartasSzamitottDatuma' => orderCalculateManufacturingDate(M_LAKOSSAGI, $o->nedv, $teljesitesDatum)

        ]);
    }
    return $new_id;
}

function addOrderItem($mid, $fafaj, $hossz, $atm, $csom, $menny, $nedv, $ar, $teljesitesDatum){
  global $db;
  $db->insert('megrendeles_tetel', [
      'MegrendelesID' => $mid,
      'Fafaj' => $fafaj,
      'Hossz' => $hossz,
      'Huratmero' => $atm,
      'Csomagolas' => $csom,
      'Mennyiseg' => $menny,
      'MennyisegStd' =>unitChange(CSOMAGOLASTIPUSOK[$csom][3], U_STD, $menny * CSOMAGOLASTIPUSOK[$csom][2]),
      'Nedvesseg' => $nedv,
      'Ar' => $ar,
      'GyartasStatusza' => GY_S_VISSZAIGAZOLASRA_VAR,
      'GyartasDatuma' => null,
      'GyartasVarhatoDatuma' => null,
      'GyartasSzamitottDatuma' => orderCalculateManufacturingDate(M_LAKOSSAGI, $nedv, $teljesitesDatum)

  ]);

}
function editOrderItem($mid, $mtid, $fafaj, $hossz, $atm, $csom, $menny, $nedv, $ar, $teljesitesDatum){
  global $db;
  $db->update('megrendeles_tetel', [
      'Fafaj' => $fafaj,
      'Hossz' => $hossz,
      'Huratmero' => $atm,
      'Csomagolas' => $csom,
      'Mennyiseg' => $menny,
      'MennyisegStd' =>unitChange(CSOMAGOLASTIPUSOK[$csom][3], U_STD, $menny * CSOMAGOLASTIPUSOK[$csom][2]),
      'Nedvesseg' => $nedv,
      'Ar' => $ar,
      'GyartasStatusza' => GY_S_VISSZAIGAZOLASRA_VAR,
      'GyartasDatuma' => null,
      'GyartasVarhatoDatuma' => null,
      'GyartasSzamitottDatuma' => orderCalculateManufacturingDate(M_LAKOSSAGI, $nedv, $teljesitesDatum)
  ], ['ID'=>$mtid]);

}

function orderExportAdd($felvette, $rogzitette, $datum, $teljesitesDatum, $fizhat, $megrendeloID, $prioritas, $penznem, $ar, $szall_ktsg, $megjegyzes, $gyarto, $order_json){
    global $db;
    if(strlen(trim($megjegyzes)) > 0){
      $cmsg = [[
          'u' => $_SESSION['userName'],
          'd' => date('Y-m-d H:i:s'),
          'm' => $megjegyzes
      ]];
    }

    $db->insert('megrendeles', [
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
        'FizetesiHatarido' => $fizhat,
        'Fuvardij' => $szall_ktsg,
        'Megjegyzes' => $cmsg,
        'Gyarto' => $gyarto
    ]);
    $new_id = $db->id();
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
            'GyartasVarhatoDatuma' => null,
            'GyartasSzamitottDatuma' => orderCalculateManufacturingDate(M_EXPORT, $o->nedv, $teljesitesDatum)
        ]);
    }
    return $new_id;
}

function orderCalculateManufacturingDate($type, $moist, $expDate){
  return date("Y-m-d", strtotime($expDate." -".(GYARTASI_IDO[$type][$moist]+SZALLITASI_IDO[$type])." days"));
}

function ordersGetAllData($filters = []){
    global $db;
    $where =  ['Deleted'=>0];
    if(array_key_exists('Statuszok', $filters)){
      if($filters['Statuszok'] == 'aktiv'){
          $where['Statusz'] = M_S_AKTIV;
      }
      if($filters['Statuszok'] == 'gyarthato'){
          $where['Statusz'] = M_S_GYARTHATO;
      }
      if($filters['Statuszok'] == 'lezart'){
          $where['Statusz'] = M_S_LEZART;
      }
      if($filters['Statuszok'] == 'legyartott'){
          $where['OR']= ['Statusz' => M_S_LEZART, 'SzallitasStatusza'=>SZ_S_SZALLITASRA_VAR];
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
        $where['ID'] = $filters['ID'];
    }

    if(array_key_exists('Gyarto', $filters)){
        $where['Gyarto'] = $filters['Gyarto'];
    }
    if(array_key_exists('MegrendeloNev', $filters)){
        $where['MegrendeloNev[~]'] = $filters['MegrendeloNev'];
    }

    if(array_key_exists('MegrendeloID', $filters)){
        $where['MegrendeloID'] = $filters['MegrendeloID'];
    }


    $fields = [
      'ID',
      'RogzitesDatum',
      'Felvette',
      'RogzitetteID',
      'Tipus',
      'MegrendeloID',
      'Statusz',
      'SzallitasStatusza',
      'SzallitasVarhatoDatuma',
      'SzallitasTenylegesDatuma',
      'Vegosszeg',
      'Penznem',
      'FizetesiHatarido',
      'FizetesDatuma',
      'FizetesStatusza',
      'Szamlaszam',
      'Fuvardij',
      'Megjegyzes',
      'KertDatum',
      'MegrendeloNev',
      'MegrendeloCim',
      'MegrendeloTel',
      'KapcsolattartoNev',
      'KapcsolattartoTel',
      'SzallitasiCim',
      'Prioritas',
      'SzallitolevelSzam',
      'CMR',
      'EKAER',
      'Fuvarozo',
      'Gyarto',
      'KulsoGyartasStatusza'
    ];
    if(array_key_exists('OrderBy', $filters)){
      return    ($db->select('megrendeles', $fields, ['AND' =>$where, 'ORDER'=>$filters['OrderBy']]));
    }
    else {
      return    ($db->select('megrendeles', $fields, ['AND' =>$where]));
    }
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
    return $db->select('megrendeles_tetel', ['ID', 'Fafaj', 'Hossz', 'Huratmero', 'Csomagolas', 'Mennyiseg', 'MennyisegStd', 'Nedvesseg', 'GyartasStatusza', 'GyartasDatuma', 'GyartasSzamitottDatuma', 'GyartasVarhatoDatuma', 'Ar'], ['AND' => ['Deleted'=>0, 'MegrendelesID'=>$id]]);
}

function orderFullPrice($id){
    // without shipping fee!!
    global $db;
    $s = $db->sum('megrendeles_tetel', 'Ar', ['AND' => ['Deleted'=>0, 'MegrendelesID'=>$id]]);
    return $s;
}

function orderGetPayDueDate($id){
  global $db;
  return $db->get('megrendeles', 'FizetesiHatarido', ['ID'=>$id]);
}

function orderLineStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles_tetel', ['GyartasStatusza'=>$st], ['ID'=>$id]);
    $rid = $db->get('megrendeles_tetel', 'MegrendelesID', ['ID'=>$id]);
    // if all order lines completed ( GY_S_LEGYARTVA, GY_S_VISSZAUTASITVA )-> update shipping status
    // active status: GY_S_AKTIV = [ GY_S_VISSZAIGAZOLASRA_VAR, GY_S_GYARTASRA_VAR ]
    if( $db->count('megrendeles_tetel', ['AND' => ['MegrendelesID' => $rid, 'Deleted'=> 0, 'GyartasStatusza' => GY_S_AKTIV ]]) == 0 )
    {
        orderShippingStatusUpdate($rid, SZ_S_SZALLITASRA_VAR);
    }
    else {
        orderShippingStatusUpdate($rid, SZ_S_GYARTAS_ALATT);
    }
}

function orderStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles', ['Statusz'=>$st], ['ID'=>$id]);
}

function orderExtMfStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles', ['KulsoGyartasStatusza'=>$st], ['ID'=>$id]);
}

function orderManufacturerUpdate($id, $gy){
    global $db;
    $db->update('megrendeles', ['Gyarto'=>$gy], ['ID'=>$id]);
}

function orderShippingPriceUpdate($id, $price){
    global $db;
    $db->update('megrendeles', ['Fuvardij'=>$price], ['ID'=>$id]);
}

function orderPaidStatusUpdate($id, $st, $datum, $hatarido){
    global $db;
    if($datum == ''){$datum = null;}
    if($hatarido == ''){$hatarido = null;}
    $db->update('megrendeles', ['FizetesStatusza'=>$st, 'FizetesDatuma'=>$datum, 'FizetesiHatarido'=>$hatarido], ['ID'=>$id]);
}

function orderShippingStatusUpdate($id, $st){
    global $db;
    $db->update('megrendeles', ['SzallitasStatusza'=>$st], ['ID'=>$id]);
    if($st == SZ_S_LESZALLITVA){
       orderStatusUpdate($id, M_S_TELJESITVE);
    }
}


function orderShippingDataUpdate($id, $st, $datum, $varhato, $szlevsz, $szsz, $cmr, $ekaer, $fuvarozo){
    global $db;
    $db->update('megrendeles', ['SzallitasStatusza'=>$st, 'SzallitasVarhatoDatuma'=>$varhato, 'SzallitasTenylegesDatuma'=>$datum, 'SzallitolevelSzam'=>$szlevsz, 'SzamlaSzam' => $szsz, 'CMR'=>$cmr, 'EKAER'=>$ekaer, 'Fuvarozo'=>$fuvarozo], ['ID'=>$id]);
    if($st == SZ_S_LESZALLITVA){
       orderStatusUpdate($id, M_S_TELJESITVE);
    }
}


function orderGetFutureSumByType($tipus){
    global $db;
    return rnd($db->sum('megrendeles_tetel', ["[>]megrendeles"=>["MegrendelesID"=>"ID"]],'MennyisegStd', ['AND' => ['megrendeles.Gyarto'=>GYARTO_BELSO,'megrendeles_tetel.Deleted'=>0, 'megrendeles_tetel.Fafaj'=>$tipus, 'megrendeles.Deleted'=>0,'megrendeles_tetel.GyartasStatusza'=>GY_S_AKTIV]]));
}

function orderGetCompletedSumByType($tipus, $forg){
    global $db;
    return -1.0*rnd($db->sum('faanyag', 'Mennyiseg', ['AND'=> ['Deleted'=>0, 'Fatipus'=>$tipus, 'Forgalom'=>$forg]]));
}

function orderGetFutureSumByTypeBetweenDates($tipus, $from, $to){
    global $db;
    return rnd($db->sum('megrendeles_tetel',["[>]megrendeles"=>["MegrendelesID"=>"ID"]],'MennyisegStd', ['AND' => ['megrendeles.Gyarto'=>GYARTO_BELSO,'megrendeles_tetel.Deleted'=>0, 'megrendeles_tetel.Fafaj'=>$tipus, 'megrendeles.Deleted'=>0, 'megrendeles_tetel.GyartasStatusza'=>GY_S_AKTIV, 'megrendeles_tetel.GyartasSzamitottDatuma[<>]'=>[$from,$to]]]));
    // adott honapig tarto megrendelesek
    // regi, hibas szamolas, mert csak az elvart datumot veszi figyelembe, a szamitott datumot nem
    /*
    $mids = $db->select('megrendeles', 'ID', ['AND' => ['Deleted'=>0, 'KertDatum[<>]'=>[$from,$to]]]);
    return rnd($db->sum('megrendeles_tetel', 'MennyisegStd', ['AND' => ['Deleted'=>0, 'Fafaj'=>$tipus, 'GyartasStatusza'=>GY_S_AKTIV, 'MegrendelesID'=>$mids]]));
    */
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

function orderItemDel($id){
    global $db;
    $db->update('megrendeles_tetel', ['Deleted'=>1], ['ID'=>$id]);
}

function orderProductionHasNotStarted($id){
  global $db;
  if ($db->count('megrendeles_tetel', ['AND'=>['MegrendelesID'=>$id,'GyartasStatusza[!]'=>[GY_S_VISSZAIGAZOLASRA_VAR,GY_S_VISSZAUTASITVA]]]) == 0){
    return True;
  } else {
    return False;
  }
}

function orderGetHuratmerok(){
  global $db;
  return $db->select('megrendeles_tetel', 'Huratmero', ['GROUP'=>'Huratmero','ORDER'=>'Huratmero']);
}

function orderGetHosszak(){
  global $db;
  return $db->select('megrendeles_tetel', 'Hossz', ['GROUP'=>'Hossz','ORDER'=>'Hossz']);
}

function orderUpdateCustomerData( $id, $mnev, $mcim, $mtel, $knev, $szc, $ktel){
  global $db;
  return $db->update('megrendeles', ['MegrendeloNev'=>$mnev, 'MegrendeloCim'=>$mcim, 'MegrendeloTel'=>$mtel, 'KapcsolattartoNev'=>$knev, 'SzallitasiCim'=>$szc, 'KapcsolattartoTel'=>$ktel], ['ID'=>$id]);

}

?>
