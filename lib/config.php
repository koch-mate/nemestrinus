<?php
// the following line *MUST* remain line 3 in the file! //
const DEBUG = True;

const L_INFO    = 'log-info';
const L_DEBUG   = 'log-debug';
const L_WARNING = 'log-warning';
const L_ERROR   = 'log-error';

const LOGLEVEL = (DEBUG ? L_INFO : L_WARNING);

const LOCAL_DB = [
    'database_type' => 'mysql',
    'database_name' => 'nemestrinus',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
];


const DEPLOY_DB = [
    'database_type' => 'mysql',
    'database_name' => 'legnad_mgmt',
    'server' => 'localhost',
    'username' => 'legnadsql',
    'password' => 'sql3r10o9',
    'charset' => 'utf8'
];

const DB_DATA = (DEBUG ? LOCAL_DB : DEPLOY_DB);

const SERVER_URL = (DEBUG ? "localhost/" : "mgmt.ihartu.hu");
const SERVER_PROTOCOL = (DEBUG ? "http://" : "http://");

const MAIL_FROM = 'no-reply@ihartu.hu';
const MAIL_NAME = 'Ihartu Kft. Automated Mailer';

// logout after SESSION_TIMEOUT seconds of inactivity
const SESSION_TIMEOUT = DEBUG ? 3000 : 600;

const MONTHS = [
    1 => 'január',
    2 => 'február',
    3 => 'március',
    4 => 'április',
    5 => 'május',
    6 => 'június',
    7 => 'július',
    8 => 'augusztus',
    9 => 'szeptember',
    10 => 'október',
    11 => 'november',
    12 => 'december',
];

const IMPLEMENTED_PAGES = [
    'sajat-profil',
    'main',
    'login',
    'error',
    'export-megrendelok',
    'naplo',
    'csomagoloanyag-bevitel',
    'csomagoloanyag-keszletmozgas',
    'csomagoloanyag-keszlet',
    'csomagoloanyag-kiadas',
    'csomagoloanyag-korrekcio',
    'fatipus',
    'faanyag-bevitel',
    'faanyag-keszletmozgas',
    'faanyag-keszlet',
    'faanyag-kiadas',
    'faanyag-korrekcio',
    'felhasznalok',
    'kiszallitas-lezart',
    'gyartas-fuggo',
    'gyartas-lezart',
    'lakossagi-uj-megrendeles',
    'export-uj-megrendeles',
    'megrendeles-osszesites',
    'termekgyartas',
    'konstansok',
    'kiszallitas-fuggo',
    'keszlet-osszesito',
    'beszallitas-fuggo',
    'arlista',

];

const MENU_STRUCT = [
    'beszallitas' => [
        'beszallitas-fuggo'
    ],
    'alapanyag'         => [
        'alapanyag'=>[ 'keszlet-osszesito' ],
        'faanyag' => [ 'faanyag-keszlet','faanyag-keszletmozgas', 'faanyag-bevitel', 'faanyag-kiadas', 'faanyag-korrekcio'],
        'csomagoloanyag' => [ 'csomagoloanyag-keszlet', 'csomagoloanyag-keszletmozgas', 'csomagoloanyag-bevitel', 'csomagoloanyag-kiadas', 'csomagoloanyag-korrekcio']
    ],
    'gyartas'           => [
        'gyartas-fuggo', 'gyartas-lezart', // 'termekgyartas',
    ],
    'megrendeles'       => [
        'megrendelesek' => ['megrendeles-osszesites', /* 'megrendeles-lezart' FIXME */],
        'lakossagi' => ['lakossagi-uj-megrendeles'],
        'export' => [
            'export-uj-megrendeles',
            'export-megrendelok',
        ],
    ],
    'szallitas'         => [
        'kiszallitas-fuggo',
        'kiszallitas-lezart',
    ],
    'kimutatas'         => [
//        'leltar',
//        'fizetesek',
    ],
    'adminisztracio'    => [
        'felhasznalok',
        'fatipus',
        'konstansok',
        'arlista',
        'naplo',
        'sajat-profil',
    ],
];

