<?php

function packagingAdd(){
    global $db;
    $db->insert('csomagoloanyag', ['Tipus'=>$_POST['r_cs'], 'Mennyiseg'=>$_POST['mennyiseg'], 'Szamlaszam'=>$_POST['szlaszam'], 'Datum'=>$_POST['datum'], 'Megjegyzes'=>$_POST['megj']]);
}
?>