<?php

function unitChange($form, $to, $x){
    $x = 1.0 / U_FACT[$form] * $x;
    return $x * U_FACT[$to];
}

function rnd($x){
    return round($x * (10 ** ROUND_DIGITS))/(10 ** ROUND_DIGITS);
}

?>