// jogosultsagok
const R_MAIN            = 'main';
const R_BESZALLITAS     = 'beszallitas';
const R_ALAPANYAG       = 'alapanyag';
const R_GYARTAS         = 'gyartas';
//const R_MEGRENDELES     = 'megrendeles';
const R_LAK_MEGRENDELES     = 'lakossagi_megrendeles';
const R_EXP_MEGRENDELES     = 'export_megrendeles';
const R_SZALLITAS       = 'szallitas';
const R_KIMUTATAS       = 'kimutatas';
const R_ADMINISZTRACIO  = 'adminisztracio';

const RIGHTS = [
    R_BESZALLITAS   => ['Bsz', 'Beszállítás'],
    R_ALAPANYAG     => ['Al', 'Alapanyag'],
    R_GYARTAS       => ['Gy', 'Gyártás'],
//    R_MEGRENDELES   => ['M', 'Megrendelés'],
    R_LAK_MEGRENDELES   => ['LM', 'Lakossági megrendelés'],
    R_EXP_MEGRENDELES   => ['EM', 'Export megrendelés'],
    R_SZALLITAS     => ['Sz', 'Szállītás'],
    R_KIMUTATAS     => ['K', 'Kimutatás'],
    R_ADMINISZTRACIO=> ['Ad', 'Adminisztráció']
];

const PAGE_RIGHTS = [
    'beszallitas'               => R_BESZALLITAS,
    'beszallitas-fuggo'         => R_BESZALLITAS,
    'alapanyag'                 => R_ALAPANYAG,
    'keszlet-osszesito'         => R_ALAPANYAG,
    'faanyag'                   => R_ALAPANYAG,
    'csomagoloanyag'            => R_ALAPANYAG,
    'faanyag-keszletmozgas'     => R_ALAPANYAG,
    'faanyag-keszlet'           => R_ALAPANYAG,
    'faanyag-bevitel'           => R_ALAPANYAG,
    'faanyag-kiadas'            => R_ALAPANYAG,
    'faanyag-korrekcio'         => R_ALAPANYAG,
    'csomagoloanyag-keszlet'    => R_ALAPANYAG,
    'csomagoloanyag-keszletmozgas' => R_ALAPANYAG,
    'csomagoloanyag-bevitel'    => R_ALAPANYAG,
    'csomagoloanyag-kiadas'     => R_ALAPANYAG,
    'csomagoloanyag-korrekcio'  => R_ALAPANYAG,
    'gyartas'                   => R_GYARTAS,
    'termekgyartas'             => R_GYARTAS,
    'gyartas-fuggo'             => R_GYARTAS,
    'gyartas-lezart'            => R_GYARTAS,
    'megrendeles'               => R_LAK_MEGRENDELES,
    'megrendelesek'             => R_EXP_MEGRENDELES,
    'megrendeles-osszesites'    => R_EXP_MEGRENDELES,
    'megrendeles-lezart'        => R_EXP_MEGRENDELES,
    'lakossagi-uj-megrendeles'  => R_LAK_MEGRENDELES,
    'export-uj-megrendeles'     => R_EXP_MEGRENDELES,
    'szallitas'                 => R_SZALLITAS,
    'kiszallitas-fuggo'         => R_SZALLITAS,
    'kiszallitas-lezart'        => R_SZALLITAS,
    'kimutatas'                 => R_KIMUTATAS,
    'leltar'                    => R_KIMUTATAS,
    'fizetesek'                 => R_KIMUTATAS,
    'adminisztracio'            => R_ADMINISZTRACIO,
    'felhasznalok'              => R_ADMINISZTRACIO,
    'export-megrendelok'        => R_EXP_MEGRENDELES,
    'naplo'                     => R_ADMINISZTRACIO,
    'sajat-profil'              => R_ADMINISZTRACIO,
    'main'                      => R_MAIN,
    'lakossagi'                 => R_LAK_MEGRENDELES,
    'export'                    => R_EXP_MEGRENDELES,
    'fatipus'                   => R_ADMINISZTRACIO,
    'konstansok'                => R_ADMINISZTRACIO,
    'arlista'                   => R_ADMINISZTRACIO,
];

