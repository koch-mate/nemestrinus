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


if(empty($_SESSION['activeLogin']) || empty($_POST['ID']) || empty($_POST['data'])){

}
else {
    $dd=$_POST['data'];
    $megrendelesTetelId = $_POST['ID'];
    foreach(array_keys($dd) as $d){
        $faanyagId = $d;
        $menny = $dd[$d];
        $wi = woodGetDataById($faanyagId);

        logEv(LOG_EVENT['order_item_add_wood'].':',null,implode(',', ['MID: '.$_POST['ID'], 'FID: '.$d, abs($menny) ]));

        woodAdd($wi['Fatipus'], -1.0*abs($menny), $beszallito=null, $szamlaszam=null, $szallitolevelszam=null, $datum=date('Y-m-d'), $megjegyzes=null, $forgalom=FORGALOM_FELHASZNALAS,$ekaer =null, $cmr=null, $fuvarozo=null, $faanyagID=$d, $megrendelesTetelID=$megrendelesTetelId);

    }
?>
<?php
}?>
