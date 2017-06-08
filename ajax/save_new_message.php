<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");
require_once("../lib/messages.php");

require_once('../lib/log.php');
require_once('../lib/log_events.php');

if(empty($_SESSION['activeLogin']) || empty($_POST['msg']) ){
    ?>

Hibás autentikáció.

<?php
}
else {
    recordNewMessage($_POST['msg'], $_POST['table'], $_POST['id']);
} ?>
