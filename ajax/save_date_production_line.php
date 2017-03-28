<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");


if(empty($_SESSION['activeLogin']) || empty($_POST['ID']) ){
    ?>

Hibás autentikáció.

<?php
}
else {
    orderLineDateUpdate($_POST['ID'],$_POST['Datum'], $_POST['Tipus']);
} ?>