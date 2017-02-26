<?php ?>
<style>
    div.dataTables_scrollBody {
        padding-bottom: 18em;
    }
    .highlight {
        text-shadow: 1px 1px 1px #bbb;
    }
    td.gyartasStatusz {
        max-width:0.5em;
        min-width:0.5em;
        padding: 3px;
    }
</style>
    <h2>Megrendelések</h2>
    <table class="table table-striped table-hover display" id="megrendelt_tetelek" style="min-width:100%;font-size:90%;">
        <thead style="font-weight:bold">
            <tr>
                <th style="vertical-align:bottom;">ID</th>
                <th style="vertical-align:bottom;"></th>
                <th style="vertical-align:bottom;" title="Típus">T.</th>
                <th style="vertical-align:bottom;" title="Prioritás">P.</th>
                <th style="vertical-align:bottom;">Megrendelő</th>
                <th style="vertical-align:bottom;">Megrendelés dátuma</th>
                <th style="vertical-align:bottom;">Ígért teljesítés dátuma</th>
                <th style="vertical-align:bottom;">Megrendelés státusza</th>
                <th style="vertical-align:bottom;">Tétel(ek)</th>
                <th style="vertical-align:bottom;">Megjegyzés</th>
                <th style="vertical-align:bottom;">Művelet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach(ordersGetAllData() as $og){?>
                <tr id="tr_<?=$og['ID']?>">
                    <td>
                        <?=$og['ID']?>
                    </td>
                    <td style="background:<?=M_S_SZINEK[$og['Statusz']][0]?>;"></td>
                    <td>
                        <span class="glyphicon glyphicon-<?=($og['Tipus']==M_LAKOSSAGI ? 'home" title="lakossági':'globe" title="export')?>" aria-hidden="true"></span>
                    </td>
                    <td style="font-size:80%;" data-order="<?=$og['Prioritas']?>">
                        <?=str_repeat('<span class="glyphicon glyphicon-star"></span><br>', $og['Prioritas'])?>
                    </td>
                    <td>
                        <a tabindex="0" data-toggle="popover" title="Adatok" data-content="<?php if($og['Tipus']==M_LAKOSSAGI){?><table class='table table-striped table-hover' style='font-size:80%'>
                            <tbody>
                                <tr>
                                    <th>Megrendelő neve</th>
                                    <td>
                                        <?=$og['MegrendeloNev']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Számlázási cím</th>
                                    <td>
                                        <?=$og['MegrendeloCim']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telefonszám</th>
                                    <td>
                                        <?=$og['MegrendeloTel']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kapcsolattartó neve</th>
                                    <td>
                                        <?=$og['KapcsolattartoNev']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Szállítási cím</th>
                                    <td>
                                        <?=$og['SzallitasiCim']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telefonszám</th>
                                    <td>
                                        <?=$og['KapcsolattartoTel']?>
                                    </td>
                                </tr>
                            </tbody>
                        </table><?} else{ $ec = getExportCustomerDataById($og['MegrendeloID'])[0];?> <table class='table table-striped table-hover' style='font-size:80%'>
                            <tbody>
                                <tr>
                                    <th>Cégnév</th>
                                    <td>
                                        <?=$ec['MegrendeloNev']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Képviselő</th>
                                    <td>
                                        <?=$ec['Kepviselo']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Adószám</th>
                                    <td>
                                        <?=$ec['Adoszam']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telefon</th>
                                    <td>
                                        <?=$ec['Telefonszam']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fax</th>
                                    <td>
                                        <?=$ec['Fax']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>E-mail cím</th>
                                    <td>
                                      <a href='mailto:<?=$ec['Email']?>'><?=$ec['Email']?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Szállításdi cím</th>
                                    <td>
                                        <?=$ec['SzallitasiCim']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Számlázási cím</th>
                                    <td>
                                        <?=$ec['SzamlazasiCim']?>
                                    </td>
                                </tr>
                            </tbody>
                        </table><?php }?>" style="cursor:pointer;">
                            <?=($og['Tipus']==M_LAKOSSAGI ? $og['MegrendeloNev'] : exportCustomerGetNameById($og['MegrendeloID']))?>
                        </a>
                    </td>
                    <td>
                        <?=$og['RogzitesDatum']?>
                    </td>
                    <td>
                        <?=$og['KertDatum']?>
                    </td>
                    <td>
                        <div id="div_po_<?=$og['ID']?>" style="display:none">
                            <?php
                            foreach(M_S_STATUSZOK as $ms){
                                ?>
                                <p>
                                    <button type='button' class='btn btn-xs btn-primary' style='background:<?=M_S_SZINEK[$ms][0]?>;border-color:<?=M_S_SZINEK[$ms][0]?>;font-weight:bold;width:100%;' onclick='if(confirm("Státusz módosítása")){};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>
                                        <?=$ms?>
                                    </button>
                                </p>
                                <?php
                            }                                                                                                                        
                            ?>
                        </div>
                        <a tabindex="1" data-toggle="popover" id="po_<?=$og['ID']?>" class="btn btn-xs btn-primary " title="Sátusz módosítása" style="background:<?=M_S_SZINEK[$og['Statusz']][0]?>;border-color:<?=M_S_SZINEK[$og['Statusz']][0]?>;font-weight:bold;" onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');">
                            <?=$og['Statusz']?>
                        </a>
                        <script>
                            $("#po_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'bottom',
                                trigger: 'focus',
                                content: function () {
                                    return $('#div_po_<?=$og['ID']?>').html()
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");});
                        </script>
                    </td>
                    <td>
                        <table  style="font-size:80%;white-space: nowrap;width:100%;">
                            <?php foreach(ordersGetItemsByID($og['ID']) as $oi){
                                
                            ?>
                                <tr style="background-color:<?=colourBrightness(GY_S_SZINEK[$oi['GyartasStatusza']][0],0.2)?>;" >
                                    <td class="gyartasStatusz" title="<?=$oi['GyartasStatusza']?>" style="background:<?=GY_S_SZINEK[$oi['GyartasStatusza']][0]?>;"></td>
                                    <td style="padding:0 0.8em 0 0.8em;">
                                        <img src="img/<?=$oi['Fafaj']?>.png" class="zoom" style="height:1em;">
                                        <?=FATIPUSOK[$oi['Fafaj']][0]?>
                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <span class="glyphicon glyphicon-minus"></span>
                                        <?=$oi['Hossz']?> cm
                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <span class="glyphicon glyphicon-resize-full"></span>
                                        <?=$oi['Huratmero']?> cm
                                    </td>
                                    <td style="padding-right:0.8em;text-align:center;">
                                        <img src="img/<?=$oi['Csomagolas']?>.png" style="height:1em;" class="zoom" title="<?=CSOMAGOLASTIPUSOK[$oi['Csomagolas']][0]?>">

                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <?=$oi['Mennyiseg']?>
                                            <?=CSOMAGOLASTIPUSOK[$oi['Csomagolas']][1]?>
                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <?=str_repeat('<span class="glyphicon glyphicon-tint"></span>',NEDVESSEG[$oi['Nedvesseg']][0])?>
                                    </td>
                                    <td></td>
                                    <td><?=$oi['GyartasVarhatoDatuma']?></td>
                                    <td><?=$oi['GyartasDatuma']?></td>
                                </tr>
                                <?php } ?>
                        </table>
                    </td>
                    <td>
                        <div style="overflow:auto; font-size:80%; display:none;" class="megj">
                            <?=$og['Megjegyzes']?>
                        </div>
                    </td>
                    <td><a href="#" class="btn btn-lg" role="button"><span class="glyphicon glyphicon-menu-hamburger"></span></a></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#megrendelt_tetelek').DataTable({
                "scrollX": true,
                "language": {
                    "decimal": "",
                    "emptyTable": "Nincs adat",
                    "info": "Megjelenítve: _START_ és _END_ között, összesen _TOTAL_ adatsor",
                    "infoEmpty": "Nincs megjeleníthető adatsor",
                    "infoFiltered": "(_MAX_ adatsorból szűrve)",
                    "infoPostFix": "",
                    "thousands": ".",
                    "lengthMenu": "Mutass _MENU_ megrendelést",
                    "loadingRecords": "Betöltés...",
                    "processing": "Feldolgozás...",
                    "search": "Keresés:",
                    "zeroRecords": "Nincs találat",
                    "paginate": {
                        "first": "Első",
                        "last": "Utolsó",
                        "next": "Következő",
                        "previous": "Előző"
                    },
                },
                "info": true,
                "columns": [
                    null,
                    {
                        'searchable': false,
                        'orderable': false
                    },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    {
                        'orderable': false,
                    },
                    {
                        'orderable': false,
                    },
                    {
                        'searchable': false,
                        'orderable': false
                    },
            ],
            });
            $('[data-toggle="popover"]').popover({
                'html': true,
                'placement': 'bottom',
                //                'container': 'body',
                'trigger': 'focus'
            });

            // ugly hack to fix column headers
            setTimeout(function () {
                $("#megrendelt_tetelek").dataTable().fnAdjustColumnSizing();
            }, 500);
            $('.megj').each(function (i, obj) {
                $(obj).css('max-height', $(obj).parent().height() + 'px').css('display', 'block');
            });

        });
    </script>