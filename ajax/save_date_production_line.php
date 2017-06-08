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
    logEv(LOG_EVENT['order_item_prod_date'].':',null,implode(',', ['MID: '.$_POST['ID'],$_POST['Datum'],$_POST['Tipus'] ]));
    orderLineDateUpdate($_POST['ID'],$_POST['Datum'], $_POST['Tipus']);
} ?>
