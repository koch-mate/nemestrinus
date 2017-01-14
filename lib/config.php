<?php

const SERVER_URL = "localhost/";
const SERVER_PROTOCOL = "http://";


const IMPLEMENTED_PAGES = [
    'uj-lakossagi-megrendeles',
    'uj-export-megrendeles',
    'lakossagi-megrendeles-attekintes',
    'export-megrendeles-attekintes',
    'lakossagi-megrendeles-osszesites',
    'export-megrendeles-osszesites',
    'login',
    'felhasznalok',
    'gyartas',
    'szallitas',
    'fakitermeles',
    'szemelyes-beallitasok',
    'export-megrendelok',
    'naplo',
    'main',
    'error'
];

// const CATEGORIES = ['alapanyag', 'gyartas', 'megrendeles', 'szallitas', 'kimutatas', 'adminisztracio'];


const MENU_STRUCT = [
    'alapanyag'         => [ 
        'faanyag' => [ 'faanyag_keszlet', 'faanyag_bevitel', 'faanyag_korrekcio'], 
        'csomagoloanyag' => [ 'csomagoloanyag_keszlet', 'csomagoloanyag_bevitel', 'csomagoloanyag_korrekcio'] 
    ],
    'gyartas'           => [
        'termekgyartas',
    ],
    'megrendeles'       => [
        'lakossagi' => ['lakossagi_osszesites', 'lakossagi_megrendelesek', 'lakossagi_uj_megrendeles'],
        'export' => ['export_osszesites', 'export_megrendelesek', 'export_uj_megrendeles'],
    ],
    'szallitas'         => [
        'kiszallitas',
    ],
    'kimutatas'         => [
        'leltar',
        'fizetesek',
    ],
    'adminisztracio'    => [
        'felhasznalok',
        'export_megrendelok',
        'naplo',
        'sajat_profil',
    ],
];

const  MENU_NAMES = [
    'alapanyag' => 'Alapanyag',
    'faanyag' => 'Faanyag',
    'csomagoloanyag' => 'Csomagolóanyag',
    'faanyag_keszlet' => 'Készlet', 
    'faanyag_bevitel' => 'Bevitel', 
    'faanyag_korrekcio' => 'Korrekció', 
    'csomagoloanyag_keszlet' => 'Készlet', 
    'csomagoloanyag_bevitel' => 'Bevitel', 
    'csomagoloanyag_korrekcio' => 'Korrekció', 
    'gyartas' => 'Gyártás',
    'termekgyartas' => 'Gyártás', 
    'megrendeles' => 'Megrendelés',
    'lakossagi_osszesites' => 'Összesítés', 
    'lakossagi_megrendelesek' => 'Megrendelések',
    'lakossagi_uj_megrendeles' => 'Új megrendelés',
    'export_osszesites' => 'Összesítés',
    'export_megrendelesek' => 'Megrendelések',
    'export_uj_megrendeles' => 'Új megrendelés',
    'szallitas' => 'Szállítás',
    'kiszallitas' => 'Szállítás',
    'kimutatas' => 'Kimutatás',
    'leltar' => 'Leltár',
    'fizetesek' => 'Kifizetések',
    'adminisztracio' => 'Adminisztráció',
    'felhasznalok' => 'Felhasználók',
    'export_megrendelok' => 'Export megrendelők',
    'naplo' => 'Napló',
    'sajat_profil' => 'Saját profil',
    'main' => 'Nyitólap',
    'lakossagi' => 'Lakossági',
    'export' => 'Export',
];

?>