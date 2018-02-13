<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");
require_once("../lib/log.php");
require_once("../lib/log_events.php");


if(empty($_SESSION['activeLogin']) || empty($_POST['id']) ){
    ?>

Hibás autentikáció.

<?php
}
else {


  logEv(LOG_EVENT['order_customer_update'].':',null,implode(', ',['ID: '.$_POST['id'], $_POST['MegrendeloNev'], $_POST['MegrendeloCim'], $_POST['MegrendeloTel'],$_POST['KapcsolattartoNev'], $_POST['SzallitasiCim'], $_POST['KapcsolattartoTel']]));
  orderUpdateCustomerData( $_POST['id'], $_POST['MegrendeloNev'], $_POST['MegrendeloCim'], $_POST['MegrendeloTel'],$_POST['KapcsolattartoNev'], $_POST['SzallitasiCim'], $_POST['KapcsolattartoTel']    );


} ?>
