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
    'export-megrendelok',
    'naplo',
    'csomagoloanyag-bevitel',
    'csomagoloanyag-keszlet',
    'csomagoloanyag-kiadas',
    'csomagoloanyag-korrekcio',
    'fatipus',
    'faanyag-bevitel',
    'faanyag-keszlet',
    'faanyag-kiadas',
    'faanyag-korrekcio',
    
// TODO - in progress
    'lakossagi-uj-megrendeles',
    'export-uj-megrendeles',

// TODO
    'uj-export-megrendeles',
    'lakossagi-megrendeles-attekintes',
    'export-megrendeles-attekintes',
    'lakossagi-megrendeles-osszesites',
    'export-megrendeles-osszesites',
    'felhasznalok',
    'gyartas',
    'szallitas',
    'fakitermeles',
];

const MENU_STRUCT = [
    'alapanyag'         => [ 
        'faanyag' => [ 'faanyag-keszlet', 'faanyag-bevitel', 'faanyag-kiadas', 'faanyag-korrekcio'], 
        'csomagoloanyag' => [ 'csomagoloanyag-keszlet', 'csomagoloanyag-bevitel', 'csomagoloanyag-kiadas', 'csomagoloanyag-korrekcio'] 
    ],
    'gyartas'           => [
        'termekgyartas',
    ],
    'megrendeles'       => [
        'lakossagi' => ['lakossagi-osszesites', 'lakossagi-megrendelesek', 'lakossagi-uj-megrendeles'],
        'export' => [
            'export-osszesites', 
            'export-megrendelesek', 
            'export-uj-megrendeles',
            'export-megrendelok',
        ],
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
        'fatipus',
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
    'faanyag-kiadas'            => R_ALAPANYAG, 
    'faanyag-korrekcio'         => R_ALAPANYAG, 
    'csomagoloanyag-keszlet'    => R_ALAPANYAG, 
    'csomagoloanyag-bevitel'    => R_ALAPANYAG, 
    'csomagoloanyag-kiadas'     => R_ALAPANYAG, 
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
    'export-megrendelok'        => R_MEGRENDELES,
    'naplo'                     => R_ADMINISZTRACIO,
    'sajat-profil'              => R_ADMINISZTRACIO,
    'main'                      => R_MAIN,
    'lakossagi'                 => R_MEGRENDELES,
    'export'                    => R_MEGRENDELES,
    'fatipus'                   => R_ADMINISZTRACIO,
];

const MENU_ICONS = [
    'csomagoloanyag-keszlet' => 'glyphicon-tasks', 
    'csomagoloanyag-bevitel' => 'glyphicon-log-in', 
    'csomagoloanyag-kiadas' => 'glyphicon-log-out', 
    'csomagoloanyag-korrekcio' => 'glyphicon-transfer',     

    'faanyag-keszlet' => 'glyphicon-tasks', 
    'faanyag-bevitel' => 'glyphicon-log-in', 
    'faanyag-kiadas' => 'glyphicon-log-out', 
    'faanyag-korrekcio' => 'glyphicon-transfer', 
    
    'lakossagi-uj-megrendeles' => 'glyphicon-edit',
    
    
    'export-uj-megrendeles' => 'glyphicon-edit',
    'export-megrendelok' => 'glyphicon-user',
];

const MENU_NAMES = [
    'alapanyag' => 'Alapanyag',
    'faanyag' => 'Faanyag',
    'csomagoloanyag' => 'Csomagolóanyag',
    'faanyag-keszlet' => 'Készlet', 
    'faanyag-bevitel' => 'Bevételezés', 
    'faanyag-kiadas' => 'Eladás', 
    'faanyag-korrekcio' => 'Korrekció', 
    'csomagoloanyag-keszlet' => 'Készlet', 
    'csomagoloanyag-bevitel' => 'Bevételezés', 
    'csomagoloanyag-kiadas' => 'Eladás', 
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
    'fatipus'   => 'Fatípusok',
];


const U_ERDESZETI_KOBMETER = 'ekob';
const U_TOMOR_KOBMETER = 'tkob';
const U_SZORT_URMETER = 'szur';
const U_RAKOTT_URMETER = 'rur';


const CSOMAGOLOANYAGOK = [
    'takaro'    =>  ['Takarófólia','m<sup>2</sup>'],
    'sztreccs'  =>  ['Sztreccsfólia','m'],
    'halo'      =>  ['Háló','m'],
    'raklap'    =>  ['Raklap','db'],
    'kaloda'    =>  ['Kaloda elem','db'],
];

const FORGALOM_BEVETEL = 'bevetel';
const FORGALOM_KORREKCIO = 'korrekcio';
const FORGALOM_KIADAS = 'kiadas';
const FORGALOM_FELHASZNALAS = 'felhasznalas';

const FORGALOM_DICT = [
    FORGALOM_BEVETEL => 'bevételezés',
    FORGALOM_KORREKCIO => 'korrekció',
    FORGALOM_KIADAS => 'kiadás',
    FORGALOM_FELHASZNALAS => 'felhasználás',
];

const FORGALOM_ICON = [
    FORGALOM_BEVETEL => 'glyphicon-log-in',
    FORGALOM_KORREKCIO => 'glyphicon-transfer',
    FORGALOM_KIADAS => 'glyphicon-log-out',
    FORGALOM_FELHASZNALAS => 'glyphicon-compressed',
];

const F_KEMENY      = 'kemény lombos';
const F_LAGY        = 'lágy lombos';
const F_FENYOFELE   = 'fenyő';

const F_AKAC            = 'akac';
const F_BUKK            = 'bukk';
const F_CSER            = 'cser';
const F_GYERTYAN        = 'gyertyan';
const F_KORIS           = 'koris';
const F_TOLGY           = 'tolgy';
const F_FENYO           = 'fenyo';
const F_EGYEB_KEMENY    = 'egyeb_kemeny';
const F_EGYEB_LAGY      = 'egyeb_lagy';
    
const FATIPUSOK = [
    F_AKAC => ['akác',F_KEMENY],
    F_BUKK => ['bükk',F_KEMENY],
    F_CSER => ['cser',F_KEMENY],
    F_GYERTYAN => ['gyertyán',F_KEMENY],
    F_KORIS => ['kőris',F_KEMENY],
    F_TOLGY => ['tölgy',F_KEMENY],
    F_FENYO => ['fenyő',F_FENYOFELE],
    F_EGYEB_KEMENY => ['egyéb kemény lombos',F_KEMENY],
    F_EGYEB_LAGY => ['egyéb lágy lombos',F_LAGY],
];

const EGYUTAS_KALODA_KICSI = 'egyutas_kicsi';
const EGYUTAS_KALODA_NAGY = 'egyutas_nagy';
const VISSZAVALTHATO_KALODA_KICSI = 'vv_kicsi';
const VISSZAVALTHATO_KALODA_NAGY = 'vv_nagy';
const POSCH_HALOS = 'posch_halos';
const POSCH_HALOS_FOLIAS = 'posch_halos_folias';
const OMLESZTETT = 'omlesztett';


const CSOMAGOLASTIPUSOK = [
    EGYUTAS_KALODA_KICSI        => ['egyutas kaloda (kicsi)', 'db', 0.9, U_RAKOTT_URMETER ],
    EGYUTAS_KALODA_NAGY         => ['egyutas kaloda (nagy)', 'db', 1.165, U_RAKOTT_URMETER ],
    VISSZAVALTHATO_KALODA_KICSI => ['visszaváltható kaloda (kicsi)', 'db', 1, U_RAKOTT_URMETER],
    VISSZAVALTHATO_KALODA_NAGY  => ['visszaváltható kaloda (nagy)', 'db', 2, U_RAKOTT_URMETER],
    POSCH_HALOS                 => ['Posch hálós', 'db', 2.1, U_SZORT_URMETER],
    POSCH_HALOS_FOLIAS          => ['Posch hálós, fóliázott', 'db', 2.1, U_SZORT_URMETER],
    OMLESZTETT                  => ['Ömlesztett', 'm<sup>3</sup>', 1, U_SZORT_URMETER]
]; 

// megrendelesek

const M_LAKOSSAGI = 'lakossagi';
const M_EXPORT = 'export';

const M_S_FELDOLGOZAS_ALATT     = 'feldolgozás alatt';
const M_S_ELFOGADVA             = 'elfogadva';
const M_S_TELJESITVE            = 'teljesítve';
const M_S_VISSZAUTASITVA        = 'visszautasítva';
const M_S_VARAKOZIK             = 'várakozik';
const M_S_VISSZAMONDOTT         = 'visszamondott';

// penznemek
const P_FORINT = 'Ft';
const P_EURO = 'EUR';

?>