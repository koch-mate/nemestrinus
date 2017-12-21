<?php

// collection of functions about USER management

function getExportCustomersWithData(){
    global $db;
    return $db->select('megrendelo',['ID','MegrendeloNev','Kepviselo','Adoszam','Telefonszam','Fax','Email','SzallitasiCim','SzamlazasiCim','Jelszo','RegisztraltDatum','UtolsoBelepes','Aktiv'],['Deleted'=>0, 'ORDER'=>['MegrendeloNev']]);
}

function exportCustomerAdd(
            $cegnev,
            $kepviselo,
            $adoszam,
            $tel,
            $fax,
            $email,
            $pass,
            $bill_address,
            $ship_address,
            $state
    ){
    global $db;
    $db->insert(
        'megrendelo', [
        'MegrendeloNev' => $cegnev,
        'Kepviselo' => $kepviselo,
        'Adoszam' => $adoszam,
        'Telefonszam' => $tel,
        'Fax' => $fax,
        'Email' =>$email,
        'SzamlazasiCim' => $bill_address,
        'SzallitasiCim' => $ship_address,
        'Jelszo' => $pass,
        'RegisztraltDatum' => date('Y-m-d H:i:s'),
        'Aktiv' => $state
    ]);
}

function exportCustomerUpdate(
            $id,
            $cegnev,
            $kepviselo,
            $adoszam,
            $tel,
            $fax,
            $email,
            $pass,
            $bill_address,
            $ship_address,
            $state
    ){
    global $db;
    if(!empty($pass)){
        $db->update(
            'megrendelo', [
            'MegrendeloNev' => $cegnev,
            'Kepviselo' => $kepviselo,
            'Adoszam' => $adoszam,
            'Telefonszam' => $tel,
            'Fax' => $fax,
            'Email' =>$email,
            'SzamlazasiCim' => $bill_address,
            'SzallitasiCim' => $ship_address,
            'Jelszo' => $pass,
            'Aktiv' => $state
        ], ['ID' => $id]
        );
    }
    else {
        $db->update(
            'megrendelo', [
            'MegrendeloNev' => $cegnev,
            'Kepviselo' => $kepviselo,
            'Adoszam' => $adoszam,
            'Telefonszam' => $tel,
            'Fax' => $fax,
            'Email' =>$email,
            'SzamlazasiCim' => $bill_address,
            'SzallitasiCim' => $ship_address,
            'Aktiv' => $state
        ], ['ID' => $id]
        );
    }
}

function getExportCustomerDataById($uid){
    global $db;
    return $db->select('megrendelo', ['ID', 'MegrendeloNev', 'Kepviselo', 'Adoszam', 'Telefonszam', 'Fax', 'Email', 'SzamlazasiCim','SzallitasiCim','Jelszo','Aktiv'], ['AND' =>['ID'=>$uid, 'Deleted'=> 0]]);
}

function exportCustomerGetNameById($id){
    global $db;
    return $db->get('megrendelo', 'MegrendeloNev', ['ID'=>$id]);
}

function exportCustomerGetAddressById($id){
    global $db;
    return $db->get('megrendelo', 'SzamlazasiCim', ['ID'=>$id]);
}

function exportCustomerGetTaxNrById($id){
    global $db;
    return $db->get('megrendelo', 'Adoszam', ['ID'=>$id]);
}

function exportCustomerDelete($u){
    global $db;
    $db->update('megrendelo', ['Deleted'=>1], ['ID'=>$u]);
}

function exportCustomerGetStatus($u){
    global $db;
    return intval($db->get('megrendelo', 'Aktiv', ['ID'=>$u]));
}

function exportCustomerStatusToggle($u){
    global $db;
    $s = exportCustomerGetStatus($u);
    $db->update('megrendelo', ['Aktiv'=>(1-$s)], ['ID'=>$u]);
}

?>
