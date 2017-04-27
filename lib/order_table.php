<?php
function orderTable($filters=[], $customerON = false, $customerDetailsON = false, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = false, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false){
?>
<style>
    div.dataTables_scrollBody {
        padding-bottom: 18em;
    }
    .highlight {
        color:#4d75b3;
    }
    td.gyartasStatusz {
        color:#fff;
        padding:3px;
        text-align: center;
    }
    table.orderItems tr:hover {
        background: #fff;
    }
    table.orderItems {
        font-size:80%;
        white-space: nowrap;
    }
</style>

<table class="table table-striped table-hover display" id="megrendelt_tetelek" style="min-width:100%;font-size:90%;">
        <thead style="font-weight:bold">
            <tr>
                <th style="vertical-align:bottom;">ID</th>
                <th style="vertical-align:bottom;"></th>
                <th style="vertical-align:bottom;" title="Típus">T.</th>
                <th style="vertical-align:bottom;" title="Prioritás">P.</th>
<?php if($customerON){ ?>
                <th style="vertical-align:bottom;">Megrendelő</th>
<?php } ?>                
                <th style="vertical-align:bottom;">Megrendelés dátuma</th>
                <th style="vertical-align:bottom;">Ígért teljesítés dátuma</th>
                <th style="vertical-align:bottom;">Megrendelés státusza</th>
                <th style="vertical-align:bottom;">Tétel(ek)</th>
<?php if($shippingON){ ?>
                <th style="vertical-align:bottom;">Szállítás</th>
<?php } ?>                
<?php if($priceON){ ?>
                <th style="vertical-align:bottom;">Ár</th>
<?php } ?>                
<?php if($paymentON){ ?>
                <th style="vertical-align:bottom;">Fizetés</th>
<?php } ?>                
                <th style="vertical-align:bottom;">Megjegyzés</th>
<?php if($editButtonON || $trashButtonON){?>
                <th style="vertical-align:bottom;">Művelet</th>
<?php } ?>                
            </tr>
        </thead>
        <tbody>
            <?php 

                foreach(ordersGetAllData($filters=$filters) as $og){?>
                <tr id="tr_<?=$og['ID']?>">
                    <td>
                        <?=$og['ID']?>
                    </td>
                    <td style="background:<?=M_S_SZINEK[$og['Statusz']][0]?>;color:#fff;vertical-align:middle;text-align:center;font-size:1.5em;"><i class="fa  fa-<?=M_S_SZINEK[$og['Statusz']][1]?>" aria-hidden="true"></i></td>
                    <td data-order="<?=$og['Tipus']?>">
                        <span class="glyphicon glyphicon-<?=($og['Tipus']==M_LAKOSSAGI ? 'home" title="lakossági':'globe" title="export')?>" aria-hidden="true"></span>
                    </td>
                    <td style="font-size:80%;" data-order="<?=$og['Prioritas']?>">
                        <?=str_repeat('<span class="glyphicon glyphicon-star"></span><br>', $og['Prioritas'])?>
                    </td>
<?php if($customerON){ ?>
                    <td>
<?php if($customerDetailsON){?>                    
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
<?php } else { // customerDetailsON ?> 
            <?=($og['Tipus']==M_LAKOSSAGI ? $og['MegrendeloNev'] : exportCustomerGetNameById($og['MegrendeloID']))?>
<?php } ?>
                    </td>
<?php } ?>                    
                    <td>
                        <?=$og['RogzitesDatum']?>
                    </td>
                    <td>
                        <?=($og['KertDatum'] <= date('Y-m-d') && in_array($og['Statusz'], M_S_AKTIV) ? '<span style="color:red;"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span>').$og['KertDatum']?></span>
                    </td>
                    <td>
<?php if($globStatusEditON){?>
                        <div id="div_po_<?=$og['ID']?>" style="display:none">
                            <?php
                            foreach(M_S_STATUSZOK as $ms){
                                if($ms == $og['Statusz']){continue;}
                                ?>
                                <p>
                                    <button type='button' class='btn btn-xs btn-primary' style='background:<?=M_S_SZINEK[$ms][0]?>;border-color:<?=M_S_SZINEK[$ms][0]?>;font-weight:bold;width:100%;' onclick='if(confirm("Státusz módosítása erre: <?=$ms?>")){saveStatus(<?=$og['ID']?>,"<?=$ms?>")};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>
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
<?php } else {?>  
                        <span id="po_<?=$og['ID']?>" class="btn btn-xs btn-primary " style="cursor:default;background:<?=M_S_SZINEK[$og['Statusz']][0]?>;border-color:<?=M_S_SZINEK[$og['Statusz']][0]?>;font-weight:bold;" >
                            <?=$og['Statusz']?>
                        </span>
<?php } ?>                        
                        
<?php if($globStatusEditON){?>         
                        <script>
                            $("#po_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'bottom',
                                trigger: 'focus',
                                content: function () {
                                    return $('#div_po_<?=$og['ID']?>').html()
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");});
                            function saveStatus(lid, nst){
                                $.ajax({
                                    type: "POST",
                                    dataType: "html",
                                    url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_state_order.php",
                                    data: ({'ID':lid, 'Statusz':nst}),
                                    success: function(data){
                                        location.reload();
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        alert("Hiba!")
                                    }
                                });
                            }
                        </script>
<?php } ?>                        
                    </td>
                    <td>
                        <table class="orderItems"  >
                            <?php foreach(ordersGetItemsByID($og['ID']) as $oi){ ?>
                                <tr >
                                    <td class="gyartasStatusz">
                                        <span class="label" title="<?=$oi['GyartasStatusza']?>" style="font-size:100%;background:<?=GY_S_SZINEK[$oi['GyartasStatusza']][0]?>;"><i class="fa fa-<?=GY_S_SZINEK[$oi['GyartasStatusza']][1]?> fa-fw"></i></span> </td>
                                    <td><b>ID:</b>&nbsp;<?=$oi['ID']?></td>
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
<?php if($priceON){ ?>                                    
                                    <td style="padding-right:0.8em;">
                                        <?=$oi['Ar']."&nbsp;".$og['Penznem']?>
                                    </td>
<?php } ?>                                    
                                    <td style="padding-right:0.8em;">
                                        <?=str_repeat('<span class="glyphicon glyphicon-tint"></span>',NEDVESSEG[$oi['Nedvesseg']][0])?>
                                    </td>
                                    <td></td>
                                    <td><?=($oi['GyartasVarhatoDatuma'] <= date('Y-m-d') && in_array($oi['GyartasStatusza'], GY_S_AKTIV) ? '<span style="color:red;"><b>V:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>V:</b>&nbsp;').$oi['GyartasVarhatoDatuma']?></span></td>
                                    <td>&nbsp;<b>T:</b> <?=$oi['GyartasDatuma']?>&nbsp;</td>
                                </tr>
                                <?php } ?>
                        </table>
                    </td>
<?php if($shippingON){ ?>
                    <td data-order="array_search(<?=$og['SzallitasStatusza']?>, array_keys(SZ_S_SZINEK))">
                        <table class="orderItems">
                            <tr>
                                <td rowspan="2">
                                    <span class="label" title="<?=$og['SzallitasStatusza']?>" style="font-size:100%;background:<?=SZ_S_SZINEK[$og['SzallitasStatusza']][0]?>;"><i class="fa fa-<?=SZ_S_SZINEK[$og['SzallitasStatusza']][1]?> fa-fw"></i></span> 
                                </td>
                                <td style="padding-left:0.5em;">
                                    <?=($oi['SzallitasVarhatoDatuma'] <= date('Y-m-d') && in_array($oi['GyartasStatusza'], GY_S_AKTIV) ? '<span style="color:red;"><b>V:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>V:</b>&nbsp;').$oi['SzallitasVarhatoDatuma']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:0.5em;"><b>T:</b>&nbsp;<?=$og['SzallitasTenylegesDatuma']?></td>
                            </tr>
                        </table>
                    </td>
<?php } ?>
<?php if($priceON){ ?>
                    <td style="white-space: nowrap;">
                        <b><?=(orderFullPrice($og['ID'])+$og['Fuvardij'])?>&nbsp;<?=$og['Penznem']?></b><br>
                        <i class="fa fa-truck" aria-hidden="true"></i>&nbsp;<?=($og['Fuvardij'])?>&nbsp;<?=$og['Penznem']?>
                    </td>
<?php } ?>
<?php if($paymentON){ ?>
                    <td data-order="array_search(<?=$og['FizetesStatusza']?>, array_keys(SZ_S_SZINEK))">
                        
                        
                        <div id="div_fs_<?=$og['ID']?>" style="display:none">
                            <?php
                            foreach(array_keys(F_S_SZINEK) as $fs){
                                if($fs == $og['FizetesStatusza']){continue;}
                                ?>
                                <p>
                                    <button type='button' class='btn btn-xs btn-primary' style="background:<?=F_S_SZINEK[$fs][0]?>;border-color:<?=F_S_SZINEK[$fs][0]?>;" onclick='if(confirm("Fizetési státusz módosítása erre: <?=$fs?>")){savePaidStatus(<?=$og['ID']?>,"<?=$fs?>")};$("#tr_<?=$og['ID']?>").removeClass("highlight");'><i class="fa fa-<?=F_S_SZINEK[$fs][1]?> fa-fw" ></i><?=$fs?></button>

                                </p>
                                <?php
                            }                                                                                                                        
                            ?>
                        </div>
                        <a tabindex="1" data-toggle="popover" id="fs_<?=$og['ID']?>" class="btn btn-xs btn-primary " title="Sátusz módosítása" style="background:<?=F_S_SZINEK[$og['FizetesStatusza']][0]?>;border-color:<?=F_S_SZINEK[$og['FizetesStatusza']][0]?>;font-weight:bold;" onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');">
                            <i class="fa fa-<?=F_S_SZINEK[$og['FizetesStatusza']][1]?> fa-fw"></i>
                        </a>

                    </td>    
                        <script>
                            $("#fs_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'bottom',
                                trigger: 'focus',
                                content: function () {
                                    return $('#div_fs_<?=$og['ID']?>').html()
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");});
                            function savePaidStatus(lid, nst){
                                $.ajax({
                                    type: "POST",
                                    dataType: "html",
                                    url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_state_paid.php", //TODO
                                    data: ({'ID':lid, 'Statusz':nst}),
                                    success: function(data){
                                        location.reload();
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        alert("Hiba!")
                                    }
                                });
                            }
                        </script>


<?php } ?>
                    <td>
                        <div style="overflow:auto; font-size:80%; display:none;" class="megj">
                            <?=renderMessages($og['Megjegyzes'])?>
                        </div>
                    </td>

<?php if($editButtonON || $trashButtonON){?>

                    <td>
<?php if($editButtonON){?>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editorWin" data-id="<?=$og['ID']?>">
  <span class="glyphicon glyphicon-menu-hamburger"></span>
</button>
<?php } ?>
<?php if($trashButtonON){?>
<button type="button" class="btn btn-primary btn-sm" onclick="deleteOrder(<?=$og['ID']?>);" >
  <span class="glyphicon glyphicon-trash" ></span>
</button>
<?php } ?>

                    </td>
<?php } ?>
                </tr>
                <?php } ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#megrendelt_tetelek').DataTable({
                "scrollX": true,
                "lengthMenu": [[50, 100, 250, 500, -1], [50, 100, 250, 500, "minden"]],                
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
                "stateSave": true,
                "columns": [
                    null,   // ID
                    {
                        'searchable': false,
                        'orderable': false
                    },      // status icon
                    null,   // type
                    null,   // prio
<?php if($customerON){ ?>
                    null,   // customer
<?php } ?>
                    null,
                    null,
                    null,
                    {
                        'orderable': false,
                    },
<?php if($shippingON){ ?>
                    null,   // szallitas statusz
<?php } ?>
<?php if($priceON){ ?>
                    {       // ar
                        'orderable': false,
                    },
<?php } ?>
<?php if($paymentON){ ?>
                    null,   // fizetes statusz
<?php } ?>

                    {   // megjegyzes
                        'orderable': false,
                    },
<?php if($editButtonON || $trashButtonON){?>
                    {   // muvelet
                        'searchable': false,
                        'orderable': false
                    },
<?php } ?>
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

<?php } ?>