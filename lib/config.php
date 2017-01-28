<?php

const DEBUG = True;

const L_INFO    = 'log-info';
const L_DEBUG   = 'log-debug';
const L_WARNING = 'log-warning';
const L_ERROR   = 'log-error';

const LOGLEVEL = L_INFO;

const LOCAL_DB = [
    'database_type' => 'mysql',
    'database_name' => 'nemestrinus',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
];
require_once('lib/log_events.php');


const DEPLOY_DB = [
    'database_type' => 'mysql',
    'database_name' => 'nemestrinus',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
];

const DB_DATA = (DEBUG ? LOCAL_DB : DEPLOY_DB);

const SERVER_URL = "localhost/";
const SERVER_PROTOCOL = "http://";

// logout after SESSION_TIMEOUT seconds of inactivity
const SESSION_TIMEOUT = DEBUG ? 3000 : 300;

const IMPLEMENTED_PAGES = [
    'sajat-profil',
    'main',
    'login',
    'error',

// TODO
    'uj-lakossagi-megrendeles',
    'uj-export-megrendeles',
    'lakossagi-megrendeles-attekintes',
    'export-megrendeles-attekintes',
    'lakossagi-megrendeles-osszesites',
    'export-megrendeles-osszesites',
    'felhasznalok',
    'gyartas',
    'szallitas',
    'fakitermeles',
    'export-megrendelok',
    'naplo'
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

// jogosultsagok
const R_MAIN            = 'main';
const R_ALAPANYAG       = 'alapanyag';
const R_GYARTAS         = 'gyartas';
const R_MEGRENDELES     = 'megrendeles';
const R_SZALLITAS       = 'szallitas';
const R_KIMUTATAS       = 'kimutatas';
const R_ADMINISZTRACIO  = 'adminisztracio';

const RIGHTS = [ 
    R_ALAPANYAG     => ['Al', 'Alapanyag'],
    R_GYARTAS       => ['Gy', 'Gyártás'],
    R_MEGRENDELES   => ['M', 'Megrendelés'],
    R_SZALLITAS     => ['Sz', 'Szállītás'],
    R_KIMUTATAS     => ['K', 'Kimutatás'],
    R_ADMINISZTRACIO=> ['Ad', 'Adminisztráció']
];

const PAGE_RIGHTS = [
    'alapanyag'                 => R_ALAPANYAG,
    'faanyag'                   => R_ALAPANYAG,
    'csomagoloanyag'            => R_ALAPANYAG,
    'faanyag-keszlet'           => R_ALAPANYAG, 
    'faanyag-bevitel'           => R_ALAPANYAG, 
    'faanyag-korrekcio'         => R_ALAPANYAG, 
    'csomagoloanyag-keszlet'    => R_ALAPANYAG, 
    'csomagoloanyag-bevitel'    => R_ALAPANYAG, 
    'csomagoloanyag-korrekcio'  => R_ALAPANYAG, 
    'gyartas'                   => R_GYARTAS,
    'termekgyartas'             => R_GYARTAS, 
    'megrendeles'               => R_MEGRENDELES,
    'lakossagi-osszesites'      => R_MEGRENDELES, 
    'lakossagi-megrendelesek'   => R_MEGRENDELES,
    'lakossagi-uj-megrendeles'  => R_MEGRENDELES,
    'export-osszesites'         => R_MEGRENDELES,
    'export-megrendelesek'      => R_MEGRENDELES,
    'export-uj-megrendeles'     => R_MEGRENDELES,
    'szallitas'                 => R_SZALLITAS,
    'kiszallitas'               => R_SZALLITAS,
    'kimutatas'                 => R_KIMUTATAS,
    'leltar'                    => R_KIMUTATAS,
    'fizetesek'                 => R_KIMUTATAS,
    'adminisztracio'            => R_ADMINISZTRACIO,
    'felhasznalok'              => R_ADMINISZTRACIO,
    'export-megrendelok'        => R_ADMINISZTRACIO,
    'naplo'                     => R_ADMINISZTRACIO,
    'sajat-profil'              => R_ADMINISZTRACIO,
    'main'                      => R_MAIN,
    'lakossagi'                 => R_MEGRENDELES,
    'export'                    => R_MEGRENDELES,
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