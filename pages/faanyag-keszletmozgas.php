<?php
function faanyag_keszletmozgas($cim = "", $raktarKeszlet=false, $infoSzoveg=''){

if(isset($_GET['del'])){
    woodDel($_GET['del']);
    logEv(LOG_EVENT['wood_del'].':',null,' ID: '.$_GET['del']);

    $succMessage = "Az ID = ".$_GET['del']." sor törölve.";

}
include("lib/popups.php");
?>
<style>
.hand {
  cursor: pointer;
}
</style>

    <h1><?=$cim?></h1>

    <div class="alert alert-info" role="alert"><?=$infoSzoveg?></div>

    <ul class="nav nav-tabs two-lines" role="tablist">

        <?php
foreach(array_keys(FATIPUSOK) as $p){
    ?>
            <li role="presentation" <?=($p==array_keys(FATIPUSOK)[0]? 'class="active"': '')?> style="text-align:center;max-width:8em;">
                <a href="#<?=$p?>" role="tab" data-toggle="tab"><span style="display:table-cell;height:100%;vertical-align:bottom;color:black;"><img src="/img/<?=$p?>.png" style="height:2em;margin-bottom:0.4em;"><br><?=mb_ucfirst(FATIPUSOK[$p][0])?></span>

                </a>
            </li>
            <?php
}
        ?>
    </ul>
    <div class="tab-content">
        <?php
foreach(array_keys(FATIPUSOK) as $p){
    $pq = rnd(woodGetSumByType($p));
    ?>
            <div role="tabpanel" class="tab-pane fade <?=($p==array_keys(FATIPUSOK)[0]?'in active':'')?>" id="<?=$p?>" style="padding:2em;background:#fff;border-radius:0 0 5px 5px">
                <h4>Teljes készleten lévő mennyiség: <span class="label label-<?=($pq>10?'success':($pq<=0?'danger':'warning'))?>"><?=$pq.' '.U_NAMES[U_STD][0]?></span></h4>
                <table class="table table-striped table-hover display" id="t_<?=$p?>" style="min-width:90%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Forg.</th>
                            <th style="min-width:10em;">Mennyiség</th>
                            <th>Megrendelés&nbsp;ID</th>
                            <th>Dátum</th>
                            <th>Számlaszám</th>
                            <th>Száll. Lev. Szám</th>
                            <th>Beszállító</th>
                            <th>CMR Szám</th>
                            <th>EKÁER szám</th>
                            <th>Fuvarozó</th>
                            <th>KN kód</th>
                            <th>Kitermeles helye</th>
                            <th>Import dok. az.</th>
                            <th>Megjegyzés</th>
                            <th>Művelet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach( woodGetDetailsByType($p) as $ip){
                          $ossz = $ip['Mennyiseg'];
                          $felh = woodGetUsedPortion($ip['ID']);
                          $maradek = ($ossz-$felh)/$ossz*100;

                          if($raktarKeszlet == true && ($ip['Forgalom']!=FORGALOM_BEVETEL || rnd($maradek)<=0)){continue;}?>
                            <tr>
                                <td>
                                    <?=$ip['ID']?>
                                </td>
                                <td data-order="<?=$ip['Forgalom']?>">
                                  <?php if($ip['Forgalom']==FORGALOM_FELHASZNALAS){?><a href="?mode=megrendeles-osszesites&id=<?=orderGetIDByOrderLineID($ip['MegrendelesTetelID'])?>"><?php }?>
                                    <span class="glyphicon <?=FORGALOM_ICON[$ip['Forgalom']]?>" title="<?=FORGALOM_DICT[$ip['Forgalom']]?>"></span>
                                  <?php if($ip['Forgalom']==FORGALOM_FELHASZNALAS){?></a><?php }?>
                                </td>
                                <td style="min-width:10em; white-space:nowrap;" data-order="<?=$ip['Mennyiseg']?>">
                                    <?php if($ip['Forgalom'] == FORGALOM_BEVETEL){ ?>
                                    Bevételezett: <?=$ip['Mennyiseg'].' '.U_NAMES[U_STD][1]?><br />
                                    Felhasznált: <?=rnd($felh).' '.U_NAMES[U_STD][1]?><br />
                                    Maradék: <?=$ip['Mennyiseg']-rnd($felh).' '.U_NAMES[U_STD][1]?><br />
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" style="width: <?=$maradek?>%">
                                      </div>
                                      <div class="progress-bar progress-bar-warning" style="width: <?=100-$maradek?>%">
                                      </div>
                                    </div>
                                    <div id="reszletek_<?=$ip['ID']?>">
                                      <button type="button" class="btn btn-xs btn-default" onclick="reszletek(<?=$ip['ID']?>);">Részletek</button>
                                    </div>
                                    <?php
                                  } else {?>
                                    <?=$ip['Mennyiseg'].' '.U_NAMES[U_STD][1]?>
                                    <?php } ?>
                                </td>
                                <td style="white-space: nowrap">
                                    <?php if(!empty($ip['MegrendelesTetelID'])){ ?>
                                        <a href="?mode=megrendeles-osszesites&id=<?=orderGetIDByOrderLineID($ip['MegrendelesTetelID'])?>"><b>ID:&nbsp;</b><?=orderGetIDByOrderLineID($ip['MegrendelesTetelID']).'/'.$ip['MegrendelesTetelID']?></a>
                                    <?php } ?>
                                </td>

                                <td style="white-space: nowrap">
                                    <?=$ip['Datum']?>
                                </td>
                                <td style="white-space: nowrap">
                                    <?=$ip['Szamlaszam']?>
                                </td>
                                <td><?=$ip['Szallitolevelszam']?></td>
                                <td><?=getSupplierNameById($ip['BeszallitoID'])?></td>
                                <td><?=$ip['CMR']?></td>
                                <td><?=$ip['EKAER']?></td>
                                <td><?=$ip['Fuvarozo']?></td>
                                <td><?=$ip['KNkod']?></td>
                                <td><?=$ip['KitermelesHelye']?></td>
                                <td><?=$ip['ImportSzarmazas']?></td>

                                <td>
                                    <div style="max-height:4em; overflow:auto; font-size:80%;">
                                        <?=$ip['Megjegyzes']?>
                                    </div>
                                </td>
                                <td>
                                  <?php if($ip['Forgalom']!=FORGALOM_FELHASZNALAS && !woodIsThereUse($ip['ID'])){
                                    // csak olyat lehet torolni, ami nem gyartasbol szarmazik, es amibol meg nem hasznaltunk fel
                                    ?>
                                    <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('Biztosan törölni akarja az ID = <?=$ip['ID']?> sort?')){window.location.href='?mode=faanyag-keszletmozgas&del=<?=$ip['ID']?>';}">Törlés</button>
                                    <?php }?>
                                    <?php if($ip['Forgalom']==FORGALOM_BEVETEL && $maradek > 0){ ?>
                                      <form id="frmkiadas_<?=$ip['ID']?>" method="post" action="?mode=faanyag-kiadas">
                                        <input type="hidden" name="mennyiseg" value="<?=$ossz-$felh?>">
                                        <input type="hidden" name="id" value="<?=$ip['ID']?>"?>
                                      <button type="submit" class="btn btn-xs btn-info" >Eladás</button>
                                    </form>
                                    <?php } ?>
                                    <?php if($ip['Forgalom']==FORGALOM_BEVETEL){ ?>
                                      <form id="frmkorr_<?=$ip['ID']?>" method="post" action="?mode=faanyag-korrekcio">
                                        <input type="hidden" name="mennyiseg" value="<?=$ossz-$felh?>">
                                        <input type="hidden" name="id" value="<?=$ip['ID']?>"?>
                                      <button type="submit" class="btn btn-xs btn-warning" >Korrekció</button>
                                    </form>
                                    <?php } ?>



                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <script>
                    $(document).ready(function () {
                        $('#t_<?=$p?>').DataTable({
                            "scrollX": true,
                            "language": {
                                "decimal": "",
                                "emptyTable": "Nincs adat",
                                "info": "Megjelenítve: _START_ és _END_ között, összesen _TOTAL_ adatsor",
                                "infoEmpty": "Nincs megjeleníthető adatsor",
                                "infoFiltered": "(_MAX_ adatsorból szűrve)",
                                "infoPostFix": "",
                                "thousands": ".",
                                "lengthMenu": "Show _MENU_ entries",
                                "loadingRecords": "Betöltés...",
                                "processing": "Feldolgozás...",
                                "search": "Keresés:",
                                "zeroRecords": "Nincs találat",
                            },
                            "paging": false,
                            "info": true,
                            "columns": [
                                {
                                    "searchable": true
                                },
                                null,
                                {
                                    "type": "num",
                                    "orderable": true,
                                },
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                {
                                    "orderable": false
                                },
                                {
                                    "orderable": false,
                                    "searchable": false
                                }
        ]


                        });

                    });
                </script>
            </div>
            <?php } ?>
    </div>
    <script>
        $(document).ready(function () {
            $('#myTabs a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');

            })
            $('#myTabs a:first').tab('show') // Select first tab
            // to fix DataTables header misalignment issue
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $("#t_"+e.target.href.substring(e.target.href.indexOf("#")+1)).dataTable().fnAdjustColumnSizing();
            })
        });
        function reszletek(faid){
          var rdiv = $('#reszletek_'+faid);
          var rdivcnt = rdiv.html();
          rdiv.load('/ajax/wood_usage_details.php?id='+faid);
          rdiv.click(function(){rdiv.html(rdivcnt)});
        }
    </script>
<?php }
if($mode == 'faanyag-keszletmozgas'){
  faanyag_keszletmozgas($cim = 'Alapanyag készletmozgás', $raktarKeszlet=false,$infoSzoveg='A készletmozgás minden egyes bevételezést, eladást, korrekciót és felhasználást megjelenít.');

}
?>
