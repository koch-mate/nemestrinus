<?php


session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");


if(empty($_SESSION['activeLogin']) || empty($_GET['id']) ){
    ?>

Hibás autentikáció.

<?php
}
else {

$mid = $_GET['id'];

$og = ordersGetAllData(['ID'=>$mid])[0];

 if($og['Tipus']==M_LAKOSSAGI){?>
  <table class='table table-striped table-hover' style='font-size:80%'>
    <tbody>
        <tr>
            <th>Megrendelő neve</th>
            <td>
                <?=($og['MegrendeloNev'])?>
            </td>
        </tr>
        <tr>
            <th>Számlázási cím</th>
            <td>
                <?=($og['MegrendeloCim'])?>
            </td>
        </tr>
        <tr>
            <th>Telefonszám</th>
            <td>
                <?=($og['MegrendeloTel'])?>
            </td>
        </tr>
        <tr>
            <th>Kapcsolattartó neve</th>
            <td>
                <?=($og['KapcsolattartoNev'])?>
            </td>
        </tr>
        <tr>
            <th>Szállítási cím</th>
            <td>
                <?=($og['SzallitasiCim'])?>
            </td>
        </tr>
        <tr>
            <th>Telefonszám</th>
            <td>
                <?=($og['KapcsolattartoTel'])?>
            </td>
        </tr>
    </tbody>
</table>
<?}
else
{
  $ec = getExportCustomerDataById($og['MegrendeloID'])[0];
  ?>
  <table class='table table-striped table-hover' style='font-size:80%'>
    <tbody>
        <tr>
            <th>Cégnév</th>
            <td>
                <?=($ec['MegrendeloNev'])?>
            </td>
        </tr>
        <tr>
            <th>Képviselő</th>
            <td>
                <?=htmlentities($ec['Kepviselo'])?>
            </td>
        </tr>
        <tr>
            <th>Adószám</th>
            <td>
                <?=htmlentities($ec['Adoszam'])?>
            </td>
        </tr>
        <tr>
            <th>Telefon</th>
            <td>
                <?=htmlentities($ec['Telefonszam'])?>
            </td>
        </tr>
        <tr>
            <th>Fax</th>
            <td>
                <?=htmlentities($ec['Fax'])?>
            </td>
        </tr>
        <tr>
            <th>E-mail cím</th>
            <td>
              <a href='mailto:<?=htmlentities($ec['Email'])?>'><?=htmlentities($ec['Email'])?></a>
            </td>
        </tr>
        <tr>
            <th>Szállításdi cím</th>
            <td>
                <?=htmlentities($ec['SzallitasiCim'])?>
            </td>
        </tr>
        <tr>
            <th>Számlázási cím</th>
            <td>
                <?=htmlentities($ec['SzamlazasiCim'])?>
            </td>
        </tr>
    </tbody>
</table>

<?php }
}
?>
