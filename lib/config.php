<?php

const DEBUG = True;


const SERVER_URL = "localhost/";
const SERVER_PROTOCOL = "http://";

// logout after SESSION_TIMEOUT seconds of inactivity
const SESSION_TIMEOUT = 10;

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

const MENU_STRUCT = [
    'alapanyag'         => [ 
        'faanyag' => [ 'faanyag-keszlet', 'faanyag-bevitel', 'faanyag-korrekcio'], 
        'csomagoloanyag' => [ 'csomagoloanyag-keszlet', 'csomagoloanyag-bevitel', 'csomagoloanyag-korrekcio'] 
    ],
    'gyartas'           => [
        'termekgyartas',
    ],
    'megrendeles'       => [
        'lakossagi' => ['lakossagi-osszesites', 'lakossagi-megrendelesek', 'lakossagi-uj-megrendeles'],
        'export' => ['export-osszesites', 'export-megrendelesek', 'export-uj-megrendeles'],
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
        'export-megrendelok',
        'naplo',
        'sajat-profil',
    ],
];

const PAGE_RIGHTS = [
    'alapanyag' => 'alapanyag',
    'faanyag' => 'alapanyag',
    'csomagoloanyag' => 'alapanyag',
    'faanyag-keszlet' => 'alapanyag', 
    'faanyag-bevitel' => 'alapanyag', 
    'faanyag-korrekcio' => 'alapanyag', 
    'csomagoloanyag-keszlet' => 'alapanyag', 
    'csomagoloanyag-bevitel' => 'alapanyag', 
    'csomagoloanyag-korrekcio' => 'alapanyag', 
    'gyartas' => 'gyartas',
    'termekgyartas' => 'gyartas', 
    'megrendeles' => 'megrendeles',
    'lakossagi-osszesites' => 'megrendeles', 
    'lakossagi-megrendelesek' => 'megrendeles',
    'lakossagi-uj-megrendeles' => 'megrendeles',
    'export-osszesites' => 'megrendeles',
    'export-megrendelesek' => 'megrendeles',
    'export-uj-megrendeles' => 'megrendeles',
    'szallitas' => 'szallitas',
    'kiszallitas' => 'szallitas',
    'kimutatas' => 'kimutatas',
    'leltar' => 'kimutatas',
    'fizetesek' => 'kimutatas',
    'adminisztracio' => 'adminisztracio',
    'felhasznalok' => 'adminisztracio',
    'export-megrendelok' => 'adminisztracio',
    'naplo' => 'adminisztracio',
    'sajat-profil' => 'adminisztracio',
    'main' => 'main',
    'lakossagi' => 'megrendeles',
    'export' => 'megrendeles',
    'szemelyes-beallitasok' => 'adminisztracio',
];

const MENU_NAMES = [
    'alapanyag' => 'Alapanyag',
    'faanyag' => 'Faanyag',
    'csomagoloanyag' => 'Csomagolóanyag',
    'faanyag-keszlet' => 'Készlet', 
    'faanyag-bevitel' => 'Bevitel', 
    'faanyag-korrekcio' => 'Korrekció', 
    'csomagoloanyag-keszlet' => 'Készlet', 
    'csomagoloanyag-bevitel' => 'Bevitel', 
    'csomagoloanyag-korrekcio' => 'Korrekció', 
    'gyartas' => 'Gyártás',
    'termekgyartas' => 'Gyártás', 
    'megrendeles' => 'Megrendelés',
    'lakossagi-osszesites' => 'Összesítés', 
    'lakossagi-megrendelesek' => 'Megrendelések',
    'lakossagi-uj-megrendeles' => 'Új megrendelés',
    'export-osszesites' => 'Összesítés',
    'export-megrendelesek' => 'Megrendelések',
    'export-uj-megrendeles' => 'Új megrendelés',
    'szallitas' => 'Szállítás',
    'kiszallitas' => 'Szállítás',
    'kimutatas' => 'Kimutatás',
    'leltar' => 'Leltár',
    'fizetesek' => 'Kifizetések',
    'adminisztracio' => 'Adminisztráció',
    'felhasznalok' => 'Felhasználók',
    'export-megrendelok' => 'Export megrendelők',
    'naplo' => 'Napló',
    'sajat-profil' => 'Saját profil',
    'main' => 'Nyitólap',
    'lakossagi' => 'Lakossági',
    'export' => 'Export',
    'szemelyes-beallitasok' => 'Személyes beállítások',
];

?>