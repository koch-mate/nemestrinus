<?php

header('Content-type: application/json');

$url = 'https://maps.googleapis.com/maps/api/distancematrix/json';
$key = 'AIzaSyCNgpxoeDSu7tMM5SoTo0d-Gh3JZHrrXAY';
$o = $_POST['origins'];
$d = $_POST['destinations'];

echo file_get_contents("$url?origins=$o&destinations=$d&key=$key");

 ?>