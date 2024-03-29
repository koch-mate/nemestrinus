

<div class="row">
  <div style="background:#fff; border-radius: 1em; margin:2em; padding:1em;">
    <img src="img/logo.png" style="height:10em;margin:3em;">
    <div style="display:inline-block;">
      <h1>IHARTÜ 2000 Kft.</h1>
      <p>Tűzifa megrendelés, gyártás és szállítás nyilvántartó program</p>
    </div>

  </div>
</div>

<div class="row">
<div class="col-md-6">

<div style="background:#fff; border-radius: 1em; margin:1em; padding:1em;">
    <h3 style="text-align: center; margin-bottom:1em;"><i class="fa fa-envelope"></i>&nbsp;Utolsó üzenetek</h3>
    <hr style="height:2px;background:#000;" />
    <?php

    messagesGetLast(25);

    ?>
</div>
</div>
  <div class="col-md-6">
    <div style="background:#fff; border-radius: 1em; margin:1em; padding:1em;max-height:1000px;overflow-y:auto;">
      <h3 style="text-align: center; margin-bottom:1em;"><i class="fa fa-wrench"></i>&nbsp;Programfrissítések</h3>
      <hr style="height:2px;background:#000;" />

      <p><span class="label label-default">2021. 08. 19.</span> <span class="label label-success">Új fejlesztés</span>
        Szűrés megrendelő szerint az Összes megrendelés kimutatásban
      </p>

      <p><span class="label label-default">2021. 08. 19.</span> <span class="label label-warning">Hibajavítás</span>
        Elcsúszott táblázat fejléc javítása a Havi megrendelés összesítő kimutatásban; Hibás Összeg érték javítása a Megrendelőnkénti kimutatásban
      </p>

      <p><span class="label label-default">2021. 02. 13.</span> <span class="label label-primary">Konstans érték változás</span>
        Egyutas kalodák púppal
      </p>


      <p><span class="label label-default">2021. 02. 13.</span> <span class="label label-success">Új fejlesztés</span>
        Archívált rendelések
      </p>


      <p><span class="label label-default">2019. 01. 15.</span> <span class="label label-success">Új fejlesztés</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/131','Beszállító helyett megjegyzés a gyártásnál')?>
      </p>


      <p><span class="label label-default">2018. 09. 10.</span> <span class="label label-warning">Hibajavítás</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/121','Havi kimutatásban hibás export megrendelés ár')?>
      </p>

      <p><span class="label label-default">2018. 06. 02.</span> <span class="label label-warning">Hibajavítások, fejlesztések</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/125','Faanyag forgalom - Kiszállítás')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/116','Szallitas statusz mentesekor hibat ir')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/121','Megrendelő szerinti kimutatás')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/123','Megrendelések havi nézete')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/122','Beszallitoi kimutatas')?>
      </p>

      <p><span class="label label-default">2018. 04. 22.</span> <span class="label label-warning">Hibajavítások, fejlesztések</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/113','Gyártásra váró lakossági, nyomtatható. Sorrend: teljesítés')?>
      </p>

      <p><span class="label label-default">2018. 04. 04.</span> <span class="label label-primary">Konstans érték változás</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/108','Konstansok Posch')?>
      </p>


      <p><span class="label label-default">2018. 04. 03.</span> <span class="label label-success">Új modul</span>
        <a href="?mode=beszallitok">Beszállítók</a>
      </p>

      <p><span class="label label-default">2018. 03. 29.</span> <span class="label label-warning">Hibajavítások, fejlesztések</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/111','0 arral utolag felvett tetel')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/101','kerekítés')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/95','-0!')?>
      </p>

      <p><span class="label label-default">2018. 03. 27.</span> <span class="label label-warning">Hibajavítások, fejlesztések</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/109','Gyártó szerinti rendezés')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/107','Export nyomtatható (hasítási méret)')?>,
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/106','Összes megrendelés / ár kalkuláció')?>
      </p>

      <p><span class="label label-default">2018. 03. 01.</span> <span class="label label-warning">Hibajavítás</span>
        <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/104','Összes megrendelésben vagyok')?>
      </p>

    <p><span class="label label-default">2018. 02. 27.</span> <span class="label label-success">Új fejlesztés</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/103','Nyomtatható export')?>
    </p>
    <p><span class="label label-default">2018. 02. 26.</span> <span class="label label-success">Új fejlesztés</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/99','Lakossági megrendelések nyomtatható verzió')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/100','Export nyomtatható verzió')?>
    </p>

    <p><span class="label label-default">2018. 02. 13.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/96','Gyártásra váró nyomtatható export')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/89','Lakossági megrendelés')?>
    </p>

    <p><span class="label label-default">2018. 02. 11.</span> <span class="label label-success">Új fejlesztés</span>
      Megrendelések tételeinek szerkeszthetősége: megrendelések tételei szerkeszthetőek az Összes megrendelés oldalon, adminisztrátor jogkörrel rendelkező felhasználók által
    </p>
    <p><span class="label label-default">2018. 02. 11.</span> <span class="label label-success">Új modul</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/92','Export rendeles nyomtathato')?>
    </p>

    <p><span class="label label-default">2018. 01. 27.</span> <span class="label label-success">Új fejlesztés</span>
      A megrendelések tételei a jóváhagyásig módosíthatóak adminisztrátor jogosutságú felhasználók által (<?=issueLink('https://github.com/koch-mate/nemestrinus/issues/85','Export megrendelés módosítása')?>).
    </p>

    <p><span class="label label-default">2018. 01. 27.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/87','Lakossági megrendelés')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/88','Gyártásra váró lakossági megrendelések (nyomtatható verzió)')?>
    </p>

    <p><span class="label label-default">2018. 01. 11.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/78','Faanyag áttekintés')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/81','Megrendelések')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/82','Kimutatás')?>
    </p>

    <p><span class="label label-default">2018. 01. 06.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/79','többet vesz le az alapanyagból')?>
    </p>

    <p><span class="label label-default">2018. 01. 06.</span> <span class="label label-success">Új fejlesztés</span>
      Fafelhasználás részletei a Készletmozgás és a Megrendelések alatt is.
    </p>

    <p><span class="label label-default">2017. 12. 29.</span> <span class="label label-success">Új modulok</span>
      <a href="?mode=kimutatas-fafaj">Fafaj szerinti kimutatás</a>,
      <a href="?mode=kimutatas-megrendelo-lakossagi">Megrendelő szerinti kimutatás - Lakossági megrendelések</a>,
      <a href="?mode=kimutatas-megrendelo-export">Megrendelő szerinti kimutatás - Export megrendelések</a>
    </p>

    <p><span class="label label-default">2017. 12. 21.</span> <span class="label label-success">Új modulok</span>
      <a href="?mode=kimutatas-faanyagforgalom-beszallitas">Faanyag forgalom - Beszállítás</a>,
      <a href="?mode=kimutatas-faanyagforgalom-kiszallitas">Faanyag forgalom - Kiszállítás</a>
    </p>

    <p><span class="label label-default">2017. 12. 21.</span> <span class="label label-success">Új fejlesztés</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/76','Alapanyag')?>
    </p>

    <p><span class="label label-default">2017. 12. 21.</span> <span class="label label-success">Új modul</span>
      <a href="?mode=kimutatas-fafelhasznalas-attekintes">Faanyag áttekintés</a>
    </p>

    <p><span class="label label-default">2017. 12. 10.</span> <span class="label label-success">Új fejlesztés</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/73','Csomagoloanyag levonasa')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/74','Kimutatas, attekintes - visszamondott/visszautasitott')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/75','Lezart gyartasok modositasa')?>
    </p>

    <p><span class="label label-default">2017. 12. 05.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/72','Lejárt határidejű, befizetetlen, teljesített megrendelések - Ft')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/71','fizetési határidő')?>
    </p>

    <p><span class="label label-default">2017. 12. 02.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/70','Áttekintés - Szamlaszam')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/69','Lakossagi megrendelesek kifizetettsege')?>
    </p>

    <p><span class="label label-default">2017. 11. 28.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/66','Lakossági megrendelés')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/67','Kimutatás/Megrendelések havonta')?>
    </p>

    <p><span class="label label-default">2017. 11. 21.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/64','Lakossági megrendelések')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/65','Megrendelések havi nézete')?>
    </p>

    <p><span class="label label-default">2017. 11. 20.</span> <span class="label label-success">Új modul</span> <a href="?mode=kimutatas-havi">Havi kimutatás</a></p>
    <p><span class="label label-default">2017. 11. 19.</span> <span class="label label-success">Új modul</span> <a href="?mode=kimutatas-lakossagi-gyartas">Nyomtatható kimutatás az aktív lakossági megrendelésekről</a></p>

    <p><span class="label label-default">2017. 11. 19.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/62','Megrendelés/Felvett megrendelések kezelése')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/60','Szállítás/Lezárt megrendelések')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/59','Szállítás/Szállításra váró megrendelések')?>
    </p>

    <p><span class="label label-default">2017. 11. 11.</span> <span class="label label-success">Új fejlesztés</span> <a href="?mode=arlista">Szerkeszthető árlista</a></p>

    <p><span class="label label-default">2017. 10. 01.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/55','Felkesz gyartas statusza')?>
    </p>
    <p><span class="label label-default">2017. 09. 27.</span> <span class="label label-success">Új modul</span> <a href="?mode=help">Súgó</a></p>
    <p><span class="label label-default">2017. 09. 26.</span> <span class="label label-warning">Hibajavítás</span>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/54','Beszallitas hibas')?>
    </p>
    <p><span class="label label-default">2017. 09. 25.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/52','Kimutatas: lehessen atkattintani')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/51','Kimutatas: visszamondottnal es visszautasitottnal ne jelezzen pirossal')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/49','Konstansok')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/48','Megnevezesek')?>
    </p>
    <p><span class="label label-default">2017. 08. 07.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/46','A gyarto ne lassa a kulso gyartasu megrendeleseket')?>
    </p>
    <p><span class="label label-default">2017. 08. 05.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/8','Kulso gyarto megrendelesekhez')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/37','Szallitasi adatok szerkeszthetosege teljesites utan')?>
    </p>
    <p><span class="label label-default">2017. 07. 27.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/44','Eger fatipus')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/43','Megrendelesek teljes ara nincs kerekitve')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/42','Szallitasi ktsg es faar kulon jelenjen meg')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/45','A megjegyzes mezok legyenek szelesebb fix hosszusaguak')?>
    </p>
    <p><span class="label label-default">2017. 06. 27.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/41','Exp.megrendelők kezelése')?>,
    </p>
    <p><span class="label label-default">2017. 06. 26.</span> <span class="label label-warning">Hibajavítások</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/23','Szállítások')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/33','Claudio')?>
    </p>
    <p><span class="label label-default">2017. 06. 25.</span> <span class="label label-warning">Hibajavítások</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/9','Hiba, ha a belepes utan a Felhasznalok oldalra iranyit a rendszer')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/14','Export fuvar')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/22','Ures megjegyzes')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/36','S:O:S!!! Lakossági megrendelések')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/32','lakossági megrendelés')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/26','Export szállítás adatok')?>
    </p>
    <p><span class="label label-default">2017. 06. 24.</span> <span class="label label-warning">Hibajavítások</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/30','Kimutatás (Zsolt kérés)')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/27','Export rendelés')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/25','Export rendelés teljesítés')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/38','FONTOS! Alapanyag felhasználás')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/39','teljes képernyő')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/24','Gyártás, szükséges alapanyag felhasználás 1.)')?>
    </p>
    <p><span class="label label-default">2017. 06. 16.</span> <span class="label label-warning">Hibajavítás</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/17','Piktogram')?>
    </p>
    <p><span class="label label-default">2017. 06. 14.</span> <span class="label label-warning">Hibajavítások</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/11','Lakossági megr. gyártási idők')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/12','Lakossági rendelés')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/19','Nyír')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/20','Fatípusok 02')?>
    </p>
    <p><span class="label label-default">2017. 06. 13.</span> <span class="label label-warning">Hibajavítások</span>
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/6','Export rendelés bevitel, nem látszanak a tételek')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/5','Export megrendelés Ft?')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/4','Időkorlát')?>,
      <?=issueLink('https://github.com/koch-mate/nemestrinus/issues/2','Export igért teljesítési határidő')?>
    </p>
    <p><span class="label label-default">2017. 06. 11.</span> <span class="label label-success">Új modul</span> <a href="?mode=kimutatas-fafelhasznalas">Fafelhasználás</a></p>
    <p><span class="label label-default">2017. 06. 04.</span> <span class="label label-success">Új funkció</span> Szállítás státuszának és egyéb adatainak kezelése</p>
    <p><span class="label label-default">2017. 06. 04.</span> <span class="label label-success">Új funkció</span> Jelszóemlékeztető küldése</p>
    <p><span class="label label-default">2017. 05. 21.</span> <span class="label label-success">Új funkció</span> Árlistás árak kalkulációja lakossági megrendelésekhez</p>
    <p><span class="label label-default">2017. 05. 21.</span> <span class="label label-success">Új modul</span> <a href="?mode=csomagoloanyag-keszletmozgas">Csomagolóanyag készletmozgás </a></p>
    <p><span class="label label-default">2017. 05. 21.</span> <span class="label label-success">Új modul</span> <a href="?mode=csomagoloanyag-keszlet">Csomagolóanyag raktárkészlet </a></p>
    <p><span class="label label-default">2017. 05. 21.</span> <span class="label label-success">Új modul</span> <a href="?mode=faanyag-keszletmozgas">Faanyag készletmozgás </a></p>
    <p><span class="label label-default">2017. 05. 21.</span> <span class="label label-success">Új modul</span> <a href="?mode=faanyag-keszlet">Faanyag raktárkészlet </a></p>
    <p><span class="label label-default">2017. 05. 20.</span> <span class="label label-success">Új funkció</span> Nemzetközi fuvarozással kapcsolatos adatok felvétele</p>
    <p><span class="label label-default">2017. 05. 20.</span> <span class="label label-success">Új funkció</span> Száradási idők és Árlista felvétele</p>
    <p><span class="label label-default">2017. 05. 09.</span> <span class="label label-success">Új funkció</span> Lakossági és export megrendelések szétválasztása</p>
    <p><span class="label label-default">2017. 04. 8.</span> <span class="label label-success">Új funkció</span> Üzenetek küldése a megrendeléshez</p>
    <p><span class="label label-default">2017. 03. 28.</span> <span class="label label-success">Új funkció</span> Alapértelmezett csomagolástípusok lakossági megrendeléshez</p>
    <p><span class="label label-default">2017. 03. 25.</span> <span class="label label-success">Új funkció</span> Gyártás során teljesített elemek hozzáadása és törlése</p>
    <p><span class="label label-default">2017. 03. 20.</span> <span class="label label-success">Új modul</span> Gyártás</p>
    <p><span class="label label-default">2017. 03. 18.</span> <span class="label label-success">Új modul</span> <a href="?mode=megrendeles-osszesites">Megrendelés összesítés </a></p>
    <p><span class="label label-default">2017. 02. 25.</span> <span class="label label-success">Új modul</span> Export rendelés <a href="?mode=export-uj-megrendeles">felvétel</a></p>
    <p><span class="label label-default">2017. 02. 25.</span> <span class="label label-success">Új modul</span> Lakossági rendelés <a href="?mode=lakossagi-uj-megrendeles">felvétel</a></p>
    <p><span class="label label-default">2017. 02. 4.</span> <span class="label label-success">Új modul</span> Alapanyag <a href="?mode=faanyag-kiadas">eladás</a></p>
    <p><span class="label label-default">2017. 02. 4.</span> <span class="label label-success">Új modul</span> Alapanyag <a href="?mode=faanyag-keszletmozgas">készlet</a></p>
    <p><span class="label label-default">2017. 02. 3.</span> <span class="label label-success">Új modul</span> Alapanyag <a href="?mode=faanyag-bevitel">bevétel</a></p>
    <p><span class="label label-default">2017. 01. 28.</span> <span class="label label-success">Új modul</span> Csomagolóanyag <a href="?mode=csomagoloanyag-kiadas">eladás</a></p>
    <p><span class="label label-default">2017. 01. 28.</span> <span class="label label-success">Új modul</span> Csomagolóanyag <a href="?mode=csomagoloanyag-keszlet">készlet</a></p>
    <p><span class="label label-default">2017. 01. 28.</span> <span class="label label-success">Új modul</span> Csomagolóanyag <a href="?mode=csomagoloanyag-bevitel">bevétel</a></p>
    <p><span class="label label-default">2017. 01. 28.</span> <span class="label label-success">Új modulok</span> <a href="?mode=naplo">Napló</a>, <a href="?mode=export-megrendelok">Export megrendelők kezelése</a></p>
</div>
</div>
</div>
