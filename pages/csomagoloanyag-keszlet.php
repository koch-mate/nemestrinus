<?php

if(isset($_GET['del'])){
    packagingDel($_GET['del']);
    logEv(LOG_EVENT['packaging_del'].':',null,' ID: '.$_GET['del']);

    $succMessage = "Az ID = ".$_GET['del']." sor törölve.";
    
}
include("lib/messages.php");
?>


    <h2>Csomagolóanyag készlet</h2>

    <ul class="nav nav-tabs " role="tablist">

        <?php
foreach(array_keys(CSOMAGOLOANYAGOK) as $p){
    ?>
            <li role="presentation" <?=($p==array_keys(CSOMAGOLOANYAGOK)[0]? 'class="active"': '')?>>
                <a href="#<?=$p?>" role="tab" data-toggle="tab">
                    <img src="/img/<?=$p?>.png" style="height:2em;margin-right:1em;"><?=CSOMAGOLOANYAGOK[$p][0]?>
                </a>
            </li>
            <?php
}
        ?>
    </ul>
    <div class="tab-content">
        <?php
foreach(array_keys(CSOMAGOLOANYAGOK) as $p){
    $pq = packagingGetSumByType($p);
    ?>
            <div role="tabpanel" class="tab-pane fade <?=($p==array_keys(CSOMAGOLOANYAGOK)[0]?'in active':'')?>" id="<?=$p?>" style="padding:2em;background:#fff;border-radius:0 0 5px 5px">
                <h4>Teljes készleten lévő mennyiség: <span class="label label-<?=($pq>10?'success':($pq<=0?'danger':'warning'))?>"><?=$pq.' '.CSOMAGOLOANYAGOK[$p][1]?></span></h4>
                <h4>Részletek</h4>
                <table class="table table-striped table-hover display" id="t_<?=$p?>" style="min-width:90%;">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Forg.</td>
                            <td style="min-width:10em;">Mennyiség</td>
                            <td>Dátum</td>
                            <td>Számlaszám</td>
                            <td>Megjegyzés</td>
                            <td>Művelet</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mx = packagingGetMaxQty($p);
                        foreach(packagingGetDetailsByType($p) as $ip){?>
                            <tr>
                                <td>
                                    <?=$ip['ID']?>
                                </td>
                                <td data-order="<?=$ip['Forgalom']?>">
                                    <span class="glyphicon <?=FORGALOM_ICON[$ip['Forgalom']]?>" title="<?=FORGALOM_DICT[$ip['Forgalom']]?>"></span>
                                </td>
                                <td style="min-width:10em;" data-order="<?=$ip['Mennyiseg']?>">
                                    <div class="progress" style="width:8em;display:inline-block; margin-bottom:0;">
                                        <div class="progress-bar  <?=($ip['Mennyiseg']>0?'progress-bar-success':'progress-bar-danger')?>" role="progressbar" style="width: <?=($mx == 0? '0': abs($ip['Mennyiseg'])/$mx*100.0)?>%;min-width: 3em;">
                                            <?=$ip['Mennyiseg'].' '.CSOMAGOLOANYAGOK[$p][1]?>
                                        </div>
                                    </div>
                                </td>
                                <td style="white-space: nowrap">
                                    <?=$ip['Datum']?>
                                </td>
                                <td style="white-space: nowrap">
                                    <?=$ip['Szamlaszam']?>
                                </td>
                                <td>
                                    <div style="max-height:4em; overflow:auto; font-size:80%;">
                                        <?=$ip['Megjegyzes']?>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('Biztosan törölni akarja az ID = <?=$ip['ID']?> sort?')){window.location.href='?mode=csomagoloanyag-keszlet&del=<?=$ip['ID']?>';}">Törlés</button>
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
                                    "searchable": false
            },
                                null,
                                {
                                    "type": "num",
                                    "orderable": true,
                                },
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
                e.preventDefault()
                $(this).tab('show')
            })
            // to fix DataTables header misalignment issue
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $("#t_"+e.target.href.substring(e.target.href.indexOf("#")+1)).dataTable().fnAdjustColumnSizing();
            })
            
            $('#myTabs a:first').tab('show') // Select first tab
        });
    </script>