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


if(empty($_SESSION['activeLogin']) || empty($_POST['addNewItem']) ){
    ?>

Hibás autentikáció.

<?php
}
else {

  // Uj megrendeles-tetel hozzaadasa/meglevo modositasa

  if(isset($_POST['addNewItem']) && $_POST['add_mid']>0){
    $mid = $_POST['add_mid'];
    $kertdatum = $_POST['add_kertdatum'];
    $fafaj = $_POST['add_fafaj'];
    $hossz = $_POST['add_hossz'];
    $ha = $_POST['add_huratmero'];
    $cs = $_POST['add_csomagolas'];
    $menny = $_POST['add_mennyiseg'];
    $nedv = $_POST['add_nedvesseg'];
    $ar = $_POST['add_ar'];

    $mtid = $_POST['add_mtid'];
    if($mtid > 0){
      // meglevo tetel szerkesztese
      editOrderItem($mid, $mtid, $fafaj, $hossz, $ha, $cs, $menny, $nedv, $ar, $kertdatum);
      logEv(LOG_EVENT['order_item_edit'].':',null,'Megr. ID: '.$mid.", Megr. Tetel ID: ".$mtid.", ($fafaj, hossz: $hossz cm, átmérő: $ha cm, csomagolás: $cs, mennyiség: $menny, nedvesség: $nedv, ár: $ar)");
    }
    else {
      // uj tetel
      addOrderItem($mid, $fafaj, $hossz, $ha, $cs, $menny, $nedv, $ar, $kertdatum);
      logEv(LOG_EVENT['order_item_add'].':',null,'Megr. ID: '.$mid.", ($fafaj, hossz: $hossz cm, átmérő: $ha cm, csomagolás: $cs, mennyiség: $menny, nedvesség: $nedv, ár: $ar)");
    }
  }} ?>
