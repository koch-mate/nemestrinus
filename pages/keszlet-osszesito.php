<h1>Készlet összesítő</h1>

<p>
  A <b>Készlet összesítő</b> a pillanatnyi készlet és a rendszerben lévő megrendelések összességét mutatja.
  <ul>
    <li>
      Az <b>Aktuális készlet</b> oszlop mutatja a rendszerben lévő szabad mennyiséget a fafajokból. Ha ez kisebb, mint 0, akkor az adatok nem konzisztensek, valamilyen bevételezés nem került rögzítésre, vagy korrekcióval kell élni.
    </li>
    <li>
      A <b>Gyártásra váró megrendelés</b> oszlop tartalmazza az összes megrendelés tételt, ami a rendszerben rögzítésre került, de még nincs legyártva. Ha ez az oszlop piros, akkor nincs elég alapanyag pillanatnzilag, a gyártás megkezdése előtt mindenképpen kell majd beszállítani.
    </li>
    <li>
      A <b>Maradék</b> oszlop mutatja a az első két oszlop különbségét. A zöld szín jelenti, hogy több alapanyag van jelenleg készleten, mint amennyi a gyártásra váró tételek teljesítéséhez szükséges, a piros szín pedig azt, hogy az összes gyártásra váró tétel teljesítéséhez még alapanyagot kell behozni.
    </li>
    <li>
      A <b>Felhasználás + Értékesítés</b> oszlop azt mutatja, hogy az adott típusból a múltban mennyi megrendelés került felhasználásra gyártás során, illetve közvetlen értékesítésre.
    </li>
  </ul>
</p>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Fatípus</th>
            <th style="text-align:center;">Aktuális készlet</th>
            <th></th>
            <th style="text-align:center;">Gyártásra váró<br />megrendelés</th>
            <th></th>
            <th style="text-align:center;">Maradék</th>
            <th></th>
            <th style="text-align:center;">Felhasználás + Értékesítés</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach(array_keys(FATIPUSOK) as $rk){
    $keszlet  = woodGetSumByType($rk);
    $elojegyzes = orderGetFutureSumByType($rk);
    $felhasznalas = orderGetCompletedSumByType($rk,[FORGALOM_FELHASZNALAS]);
    $ertekesites = orderGetCompletedSumByType($rk, [FORGALOM_KIADAS]);
?>
        <tr>
            <th>
                <label for="r_cs_<?=$rk?>">
                    <span style="width: 3em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=FATIPUSOK[$rk][0]?>" style="height:2em;" /></span>
                    <b><?=FATIPUSOK[$rk][0]?></b>
                </label>
            </th>
            <td style="text-align:center;">
                <?=spanify($keszlet)?>
            </td>
            <td><span class="glyphicon glyphicon-minus"></span></td>
            <td style="text-align:center;">
                <?=spanify($elojegyzes, $min = ($keszlet-$elojegyzes < 0 ? $elojegyzes+1 : 0), $max = ($keszlet-$elojegyzes < 0 ? $elojegyzes + 2 : 0))?>
            </td>
            <td><span class="glyphicon glyphicon-arrow-right"></span></td>
            <td style="text-align:center;">
                <?=spanify($keszlet-$elojegyzes)?>
            </td>
            <td></td>
            <td style="text-align:center;">
                <b>(</b><?=spanify($felhasznalas)?>&nbsp;+&nbsp;<?=spanify($ertekesites)?><b>)</b>
            </td>

        </tr>
    <?php
    }

?>
    </tbody>
</table>


<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Fatípus</th>
            <th style="text-align:center;">Aktuális készlet</th>
            <th></th>
            <th style="text-align:center;">Gyártásra váró<br />megrendelések szükséglete</th>
            <th></th>
            <th style="text-align:center;">Maradék</th>
            <th></th>
            <th style="text-align:center;">Felhasználás + Értékesítés</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach(array_keys(CSOMAGOLOANYAGOK) as $rk){
    $keszlet  = packagingGetSumByType($rk);
    $elojegyzes = packagingGetFutureSumByType($rk);
    $felhasznalas = packagingGetPastSumByType($rk,[FORGALOM_FELHASZNALAS]);
    $ertekesites = packagingGetPastSumByType($rk, [FORGALOM_KIADAS]);

?>
        <tr>
            <th>
                <label for="r_cs_<?=$rk?>">
                    <span style="width: 5em; display:inline-block;"><img src="/img/<?=$rk?>.png" class="zoom" title="<?=CSOMAGOLOANYAGOK[$rk][0]?>" style="height:2em;" /></span>
                    <b><?=CSOMAGOLOANYAGOK[$rk][0]?></b>
                </label>
            </th>
            <td style="text-align:center;">
                <?=spanify($keszlet,$min=0,$max=0,$u=CSOMAGOLOANYAGOK[$rk][1])?>
            </td>
            <td><span class="glyphicon glyphicon-minus"></span></td>
            <td style="text-align:center;">
                <?=spanify($elojegyzes, $min = ($keszlet-$elojegyzes < 0 ? $elojegyzes+1 : 0), $max = ($keszlet-$elojegyzes < 0 ? $elojegyzes + 2 : 0), $u=CSOMAGOLOANYAGOK[$rk][1])?>
            </td>
            <td><span class="glyphicon glyphicon-arrow-right"></span></td>
            <td style="text-align:center;">
                <?=spanify($keszlet-$elojegyzes, $min=0, $max=0, $u=CSOMAGOLOANYAGOK[$rk][1])?>
            </td>
            <td></td>
            <td style="text-align:center;">
                <b>(</b><?=spanify($felhasznalas, $min=0, $max=0,$u=CSOMAGOLOANYAGOK[$rk][1])?>&nbsp;+&nbsp;<?=spanify($ertekesites, $min=0, $max=0,$u=CSOMAGOLOANYAGOK[$rk][1])?><b>)</b>
            </td>

        </tr>
    <?php
    }

?>
    </tbody>
</table>
