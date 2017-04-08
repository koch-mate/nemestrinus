<?php
session_start();

require_once("../lib/config.php");
require_once("../core/auth.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");
require_once("../lib/messages.php");


if(empty($_SESSION['activeLogin']) || empty($_GET['id']) ){
    ?>

Hibás autentikáció.

<?php
}
else {
    renderMessages(getMsg($_GET['table'], $_GET['id']));
} ?>