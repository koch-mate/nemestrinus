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
    $hatarido = '';
    if($_POST['Ext'] == 1){
      // lakossagi megrendeles eseten fizetett statuszu lesz kiszallitaskor automatikusan
      $hatarido = orderGetPayDueDate($_POST['ID']);
    }
    else{
      $hatarido = $_POST['Hatarido'];
    }

    logEv(LOG_EVENT['order_paid_status_update'].':',null,implode(',', ['ID: '.$_POST['ID'],$_POST['Statusz'],'Fizetési dátum: '.$_POST['Datum'],'Fizetési határidő: '.$hatarido ]));
    orderPaidStatusUpdate($_POST['ID'],$_POST['Statusz'],$_POST['Datum'],$hatarido);

} ?>
