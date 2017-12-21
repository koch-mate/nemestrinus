<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Faanyag forgalom - Kiszállítás", 'cnt');

function label($cnt, $style){
    return "<span class='label label-$style'>$cnt</span>";
}

function cnt(){
  global $ev, $db;
?>

<div class="row">

  <div class="col-md-10" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">

    <table class="table" style="width:50%;">

      <tr>
        <th>
          Cég neve, EUTR azonosítója
        </th>
        <td>
          IHARTÜ-2000 Erdészeti és Faipari Kft. []
        </td>
      </tr>
      <tr>
        <th>
          Telephely
        </th>
        <td>
          H-8444 Szentgál, Kun utca 30.
        </td>
      </tr>
    </table>

<?php

$mi = 0;
foreach(MONTHS as $m){
  $mi += 1;
  $sd = $ev.'-'.$mi.'-01';
  $ed = date('Y-m-t', strtotime($ev.'-'.$mi.'-01'));
  ?>
  <div id="hodiv<?=$mi?>">
    <h3><?=mb_ucfirst($m)?></h3>
  </div>
      <table class="table">
        <thead>
          <tr>
            <th>Sorszám</th>
            <th>Dátum</th>
            <th>Vevő neve</th>
            <th>Vevő székhelye / címe</th>
            <th>EUTR azonosító</th>
            <th>Adóazonosító jel / Adószám</th>
            <th>EKÁER szám</th>
            <th>Szállítójegy száma</th>
            <th>Számla / nyugta száma</th>
            <th>Fafaj / áru megnevezés</th>
            <th>Mennyiség</th>
            <th>Mértékegység</th>
            <th>KN kód szerinti választék</th>
            <th>Kitermelés helye</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach(woodGetAllByTrafficAndDate([FORGALOM_FELHASZNALAS,FORGALOM_KIADAS], $sd, $ed) as $d){
            if(!empty($d['MegrendelesTetelID'])){
                $order = orderGetByID(orderGetIDByOrderLineID($d['MegrendelesTetelID']))['data'];
                $vevo = $order['Tipus'] == M_EXPORT ? exportCustomerGetNameById($order['MegrendeloID']) : $order['MegrendeloNev'];
                $cim  = $order['Tipus'] == M_EXPORT ? exportCustomerGetAddressById($order['MegrendeloID']) : $order['MegrendeloCim'];
                $adoszam  = $order['Tipus'] == M_EXPORT ? exportCustomerGetTaxNrById($order['MegrendeloID']) : '';
                $szlsz = $order['Szamlaszam'];
                $eaker = $order['EAKER'];
                $szall = $order['SzallitolevelSzam'];
            }
            else {
                $vevo = '';
                $cim  = '';
                $szlsz = $d['Szamlaszam'];
                $eaker = $d['EAKER'];
                $szall = $d['Szallitolevelszam'];
            }
           ?>
          <tr>
            <td><?=$d['ID']?></td>
            <td style="white-space: nowrap;"><?=$d['Datum']?></td>
            <td><?=$vevo?></td>
            <td><?=$cim?> </td>
            <td><?php //TODO ?></td>
            <td><?=$adoszam?></td>
            <td><?=$eaker?></td>
            <td><?=$szall?></td>
            <td><?=$szlsz?></td>
            <td><?=FATIPUSOK[$d['Fatipus']][0]?></td>
            <td style="text-align:right;"><?=-rnd($d['Mennyiseg'])?></td>
            <td><?=U_NAMES[U_STD][1]?></td>
            <td><?php //TODO ?></td>
            <td><?php //TODO ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    <?php }?>
    </div>

</div>

<?php }
?>
