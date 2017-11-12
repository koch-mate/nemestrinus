<?php
// arak lakossagi megrendeleshez

$ARLISTA = [];

/* [
  M_LAKOSSAGI => [
    OMLESZTETT => [ // mertekegyseg: U_SZORT_URMETER
      F_BUKK => 17500,  // penznem: P_FORINT
      F_GYERTYAN => 17500,
      F_KORIS => 17500,
      F_CSER => 16000,
      F_TOLGY => 16000,
      F_JUHAR => 14000,
      F_CSERESZNYE => 14000,
      F_EGER => 12500,
      F_NYIR => 12500,
      F_FENYO => 11500,
      F_AKAC => 16000,
      F_EGYEB_KEMENY => 14000,
      F_EGYEB_LAGY => 12500,
    ],
    POSCH_HALOS => [ // mertekegyseg: U_SZORT_URMETER
      F_BUKK => 39900,  // penznem: P_FORINT
      F_GYERTYAN => 39900,
      F_KORIS => 39900,
      F_CSER => 37500,
      F_TOLGY => 37500,
      F_JUHAR => 33500,
      F_CSERESZNYE => 33500,
      F_EGER => 29900,
      F_NYIR => 29900,
      F_FENYO => 28500,
      F_AKAC => 37500,
      F_EGYEB_KEMENY => 33500,
      F_EGYEB_LAGY => 29900,
    ]
  ],
  M_EXPORT => []
]; */

function getUnitPrices(){
  global $db;
  global $ARLISTA;
  $data = $db->select('arlista', ['Fafaj', 'Csomagolas', 'Ar', 'Penznem', 'Tipus'], ['ORDER'=>['ID']]);
  foreach( $data as $i)
  {
    $ARLISTA[M_LAKOSSAGI][$i['Csomagolas']][$i['Fafaj']]= $i['Ar'];
  };

}

getUnitPrices();

function updateUnitPrice($csom, $fafaj, $ujar, $tip = M_LAKOSSAGI, $pn = P_FORINT){
  global $db;
  $db->delete('arlista', ['AND'=>['Fafaj'=>$fafaj, 'Csomagolas'=>$csom, 'Tipus'=>$tip, 'Penznem'=>$pn]]);
  $db->insert('arlista', ['Fafaj'=>$fafaj, 'Csomagolas'=>$csom, 'Tipus'=>$tip, 'Penznem'=>$pn, 'Ar'=>$ujar]);
}

function getUnitPrice($csom, $fafaj, $tip = M_LAKOSSAGI, $pn = P_FORINT){
  global $db;
  return $db->get('arlista', 'Ar', ['AND'=>['Fafaj'=>$fafaj, 'Csomagolas'=>$csom, 'Tipus'=>$tip, 'Penznem'=>$pn]]);
}
?>
