<?php

function suppliersGetWithData(){
    global $db;
    return $db->select('beszallito',['ID','Cegnev','Szekhely','EUTR_EGE','Adoszam','Fax','Email','Telefonszam','Kapcsolattarto','Deleted'],['Deleted'=>0, 'ORDER'=>['Cegnev']]);
}


function supplierAdd(
            $cegnev,
            $kepviselo,
            $adoszam,
            $tel,
            $fax,
            $email,
            $address,
            $eutr
    ){
    global $db;
    $db->insert(
        'beszallito', [
        'Cegnev' => $cegnev,
        'Kapcsolattarto' => $kepviselo,
        'Adoszam' => $adoszam,
        'Telefonszam' => $tel,
        'Fax' => $fax,
        'Email' =>$email,
        'Szekhely' => $address,
        'EUTR_EGE' => $eutr,
    ]);
}

function supplierUpdate(
            $id,
            $cegnev,
            $kepviselo,
            $adoszam,
            $tel,
            $fax,
            $email,
            $address,
            $eutr
    ){
    global $db;
    $db->update(
        'beszallito', [
          'Cegnev' => $cegnev,
          'Kapcsolattarto' => $kepviselo,
          'Adoszam' => $adoszam,
          'Telefonszam' => $tel,
          'Fax' => $fax,
          'Email' =>$email,
          'Szekhely' => $address,
          'EUTR_EGE' => $eutr,
    ], ['ID' => $id]
    );
}

function supplierGetDataById($uid){
    global $db;
    return $db->select('beszallito', ['ID','Cegnev','Szekhely','EUTR_EGE','Adoszam','Fax','Email','Telefonszam','Kapcsolattarto','Deleted'], ['AND' =>['ID'=>$uid, 'Deleted'=> 0]]);
}

function suppliersGetList(){
  global $db;
  return $db->select('beszallito',['ID', 'Cegnev'], ['Deleted'=>0, 'ORDER'=>'Cegnev']);
}

function getSupplierNameById($id){
    global $db;
    return $db->get('beszallito', 'Cegnev', ['ID'=>$id]);
}

function getSupplierTaxById($id){
    global $db;
    return $db->get('beszallito', 'Adoszam', ['ID'=>$id]);
}

function getSupplierAddressById($id){
    global $db;
    return $db->get('beszallito', 'Szekhely', ['ID'=>$id]);
}

function getSupplierEUTRById($id){
    global $db;
    return $db->get('beszallito', 'EUTR_EGE', ['ID'=>$id]);
}

function supplierGetDependencies($id){
    global $db;
    return $db->count('faanyag', ['BeszallitoID'=>$id, 'Deleted'=>0]);
}

function supplierDelete($u){
    global $db;
    if(supplierGetDependencies($u)>0){
      return;
    }
    $db->update('beszallito', ['Deleted'=>1], ['ID'=>$u]);
}


?>
