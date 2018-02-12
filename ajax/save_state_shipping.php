<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");
require_once('../lib/log.php');
require_once('../lib/log_events.php');


if(empty($_SESSION['activeLogin']) || empty($_POST['ID']) ){
    ?>

Hibás autentikáció.

<?php
}
else {
    $datum=(strlen($_POST['Datum'])>8?$_POST['Datum']:NULL);
    $varhato=(strlen($_POST['Hatarido'])>8?$_POST['Hatarido']:NULL);
    logEv(LOG_EVENT['order_shipping_status_update'].':',null,implode(', ', ['ID: '.$_POST['ID'],$_POST['Statusz'],'Száll. dátum: '.$_POST['Datum'],'Tervezett száll. dátum: '.$_POST['Hatarido'], $_POST['Szlev'], $_POST['Szsz'], $_POST['CMR'], $_POST['EKAER'], $_POST['Fuvarozo'] ]));
    orderShippingDataUpdate($_POST['ID'],$_POST['Statusz'], $datum, $varhato, $szlevsz=$_POST['Szlev'], $szsz=$_POST['Szsz'], $cmr=$_POST['CMR'], $ekaer=$_POST['EKAER'], $fuvarozo=$_POST['Fuvarozo']);
} ?>
