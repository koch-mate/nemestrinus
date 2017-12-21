<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("Faanyag forgalom - Beszállítás", 'cnt', true);

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
            <th>Beszállító neve</th>
            <th>Beszállító székhelye</th>
            <th>EUTR azonosító / EGE kód</th>
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
          foreach(woodGetAllByTrafficAndDate(FORGALOM_BEVETEL, $sd, $ed) as $d){
           ?>
          <tr>
            <td><?=$d['ID']?></td>
            <td style="white-space: nowrap;"><?=$d['Datum']?></td>
            <td><?=$d['Beszallito']?></td>
            <td><?php //TODO ?> </td>
            <td><?php //TODO ?></td>
            <td><?php //TODO ?></td>
            <td><?=$d['EKAER']?></td>
            <td><?=$d['Szallitolevelszam']?></td>
            <td><?=$d['Szamlaszam']?></td>
            <td><?=FATIPUSOK[$d['Fatipus']][0]?></td>
            <td style="text-align:right;"><?=rnd($d['Mennyiseg'])?></td>
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
