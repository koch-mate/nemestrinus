<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");
require_once("../lib/packaging.php");
require_once('../lib/log.php');
require_once('../lib/log_events.php');


if(empty($_SESSION['activeLogin']) || empty($_POST['ID']) ){
    ?>

Hibás autentikáció.

<?php
}
else {
    orderLineStatusUpdate($_POST['ID'],$_POST['Statusz']);
    logEv(LOG_EVENT['order_item_status_update'].':',null,implode(',', ['MID: '.$_POST['ID'],$_POST['Statusz'] ]));

    if($_POST['Statusz'] == GY_S_LEGYARTVA){
        // fel kell venni a csomagoloanyagokat is
        packagingUseForProduction($_POST['MID'], $_POST['ID']);
    }
} ?>
