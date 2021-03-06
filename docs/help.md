# Programleírás

## Bevezető

Az alábbi leírás a NEMESTRINUS Tűzifa megrendelés, gyártás és szállítás nyilvántartó program működését írja le. A program egyedi fejlesztés, célja az IHARTÜ Kft. tűzifa gyártási folyamatainak minél pontosabb modellezése, a megrendelések kezelése, a készletek nyilvántartása és az alapanyag igény számítása. A program a teljes folyamat megrendelési-gyártási folyamatot végigköveti, és lehetőséget nyújt a jogosultságok kezelésére is, így minden felhasználó csak a számára szükséges információkat látja.

### Technikai háttér

A program webes technológiákra épül, a [mediacenter](http://www.mediacenter.hu) tárhelyszolgáltató cég távoli szerverén fut, Interneten keresztül érhető el bárhonnan. Szinte bármilyen számítógépen működik, amely képes a mai modern weblapok megjelenítésére, de hatékony használathoz minimum az alábbi konfiguráció javasolt:

  - 2GHz CPU
  - 8GB memória
  - Windows 7 64bit
  - Google Chrome vagy Mozilla Firefox böngészők 2015 után kiadott verziója
  - 15" monitor

Ha nagymennyiségű adatot (többszáz megrendelést) szeretnénk egyszerre, gördülékenyen kezelni, akkor javasolt a fenti minimum követelményeknél jóval erősebb konfiguráció.

Az áttekinthetőséget segíti, ha a munka során 24", vagy nagyobb kijelzőt használunk.

### Mobil eszközök használata

A program úgynevezett reszponzív designt használ, a felhasználói felület egyes elemei változnak a képernyő méretével. Ez lehetővé teszi a mobil eszközök használatát is. Android, Windows és Apple rendszereken is működik, a gyári beépített böngészőkkel.

## Munkamenetek

A program két irányból modellezi az Ihartü vállalatnál történő folyamatokat:
 - egyrészt a megrendelések irányából (megrendelések rögzítése, életciklusa, fizetési állapota, stb.)
 - másrész az alapanyag feldolgozásának irányából (alapanyagok igénye, bevételezése, felhasználása, termékgyártás és kiszállítás)
A két irány természetesen szorosan összefügg mind a valóságban, mind a programban.

### Áttekintés

A programban először az aktuális raktárkészletet kell rögzíteni. A Készlet alatti Bevitelezés menüpontok teszik lehetővé a faanyag, illetve csomagolóanyag készletek rögzítését.

Ha már van készlet, fel lehet venni a megrendeléseket a Megrendelés menü alatt. A lakossági célú és export megrendelések során felvett adatok eltérőek, ezért külön menüpontban találhatók.

A rögzített megrendeléseket elsőként jóvá kell hagyni. Amint a megrendelés státusza __feldolgozás alatt__ról __elfogadva__ státuszra változik, a gyártás oldalon is megjelenik a megrendelés.

A megrendelést a gyártásért felelős kolléga visszaigazolja, megadja a várható gyártási dátumot. Amikor a gyártás ténylegesen megindul, a készleten lévő fa-, és csomagolóanyag felhasználásával elkészül a késztermék.

Ha a megrendelés minden tétele legyártódott, a megrendelés átkerül szállítás alá, melynek során a szállításért felelős kolléga rögzíti a szállítás adatait és tényét.

A megrendelések minden adatát, a gyártás alakulását, és a tételesen felhasznált alapanyagokat minden pillanatban nyomon lehet követni. A Kimutatások segítségével egyedi jelentéseket lehet generálni a a programban szereplő adatok bármilyen részhalmazából.

A következő pontokban részletesen bemutatásra kerül a program minden egyes funkciója.


### Alapanyag kezelés

#### Alapanyag menü

Ez a menüpont a felvett, de még nem teljesített, jövőbeli megrendelések alapanyagszükségletét mutatja.
Az első oszlop a fafajokat listázza, mindegyik fafaj mellett 2 sornyi adat szerepel. A felső sor a Havi előjegyzést, vagyis az adott hónapban szükséges behozatalt, a második sor pedig a kumulált készletet, vagyis az addigi hónapok előjegyzésének összegével csökkentett készletet mutatja. Az első oszlop mindig az aktuális készletet tartalmazza, az egyes hónapokra előirányzott rendelési mennyiség ebből kerül levonásra. A program piros színnel jelzi, ha az adott hónapban több megrendelés van, mint készleten lévő alapanyag.

Az utolsó oszlop a 11 hónappal későbbi, és bármely azutáni megrendelést összesíti.

A megjelenített adatok a következőképpen számolódnak:
 1. rögzítünk egy megrendelést, amely valamilyen fafajból adott nedvességtartalmú és mennyiségű alapanyagot igényel
 2. a megrendelés során rögzítésre kerül az ígért teljesítési dátum is
 2. a program konstansai között szerepel egy tipikus szállítási idő, és száradási idők is
 2. ezen konstansok felhasználásával a program visszaszámolja a szállítási és a száradási/gyártási időket az ígért teljesítési dátumból, és eszerint jeleníti meg a megfelelő hónapban a beszállíási igényzott

Ha például 2017 szeptemberében veszünk fel egy megrendelést 2018 májusára, száraz bükkfára, akkor a program a jelenleg megadott száradási, gyártási és szállítási idők alapján 2018 februárjára fogja előjelezni az alapanyag szükségletet. Ha például 10 köbméter a rendelt mennyiség, de a kumulált készlet 2018 januárjában csak 8 köbméter, akkor februárban -2 köbméter hiányt fog jelezni, ennyi faanyagot kell beszállítani, hogy a majusi megrendelést teljesíteni lehessen.
Természetesen egy hónap alatt sok megrendelés lehet, és egy megrendelésen belül is lehet igény száraz és félszáraz fára, ezeket a program mind figyelembeveszi.

### Készlet

#### Készlet - Készlet összesítő

A Készlet összesítő a pillanatnyi készlet és a rendszerben lévő megrendelések összességét mutatja a faanyagokra és a csomagolóanyagokra egyaránt.

  - Az Aktuális készlet oszlop mutatja a rendszerben lévő szabad mennyiséget a fafajokból. Ha ez kisebb, mint 0, akkor az adatok nem konzisztensek, valamilyen bevételezés nem került rögzítésre, vagy korrekcióval kell élni.
  - A Gyártásra váró megrendelés oszlop tartalmazza az összes megrendelés tételt, ami a rendszerben rögzítésre került, de még nincs legyártva. Ha ez az oszlop piros, akkor nincs elég alapanyag pillanatnzilag, a gyártás megkezdése előtt mindenképpen kell majd beszállítani.
  - A Maradék oszlop mutatja a az első két oszlop különbségét. A zöld szín jelenti, hogy több alapanyag van jelenleg készleten, mint amennyi a gyártásra váró tételek teljesítéséhez szükséges, a piros szín pedig azt, hogy az összes gyártásra váró tétel teljesítéséhez még alapanyagot kell behozni.
  - A Felhasználás + Értékesítés oszlop azt mutatja, hogy az adott típusból a múltban mennyi megrendelés került felhasználásra gyártás során, illetve közvetlen értékesítésre.


#### Faanyag - Raktárkészlet

A Faanyag raktárkészet az aktuálisan még készleten lévő bevételezett mennyiségeket mutatja fafajonként. A fafajok között az ikonokra kattintva lehet váltani.
Az egyes fafajokra kijelzi a teljes készleten lévő mennyiséget, illetve azt is, hogy milyen tételekből áll ez össze.

A részletező táblázat a következő adatokat tartalmazza:
 1. ID: a bevételezett tétel egyedi azonosítója
 2. Forg.: a forgalom típusa. Ennél a nézetnél kizárólag a bevétel típusú forgalmak jelennek meg.
 3. Mennyiség
    1. Bevételezett: az eredeti, teljes mennyiség, ami bevételezésre került
    2. Felhasználás: bármilyen célú felhasználás során elfogyott mennyiség
    3. Maradék: a fenti kettő különbsége
 3. Megrendelés ID: a felhasználáshoz tartozó megrendelés azonosítója
 4. Dátum: a bevételezés dátuma
 5. Számlaszám, Szállítólevélszám, CMR, EKÁER szám, Fuvarozó: a beszállításra vonatkozó adminisztratív adatok
 6. Megjegyzés: a bevételezéskor rögzített megjegyzés
 7. Művelet
    1. Törlés: amennyiben még nem volt felhasználás a tételből, úgy az törölhető. Ha már tortént felhasználás, akkor elsőként azokat kell törölni.
    2. Eladás: közvetlen faanyag értékesítés esetén
    3. Korrekció: leltári korrekció

#### Faanyag - Készletmozgás

A Faanyag készletmozgás az összes bevételezett mennyiségeket mutatja fafajonként, az összes felhasználással, eladással és korrekcióval. A fafajok között az ikonokra kattintva lehet váltani.
Az egyes fafajokra kijelzi a teljes készleten lévő mennyiséget, illetve minden korábban bevételezett, felhasznált, eladott mennyiséget.

A részletező táblázat a következő adatokat tartalmazza:
 1. ID: a bevételezett tétel egyedi azonosítója
 2. Forg.: a forgalom típusa. Lehet bevéteéezés, felhasználás, eladás vagy korrekció
 3. Mennyiség
    1. Bevételezett: az eredeti, teljes mennyiség, ami bevételezésre került
    2. Felhasználás: bármilyen célú felhasználás során elfogyott mennyiség
    3. Maradék: a fenti kettő különbsége
 3. Megrendelés ID: a felhasználáshoz tartozó megrendelés azonosítója
 4. Dátum: az esemény dátuma
 5. Számlaszám, Szállítólevélszám, CMR, EKÁER szám, Fuvarozó: a beszállításra vonatkozó adminisztratív adatok
 6. Megjegyzés: a bevételezéskor rögzített megjegyzés
 7. Művelet
    1. Törlés: amennyiben még nem volt felhasználás a tételből, úgy az törölhető. Ha már tortént felhasználás, akkor elsőként azokat kell törölni.
    2. Eladás: közvetlen faanyag értékesítés esetén
    3. Korrekció: leltári korrekció

#### Faanyag - Bevételezés

Ebben a menüpontban lehet új alapanyagot felvenni. Válasszuk ki a fafajt, majd adjuk meg a mértékegységet és a mennyiséget. A program mindent tömör köbméterbe vált át, és úgy tárol, ez a Rögzített érték dobozban látszik.

Meg lehet adni a beszállított tétel adatait:
 - Számlaszám
 - Szállítólevélszám
 - EKÁER szám
 - CMR szám
 - Fuvarozó

Beszállítónak választhatunk egyet a listából, vagy az új beszállító opcióval rögzíthetünk a listán nem szereplő beszállítót.

A dátum a bevételezés tényleges dátumát jelenti, ha a rögzítés nem aznap történik, akkor vissza kell dátumozni.

A megjegyzés szabad szöveges mező.

#### Faanyag - Eladás

Az eladás menüt akkor kell használni, ha nyers alapanyagot értékesítünk. Feldolgozott késztermék értékesítésekor a gyártást kell használni.

Eladáshoz először választani kell egy készlet elemet, amelyből értékesíteni szeretnénk.

Ha a tételt kiválasztottuk, a bevételezéshez nagyon hasonló űrlap jelenik meg, ahol a mennyiséget és a következő adatokat lehet rögzíteni:
- Számlaszám
- Szállítólevélszám
- EKÁER szám
- CMR szám
- Fuvarozó
- Dátum
- Megjegyzés

Fontos: a program nem enged nagyobb mennyiséget eladni, mint a tételből még a rendszerben készleten lévő mennyiség.

#### Faanyag - Korrekció

A korrekció célja, hogy a programban rögzített, és a valóságban készleten lévő mennyiségek közötti külünbséget kompenzálni lehessen. A mérések pontatlansága, a gyártás során keletkező maradék és egyéb hibák közösen azt eredményezhetik, hogy a program mást mutat, mint a valóság, ilyenkor korrekciót kell felvenni.

Fontos: a korrekció nem a hibás adatrögzítés megoldására szolgál. Hibás adatrögzítés esetén törölni/javítani kell a bevitt adatot.

Korrekciót, az eladáshoz hasonlóan, a bevételezett tételen lehet ejteni. A tétel kiválasztása után pozitív és negatív előjellel is lehet korrekciót felvenni.
A megjegyzésben célszerű feltűntetni, hogy mi volt a korrekció oka, pl. Kaloda anyag készült.

#### Csomagolóanyag - Raktárkészlet

A Csomagolóanyag raktárkészet az aktuálisan még készleten lévő bevételezett mennyiségeket mutatja csomagolóanyagonként.

#### Csomagolóanyag - Készletmozgás

A Csomagolóanyag készletmozgás az összes bevételezett mennyiségeket mutatja csomagolóanyagonként, az összes felhasználással, eladással és korrekcióval. A csomagolóanyagok között az ikonokra kattintva lehet váltani.
Az egyes csomagolóanyagonként kijelzi a teljes készleten lévő mennyiséget, illetve minden korábban bevételezett, felhasznált, eladott mennyiséget.

A részletező táblázat a következő adatokat tartalmazza:
 1. ID: a bevételezett tétel egyedi azonosítója
 2. Forg.: a forgalom típusa. Lehet bevéteéezés, felhasználás, eladás vagy korrekció
 3. Mennyiség
 3. Megrendelés ID: a felhasználáshoz tartozó megrendelés azonosítója
 4. Dátum: az esemény dátuma
 5. Számlaszám
 6. Megjegyzés: a bevételezéskor rögzített megjegyzés
 7. Művelet
    1. Törlés: amennyiben még nem volt felhasználás a tételből, úgy az törölhető. Ha már tortént felhasználás, akkor elsőként azokat kell törölni. Ez alól kivételt képeznek az adminisztrátori jogkörrel rendelkező felhasználók, ők megrendelés során felhasznált tételt is törölhetnek. Ez például akkor lehet szükséges, ha a gyártás egyszer már lezárult, de utólag újra módosítani kellett, majd újra lezárni. Ilyenkor a program mindkétszer levonja a csomagolóanyagot. Ha a valóságban a korábbi csomagolóanyagot (pl kalodaelem) újrahasznosítottuk, akkor az egyik levonás törölhető.
    2. Eladás: közvetlen faanyag értékesítés esetén
    3. Korrekció: leltári korrekció

#### Csomagolóanyag - Bevételezés

Ebben a menüpontban lehet új csomagolóanyagot felvenni. Válasszuk ki a csomagolóanyagot, majd adjuk meg a mennyiséget, a számlaszámot, dátumot és opcionálisan a megjegyzést.

#### Csomagolóanyag - Eladás

Az eladás menüt akkor kell használni, ha nyers alapanyagot értékesítünk. Feldolgozott késztermék értékesítésekor a gyártást kell használni.

Válasszuk ki az értékesíteni kívánt csomagolóanyagot, majd adjuk meg a mennyiséget, számlaszámot, dátumot, és opcionálisan a megjegyzést.

#### Csomagolóanyag - Korrekció

A korrekció célja, hogy a programban rögzített, és a valóságban készleten lévő mennyiségek közötti külünbséget kompenzálni lehessen.

Válasszuk ki a korrigálni kívánt csomagolóanyag típust, majd adjuk meg a mennyiséget (pozitív és negatív szám is lehet), a dátumot, és opcionálisan egy megjegyzést.

### Gyártás

A gyártás modult elsősorban a gyártási folyamatokat irányító személy használja. A gyártásra váró, gyártás alatt álló megrendeléseket a Függő gyártások menüben, az elkészült, korábbi megrendeléseket a Lezárult gyártások menüben érheti el.

#### Gyártás - Függő gyártások

Táblázatos formában látható minden függőben lévő megrendelés. A táblázat kereshető, az oszlopok szerint rendezhető, és a képernyő alján lapozható.

A táblázat oszlopai a következő adatokat tartalmazzák:
 1. ID: a megrendelés egyedi azonosítója
 2. Státusz színnel és ikonnal
 3. T.: megrendelés típusa
 4. P.: prioritás, amennyiben van
 5. Megrendelés dátuma
 6. Ígért teljesítés dátuma
 7. Megrendelés státusza
 8. Gyártó
 9. Tételek
    1. Megrendelési tétel gyártásának állapota
    2. ID: a tétel egyedi azonosítója
    3. Fafaj ikon és név
    4. Hosszúság
    5. Átmérő
    6. Csomagolástípus ikonja
    7. Megrendelt mennyiség
    8. Nedvességtartalom ikonja
    9. Számított gyártási idő
    10. Várható gyártási idő
    11. Tényleges gyártási idő
 10. Szállítási adatok
    1. Szállítás állapota
    2. Várható szállítási határidő
    3. Tényleges szállítási határidő
    4. Szállítólevél szám, számlaszám, CMR, EKÁER, Fuvarozó Nedve
 11. Megjegyzések
 12. Művelet

A megrednelésekkel dolgozni a művelet oszlopban lévő ikonra kattintva lehet. Ide kattintva megjelennek a kiválasztott rendelés adatai, valamit a megrendelésben szereplő tételek. Minden egyes tételt külön le kell gyártani.

A tételek kezdetben Visszaigazolára vár státuszban vannak. A tételre kattintva megjelennek a további státuszok, melyek közül választani lehet. Elsőként a gyártásért felelős személynek vissza kell igazolnia a gyártás lehetségességét, vagy megtagadni azt. Megtagadni a visszautasítva státusszal lehet. Ha a gyártásra vár státusszal visszaigazoltuk a rendelést, a program kérni fogja a várható gyártási határidőt. Segítségül láthatjuk a számított határidőt, amit a program úgy számol ki, hogy az ígért szállítási határidőből visszaszámolja a megadott száradási, gyártási és szállítási időket.
A gyártás során a készletként felvitt alapanyagok még rendelkezésre álló mennyiségéből kell a megrendelésben elvárt mennyiséget levonni. Ehhez kattintsunk a Hozzáadás ikonra, majd a megjelenő lista elemeiből vonjuk le a felhasznált mennyiséget.
A program a csomagolási eszközöket autómatikusan levonja a készletből.
Ha a gyártás befejeződött, be kell állítani a tényleges gyártási dátumot.
Ha az összes tétel legyártásra került, autómatikusan átállítódik a szállítási státusza szállítható allapotúra.

#### Gyártás - Lezárult gyártások

A már lezárult rendelések látszanak, csak olvasható módban. A megjelenített adatok megegyeznek a függő gyátrás menüpontban leírtakkal.

Megjegyzést már lezárult megrendelésekhez is lehet fűzni.

Az adminisztrátori jogkörrel rendelkező felhasználók a lezárult gyártások anyagfelhasználását utólag is módosíthatják.

### Megrendelés

A megrendelések menüben új lakossági és export megrendeléseket lehet felvenni, illetve a rögzített megrendelések adatait, állapotait lehet megtekinteni, módosítani.

#### Megrendelés - Öszesítés - Összes megrendelés

A megjelenített táblázat az összes a rendszerben rögzített megrendelést listázza. A táblázat rendezhető, kereshető, és szűrhető.

Szűrők: kattintsunk a Szűről feliratra, vagy a kis tölcsér ikonra. Lenyílik a szűrők panel, ahol egy, vagy több szűrő állítható be. Amennyiben egynél több szűrőt állítunk be, közöttük ÉS kapcsolat fog fennállni, vagyis azok a tételek jelennek csak meg, melyekre minden beállított szűrő egyszerre teljesül.
Az egyes szűrőket a sor elején lévő kapcsolóval lehet ki-be kapcsolni. Alapesetben minden szűrés ki van kapcsolva.
A következő szűrőfeltételek definiálhatók:
 - Megrendelés dátuma: két megadott hónap között leadott megrendelések
 - Ígért teljesítés dátuma: két megadott hónap közötti teljesítési dátumú megrendelések
 - Típus: lakossági és/vagy export
 - ID: megrendelés egyedi azonosítója

A megrendeléseket tartalmazó táblázat oszlopai a következő adatokat tartalmazzák:
 - ID: egyedi azonosító
 - A megrendelés állapota színnel és ikonnal jelezve. Lehetséges értékek:
    - feldolgozás alatt
    - elfogadva
    - teljseítve
    - visszautasítva
    - visszamondott
 - Prioritás
 - Megrendelő: a megrendelő nevére kattintva kis ablakban megjelenik az összes többi adata (cím, telefonszám, kapcsolattartó, stb.)
 - Megrendelés dátuma
 - Ígért teljesítés dátuma
 - Megrendelés státusza névvel. A névre kattintva megjelenik egy kis ablak, melyből másik státuszt választhatunk ki.
 - Gyártó: alapesetben a gyártó az Ihartü Kft., de bizonyos megrendeléseket külső cég végez el. A belső gyártás megkezdéséig a gyártó cég szabadon módosítható. Amennyiben külső cég végzi a gyártást, annak státuszát a cégnév alatti kis fogaskerék ikonnal lehet beállítani:
    - gyártásra vár
    - legyártva
    - visszautasítva
 - Tételek: ebben a cellában egy táblázat van, ami a megrendelés egyes tételeit listázza. Egy tétel két sorban szerepel, a következő adatokkal:
    - Tétel gyártásának állapota (csak Ihartü gyártás esetén)
    - ID: egyedi azonosító
    - Fafaj
    - Hossz
    - Átmérő
    - Csomagolási egység és darabszám
    - Ár
    - Nedvesség
    - Számított gyártási határidő
    - Vállalt gyártási határidő
    - Tényleges gyártás dátuma
 - Szállítás: a szállítás állapota és adatai:
    - Szállítás állapot ikonnal:
      - Gyártás alatt (még nem szállítható)
      - Szállíásra vár
      - Kiszállítva
    - V: Várható szállítási dátum
    - T: Tényleges kiszállítás dátuma
    - Szállítólevélszám
    - Számlaszám
    - CMR, EKÁER
    - Fuvarozó
 - Ár: teljes ár, a faanyag ára és a szállítási díj. Export rendelés esetén a szállítási díj utólag módosítható. Ehhez kattintsunk a szürke hátterű gombra, és adjuk meg az új árat
 - Fizetés állapota és adatai. Az adatokat módosíthatjuk, ha a fizetés státusza ikonra kattintunk. A megjelenő kis ablakban átállíthatjuk a státuszt, a határidőt és a fizetés dátumát
    - Fizetés állapota:
       - Fizetésre vár
       - Fizetve
    - H: Fizetési határidő
    - T: Tényleges fizetés dátuma
 - Megjegyzések: korábbi megjegyzések, üzenetek dátummal és feladóval. Új üzenethez kattintson a megjegyzésekre, vagy a _Nincs még üzenet_ feliratra

#### Megrendelés - Lakossági - Új megrendelés

Lakossági megrendelések felvétele. A megrendelés rögzítője az aktuálisan bejelentkezett felhasználó. Ha a megrendelést paríton vagy más formában vette fel egy harmadik személy, akkor a Rendelést felvette pipa bekapcsolása után beírható az eredeti felvevő neve.
A következő adatokat kell megadni:
 - Dátum: a rendelés felvételének időpontja, alapértelmezetten mindig az aktuális dátum
 - Ígért teljesítési határidő
 - Fizetési határidő
 - Gyártó (alapértelmezetten az Ihartü)
 - Megrendelő neve
 - Megrendelő címe (számlázási)
 - Megrendelő telefonszáma
 - Kapcsolattartó neve, szállítási cím, kapcsolattartó telefonszáma (amennyiben ezek az adatok azonosak a megrendelő adataival, a Megrendelő adatainak másolása gomb segítségével másolhatók)
 - Tételek
    - A fafajok táblázat mutatja a készleten lévő alapanyagot, a már felvett, gyártásra váró megrendeléseket, és a maradékot. Ez az információ közvetlen rendelésfelvétel esetén lehet hasznos, ha a megrendelő által kért fafaj nincs készleten, könnyen ajánlhatunk mást, amiből van
    - Hossz: a kék csúszkával beállíthatjuk a kívánt hosszt
    - Átmérő: két csúszkával tól-ig paramétereket állíthatunk be
    - Csomagolás: válasszunk az alaprtelmezett csomagolási típusokból, vagy az Egyéb típusok alatt bármely csomagolástípusból. A rögzített érték a kiválasztott mennyiség köbméterre átszámított mennyiségét mutatja.
    - Ár: amennyiben a fafaj és a csomagolási típus szerepel az árlistán, a listaár autómatikusan kitöltődik. Ez az érték kézzel is szerkeszthető.
    Ha minden paramétert kiválasztottunk, a Hozzáadás a megrendeléshez gombbal lehet rögzíteni. Egy megrendeléshez tetszőleges számú tételt adhatunk.
    A tételek soronként jelennek meg a táblázatban, és a Művelet alatti szemetes ikonnal törölhetők.
    - Szállítási díj: kézzel szerkeszthető mező. A Szentgáltól mért távolságot a program autómatikusan kijelzi, amennyiben a szállítási cím úgy lett megadva, hogy azt a google útvonaltervezője felismeri
    - Végösszeg: a tételek összege, plusz a szállítási díj
    - Megjegyzés

#### Megrendelés - Lakossági - Felvett megrendelések listája

Az Összes megrendeléssel azonos, azzal a különbséggel, hogy kizárólag a lakossági megrendeléseket jeleníti meg.

#### Megrendelés - Export - Új megrendelés

Export megrendelések felvétele. A megrendelés rögzítője az aktuálisan bejelentkezett felhasználó. Ha a megrendelést papíron vagy más formában vette fel egy harmadik személy, akkor a Rendelést felvette pipa bekapcsolása után beírható az eredeti felvevő neve.
A következő adatokat kell megadni:
 - Dátum: a rendelés felvételének időpontja, alapértelmezetten mindig az aktuális dátum
 - Ígért teljesítési határidő
 - Fizetési határidő
 - Gyártó (alapértelmezetten az Ihartü)
 - Megrendelő: az export megrendelők adatai külön kezelődnek. Amennyiben a megrendelő már létezik, válasszuk ki a listából. Ha még nem, az Üj export megrendelő hozzáadása menüben fel kell venni.
 - Prioritás: export megrendeléseknél lehetőség van prioritás beállítására. Ez a gyártónak, szállítónak szóló információ, ha több gyártás egyszerre aktuális, akkor a magasabb prioritásúval kell kezdeni.
 - Tételek
    - A fafajok táblázat mutatja a készleten lévő alapanyagot, a már felvett, gyártásra váró megrendeléseket, és a maradékot. Ez az információ közvetlen rendelésfelvétel esetén lehet hasznos, ha a megrendelő által kért fafaj nincs készleten, könnyen ajánlhatunk mást, amiből van
    - Hossz: a kék csúszkával beállíthatjuk a kívánt hosszt
    - Átmérő: két csúszkával tól-ig paramétereket állíthatunk be
    - Csomagolás: válasszunk az alaprtelmezett csomagolási típusokból, vagy az Egyéb típusok alatt bármely csomagolástípusból. A rögzített érték a kiválasztott mennyiség köbméterre átszámított mennyiségét mutatja.
    - Ár
    - Pénznem
    Ha minden paramétert kiválasztottunk, a Hozzáadás a megrendeléshez gombbal lehet rögzíteni. Egy megrendeléshez tetszőleges számú tételt adhatunk.
    A tételek soronként jelennek meg a táblázatban, és a Művelet alatti szemetes ikonnal törölhetők.
    - Szállítási díj
    - Végösszeg: a tételek összege, plusz a szállítási díj
    - Megjegyzés

#### Megrendelés - Export - Felvett megrendelések listája

Az Összes megrendeléssel azonos, azzal a különbséggel, hogy kizárólag az export megrendeléseket jeleníti meg.

#### Megrendelés - Export - Export megrendelők

Ebben a menüpontban kezelhetjük az export megrendelőket. A táblázat az összes megrendelőt listázza minden adattal. Az emlékeztető küldése gombra kattintva e-mail emlékeztetőt küldhetünk a jelszavukról. A műveletek alatt 3 gomb található:
 - Szerkesztés: a megrendelő adatainak szerkesztése
 - Felfüggesztés vagy Engedélyezés: ezzel a gombbal tilthatja le, vagy engedélyezheti újra a megrendelő belépését
 - Törlés: a megrendelő törlése a rendszerből (csak akkor használjuk, ha megrendelést nem rögzített)

A táblázat alatt új megrendelőt vehetünk fel.

### Szállítás

A szállítás menü alatt a lakossági és export megrendelések kiszállításával foglalkozó felhasználók láthatják, módosíthatják a számukra fontos adatokat.

#### Szállítás - Lakossági - Szállításra váró megrendelések

A lakossági megrendelések listája látszik itt. A lista tartalmazza a már szállításra kész megrendeléseket, de ahhoz, hogy a szállítást végző személy megfelelően tudjon előre tervezni, a még nem szállítható, gyártás alatt lévő rendelések is megjelennek. A szállításra kész tételek mindig a táblázat tetején jelennek meg az alapértelmezett rendezés szerint.

A megjelenő táblázat azonos a Megrendelés összesítőben leírt táblázattal, azzal a különbséggel, hogy nem jelennek meg a szállítás számára nem fontos információk (például az árak), és a szállítás állapota, valamint adatai szerkeszthetők. A szállítás állapotának ikonjára kattintva kis ablakban megnyílik a szerkeszthető nézet, beállíthatjuk a szállítás várható és tényleges állapotát, valamint a következő adatokat:
 - Szállítólevél szám
 - Számlaszám
 - CMR
 - ERÁER
 - Fuvarozó

 A teljesített szállítások átkerülnek a Leszállított megrendelések alá.

#### Szállítás - Lakossági - Leszállított megrendelések

A már kiszállított, teljesített megrendelések látszanak itt, az adatok már nem szerkeszthetők.

#### Szállítás - Export - Szállításra váró megrendelések

Az export megrendelések listája látszik itt. A lista tartalmazza a már szállításra kész megrendeléseket, de ahhoz, hogy a szállítást végző személy megfelelően tudjon előre tervezni, a még nem szállítható, gyártás alatt lévő rendelések is megjelennek. A szállításra kész tételek mindig a táblázat tetején jelennek meg az alapértelmezett rendezés szerint.

A megjelenő táblázat azonos a Megrendelés összesítőben leírt táblázattal, azzal a különbséggel, hogy nem jelennek meg a szállítás számára nem fontos információk (például az árak), és a szállítás állapota, valamint adatai szerkeszthetők. A szállítás állapotának ikonjára kattintva kis ablakban megnyílik a szerkeszthető nézet, beállíthatjuk a szállítás várható és tényleges állapotát, valamint a következő adatokat:
 - Szállítólevél szám
 - Számlaszám
 - CMR
 - ERÁER
 - Fuvarozó

 A teljesített szállítások átkerülnek a Leszállított megrendelések alá.

#### Szállítás - Export - Leszállított megrendelések

A már kiszállított, teljesített megrendelések látszanak itt, az adatok már nem szerkeszthetők.

### Kimutatás

A kimutatások a programban lévő adatok alapján generált riportok. Csak olvasható formátumúak.

#### Kimutatás - Faanyag felhasználás

A táblázat a gyártás során felhasznált tényleges alapanyagok mennyiségét mutatja.

M: a megrendelt fatípust és átszámított mennyiséget mutatja, F: pedig a ténylegesen felhasznált tételeket. Ezek külünbsége a Δ.

Ha a gyártás során a felhasznált mennyiség több, mint 10%-kal eltér a megrendelttől, akkor az érték színezve jelenik meg. Piros szín esetén a gyártás kevesebb anyagot használt fel az elvártnál, kék szín esetén a gyártás több anyagot használt fel, mint az elvárt.

### Adminisztráció

#### Adminisztráció - Felhasználók

A program használatára jogosult felhasználók kezelése. A táblázat tartalmazza az összes felhasználót, és a következő adataikat:
 - ID: egyedi azonosító
 - Felhasználónév
 - Teljes név
 - Jogosultságok: a felhasználó a kékkel jelölt jogosultságokkal rendelkezik
    - Bsz: Beszállítás
    - Al: Alapanyag
    - Gy: Gyártás
    - LM: Lakossági megrendelés
    - EM: Export megrendelés
    - LSz: Lakossági szállītás
    - ESz: Export szállītás
    - K: Kimutatás
    - Ad: Adminisztráció
 - Jelszó emlékeztető
 - E-mail cím
 - Utolsó belépés dátuma
 - Művelet
    - Szerkesztés: a felhasználó adatainak szerkesztése
    - Felfüggesztés vagy Engedélyezés: ezzel a gombbal tilthatja le, vagy engedélyezheti újra a felhasználó belépését
    - Törlés: a felhasználó törlése a rendszerből (Csak akkor használjuk, ha hibásan vettünk fel felhasználót, de még sosem lépett be. Minden egyéb esetben a felfüggesztést használjuk.)

Új felhasználót a táblázat alatt tudunk  felvenni.

#### Adminisztráció - Fafajok

A programban szereplő fafajok listája, ikonjai.

A program meg tud különböztetni kemény lombos, lágy lombos és fenyőféléket. Ezt például a kimutatásoknál lehet felhasználni.

#### Adminisztráció - Konstansok

A programban található konstansok listája. A felső táblázat a különböző csomagolási formák, mértékegységek, és a csomgolások egyes csomagolóanyag szükségletét mutatja.

Az alapértelmezett gyártási idő a száradási idővel növelt gyártási időt, a szállítási idő a kiszállítás átlagos idejét jelenti.

#### Adminisztráció - Árlista

A lakossági árak csomagolási modonként és fafajonként lebontva.

#### Adminisztráció - Napló

A rendszer használata során minden bejelentkezési kísérletről, és a programban végzett tevékenységről naplóbejegyzés készül.
 - Dátum: az esemény dátuma és pontos időpontja
 - Felhasználó: a bejelentkezett felhasználó
 - Esemény: az esemény leírása, bizonyos esetekben adatai

#### Adminisztráció - Saját profil

A felhasználó saját adatainak megjelenítése. Itt lehet jelszót változtatni is.