const MENU_ICONS = [
    'csomagoloanyag-keszlet' => 'glyphicon-tasks',
    'csomagoloanyag-keszletmozgas' => 'glyphicon-time',
    'csomagoloanyag-bevitel' => 'glyphicon-log-in',
    'csomagoloanyag-kiadas' => 'glyphicon-log-out',
    'csomagoloanyag-korrekcio' => 'glyphicon-transfer',

    'keszlet-osszesito' => 'fa-bar-chart',
    'faanyag-keszletmozgas' => 'glyphicon-time',
    'faanyag-keszlet' => 'glyphicon-tasks',
    'faanyag-bevitel' => 'glyphicon-log-in',
    'faanyag-kiadas' => 'glyphicon-log-out',
    'faanyag-korrekcio' => 'glyphicon-transfer',

    'lakossagi-uj-megrendeles' => 'glyphicon-edit',

    'export-uj-megrendeles' => 'glyphicon-edit',
    'export-megrendelok' => 'glyphicon-user',

    'megrendeles-osszesites' => 'glyphicon-shopping-cart',
    'megrendeles-lezart' => 'glyphicon-check',

    'felhasznalok' => 'fa-users',
    'fatipus' => 'glyphicon-tree-deciduous',
    'naplo' => 'glyphicon-book',
    'sajat-profil' => 'fa-user',
    'konstansok' => 'fa-cogs',
    'arlista' => 'fa-money',

    'gyartas-fuggo' => 'glyphicon-cog',
    'gyartas-lezart' => 'glyphicon-check',

    'kiszallitas-fuggo' => 'fa-truck',
    'kiszallitas-lezart' => 'glyphicon-check',

];

const MENU_NAMES = [
    'beszallitas' => 'Beszállítás',
    'beszallitas-fuggo' => 'Beszállítás',
    'alapanyag' => 'Alapanyag',
    'keszlet-osszesito' => 'Készlet összesítő',
    'faanyag' => 'Faanyag',
    'csomagoloanyag' => 'Csomagolóanyag',
    'faanyag-keszletmozgas' => 'Készletmozgás',
    'faanyag-keszlet' => 'Raktárkészlet',
    'faanyag-bevitel' => 'Bevételezés',
    'faanyag-kiadas' => 'Eladás',
    'faanyag-korrekcio' => 'Korrekció',
    'csomagoloanyag-keszlet' => 'Raktárkészlet',
    'csomagoloanyag-keszletmozgas' => 'Készletmozgás',
    'csomagoloanyag-bevitel' => 'Bevételezés',
    'csomagoloanyag-kiadas' => 'Eladás',
    'csomagoloanyag-korrekcio' => 'Korrekció',
    'gyartas' => 'Gyártás',
    'gyartas-fuggo' => 'Függő gyártások',
    'gyartas-lezart' => 'Lezárult gyártások',
    'termekgyartas' => 'Gyártás',
    'megrendeles' => 'Megrendelés',
    'megrendelesek'=> 'Összesítés',
    'megrendeles-osszesites' => 'Összes megrendelés',
    'megrendeles-lezart' => 'Lezárt megrendelések',
    'lakossagi-uj-megrendeles' => 'Új megrendelés',
    'export-uj-megrendeles' => 'Új megrendelés',
    'szallitas' => 'Szállítás',
    'kiszallitas-fuggo' => 'Szállításra váró tételek',
    'kiszallitas-lezart' => 'Lezárt megrendelések',
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
    'konstansok'   => 'Konstansok',
    'arlista' => 'Árlista',
];


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

const ROUND_DIGITS = 2; // kerekites pontossaga megjeleniteskor

