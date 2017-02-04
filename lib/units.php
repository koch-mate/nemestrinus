<?php

const U_ERDESZETI_KOBMETER = 'ekob';
const U_TOMOR_KOBMETER = 'tkob';
const U_SZORT_URMETER = 'szur';
const U_RAKOTT_URMETER = 'rur';

const U_NAMES = [
    U_TOMOR_KOBMETER => ['tömör köbméter','t. m<sup>3</sup>'],
    U_ERDESZETI_KOBMETER => ['erdészeti köbméter','e. m<sup>3</sup>'],
    U_SZORT_URMETER => ['szórt űrméter','sz. űm'],
    U_RAKOTT_URMETER => ['rakott űrméter','r. űm'],
];

// 1 tomor kobmeter hany _____-nak felel meg?
const U_FACT = [
    U_TOMOR_KOBMETER => 1.0,
    U_ERDESZETI_KOBMETER => 1.7,
    U_SZORT_URMETER => 2.0,
    U_RAKOTT_URMETER => 1.4
];

const U_STD = U_TOMOR_KOBMETER;

function unitChange($form, $to, $x){
    $x = 1.0 / U_FACT[$form] * $x; 
    return $x * U_FACT[$to]; 
}


?>