const CS_TAKARO   = 'takaro';
const CS_SZTRECCS = 'sztreccs';
const CS_HALO     = 'halo';
const CS_RAKLAP   = 'raklap';
const CS_KALODA   = 'kaloda';

const CSOMAGOLOANYAGOK = [
    CS_TAKARO    =>  ['Takarófólia','m<sup>2</sup>'],
    CS_SZTRECCS  =>  ['Sztreccsfólia','m'],
    CS_HALO      =>  ['Háló','m'],
    CS_RAKLAP    =>  ['Raklap','db'],
    CS_KALODA    =>  ['Kaloda elem','db'],
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
    FORGALOM_FELHASZNALAS => 'glyphicon-cog',
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

const EGYUTAS_KALODA_KICSI          = 'egyutas_kicsi';
const EGYUTAS_KALODA_NAGY           = 'egyutas_nagy';
const VISSZAVALTHATO_KALODA_KICSI   = 'vv_kicsi';
const VISSZAVALTHATO_KALODA_NAGY    = 'vv_nagy';
const POSCH_HALOS                   = 'posch_halos';
const POSCH_HALOS_FOLIAS            = 'posch_halos_folias';
const OMLESZTETT                    = 'omlesztett';


const CSOMAGOLASTIPUSOK = [
    EGYUTAS_KALODA_KICSI        => ['Egyutas kaloda (kicsi)', 'db', 0.9, U_RAKOTT_URMETER ],
    EGYUTAS_KALODA_NAGY         => ['Egyutas kaloda (nagy)', 'db', 1.165, U_RAKOTT_URMETER ],
    VISSZAVALTHATO_KALODA_KICSI => ['Visszaváltható kaloda (kicsi)', 'db', 1, U_RAKOTT_URMETER],
    VISSZAVALTHATO_KALODA_NAGY  => ['Visszaváltható kaloda (nagy)', 'db', 2, U_RAKOTT_URMETER],
    POSCH_HALOS                 => ['Posch hálós', 'db', 2.1, U_SZORT_URMETER],
    POSCH_HALOS_FOLIAS          => ['Posch hálós, fóliázott', 'db', 2.1, U_SZORT_URMETER],
    OMLESZTETT                  => ['Ömlesztett', 'm<sup>3</sup>', 1, U_SZORT_URMETER]
];

const CS_FELHASZNALAS = [
    EGYUTAS_KALODA_KICSI        => [CS_TAKARO => 0, CS_SZTRECCS => 0, CS_HALO => 0, CS_RAKLAP => 0, CS_KALODA  => 0],
    EGYUTAS_KALODA_NAGY         => [CS_TAKARO => 0, CS_SZTRECCS => 0, CS_HALO => 0, CS_RAKLAP => 0, CS_KALODA  => 0],
    VISSZAVALTHATO_KALODA_KICSI => [CS_TAKARO => 0, CS_SZTRECCS => 0, CS_HALO => 0, CS_RAKLAP => 1, CS_KALODA  => 2],
    VISSZAVALTHATO_KALODA_NAGY  => [CS_TAKARO => 0, CS_SZTRECCS => 0, CS_HALO => 0, CS_RAKLAP => 1, CS_KALODA  => 4],
    POSCH_HALOS                 => [CS_TAKARO => 0, CS_SZTRECCS => 0, CS_HALO => 5, CS_RAKLAP => 1, CS_KALODA  => 0],
    POSCH_HALOS_FOLIAS          => [CS_TAKARO => 4, CS_SZTRECCS => 0, CS_HALO => 5, CS_RAKLAP => 1, CS_KALODA  => 0],
    OMLESZTETT                  => [CS_TAKARO => 0, CS_SZTRECCS => 0, CS_HALO => 0, CS_RAKLAP => 0, CS_KALODA  => 0]
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

const M_S_STATUSZOK = [M_S_FELDOLGOZAS_ALATT, M_S_ELFOGADVA, M_S_TELJESITVE, M_S_VISSZAUTASITVA, M_S_VARAKOZIK, M_S_VISSZAMONDOTT];

const M_S_SZINEK = [
    M_S_FELDOLGOZAS_ALATT     => ['#FFB03B', 'question' ],
    M_S_ELFOGADVA             => ['#82BF4B', 'cog'],
    M_S_TELJESITVE            => ['#164C20', 'check'],
    M_S_VISSZAUTASITVA        => ['#8E2800', 'close'],
    M_S_VARAKOZIK             => ['#B64926', 'hourglass-half'],
    M_S_VISSZAMONDOTT         => ['#473F39', 'user-times'],
];

const M_S_AKTIV = [
    M_S_FELDOLGOZAS_ALATT,
    M_S_ELFOGADVA,
    M_S_VARAKOZIK,
];

const M_S_GYARTHATO = [
  M_S_ELFOGADVA,
  M_S_VARAKOZIK,
];

const M_S_LEZART = [
    M_S_TELJESITVE,
    M_S_VISSZAUTASITVA,
    M_S_VISSZAMONDOTT
];

// gyartas statusza
const GY_S_VISSZAIGAZOLASRA_VAR     = 'visszaigazolásra vár';
const GY_S_GYARTASRA_VAR            = 'gyártásra vár';
const GY_S_LEGYARTVA                = 'legyártva';
const GY_S_VISSZAUTASITVA           = 'visszautasítva';

const GY_S_STATUSZOK = [GY_S_VISSZAIGAZOLASRA_VAR, GY_S_GYARTASRA_VAR, GY_S_LEGYARTVA, GY_S_VISSZAUTASITVA];

const GY_S_SZINEK = [
    GY_S_VISSZAIGAZOLASRA_VAR   => ['#FF8139', 'question', 'vv'],
    GY_S_GYARTASRA_VAR          => ['#F7D52F', 'cog', 'gyv'],
    GY_S_LEGYARTVA              => ['#0B630E', 'check', 'l'],
    GY_S_VISSZAUTASITVA         => ['#B63620', 'close', 'v'],
];

const GY_S_AKTIV = [
    GY_S_VISSZAIGAZOLASRA_VAR,
    GY_S_GYARTASRA_VAR,
];

// szallitas statusza
const SZ_S_GYARTAS_ALATT    = 'gyártás alatt';
const SZ_S_SZALLITASRA_VAR  = 'szállításra vár';
const SZ_S_LESZALLITVA      = 'leszállítva';

const SZ_S_SZINEK = [
    SZ_S_GYARTAS_ALATT  => ['#FF8139', 'hourglass-start'],
    SZ_S_SZALLITASRA_VAR=> ['#F7D52F', 'truck'],
    SZ_S_LESZALLITVA    => ['#0B630E', 'check'],

];

// fizetes statusza
const F_S_FIZETESRE_VAR = 'fizetésre vár';
const F_S_FIZETVE = 'fizetve';

const F_S_SZINEK = [
    F_S_FIZETESRE_VAR => ['#B63620', 'close'],
    F_S_FIZETVE => ['#0B630E', 'check'],
];

// penznemek
const P_FORINT = 'Ft';
const P_EURO = 'EUR';


// nedvesseg
const N_FRISS = 'nedves';
const N_FELSZARAZ = 'felszaraz';
const N_SZARAZ = 'szaraz';
const NEDVESSEG = [N_SZARAZ => [1, 'száraz'], N_FELSZARAZ => [2,'félszáraz'], N_FRISS => [3,'friss']];

// gyartasi idok (napban)
const GYARTASI_IDO = [
  M_EXPORT => [
    N_FRISS => 4*7,
    N_FELSZARAZ => 10*7,
    N_SZARAZ => 16*7,
  ],
  M_LAKOSSAGI => [
    N_FRISS => 10,
    N_FELSZARAZ => 10*7,
    N_SZARAZ => 16*7,
  ],
];

// varhato szallitasi ido
const SZALLITASI_IDO = [
  M_EXPORT => 10,
  M_LAKOSSAGI => 7
]
?>
