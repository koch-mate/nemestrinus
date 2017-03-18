<?php ?>
<style>
    div.dataTables_scrollBody {
        padding-bottom: 18em;
    }
    .highlight {
        text-shadow: 1px 1px 1px #bbb;
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
    <h2>Megrendelések</h2>

<form method="get"  >
    <input type="hidden" name="mode" value="megrendeles-osszesites">
    <fieldset>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-target="#collapseOne" role="tab" id="headingOne" style="cursor:pointer;">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="<?=(empty($_GET['md']) && empty($_GET['td']) && empty($_GET['tip'])) ? 'false' : 'true'?>" aria-controls="collapseOne">
                    <span class="glyphicon glyphicon-filter" style="margin-right:1em;"></span>Szűrők
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse <?=(empty($_GET['md']) && empty($_GET['td']) && empty($_GET['tip'])) ? '' : 'in'?>" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
             <?php
                    $tnev = [
                        'md' => 'Megrendelés dátuma',
                        'td' => 'Ígért teljesítés dátuma',
                    ];
                    foreach(array_keys($tnev) as $tn){
                    ?>
                    <div class="form-group">
                        <input type="checkbox" name="<?=$tn?>" id="<?=$tn?>_picker" value="on" data-size="mini" <?=($_GET[$tn]=='on'?'checked':'')?> >
                        <script>
                        $(function() {
                            $('#<?=$tn?>_picker').bootstrapToggle({
                                off: '<span class="glyphicon glyphicon-minus"></span>',
                                on: '<span class="glyphicon glyphicon-plus"></span>',
                                onstyle: 'success',
                                offstyle: 'warning',
                            });
                        })
                        </script>
                        <label style="width: 15em;"><?=$tnev[$tn]?></label>
                        <?php
                        $sy1 = empty($_GET[$tn.'y1']) ? 2016 : $_GET[$tn.'y1'];
                        $sm1 = empty($_GET[$tn.'m1']) ? 1 : $_GET[$tn.'m1'];
                        $sy2 = empty($_GET[$tn.'y2']) ? intval(date('Y'))+4 : $_GET[$tn.'y2'];
                        $sm2 = empty($_GET[$tn.'m2']) ? 12 : $_GET[$tn.'m2'];

                        ?>
                        <select id="<?=$tn?>y1" name="<?=$tn?>y1"><?php for($y = 2016;$y<=intval(date('Y'))+4;$y++){?><option value="<?=$y?>" <?=($y == intval($sy1) ? 'selected="selected"': '')?>><?=$y?></option><?php }?></select>
                        <select id="<?=$tn?>m1" name="<?=$tn?>m1"><?php foreach(array_keys(MONTHS) as $m){?><option value="<?=$m?>"  <?=($m == intval($sm1) ? 'selected="selected"': '')?>><?=MONTHS[$m]?></option><?php }?></select>
                        -tól
                        <span style="margin-right:3em;">&nbsp;</span>
                        <select id="<?=$tn?>y2" name="<?=$tn?>y2"><?php for($y = 2016;$y<=intval(date('Y'))+4;$y++){?><option value="<?=$y?>"  <?=($y == intval($sy2) ? 'selected="selected"': '')?>><?=$y?></option><?php }?></select>
                        <select id="<?=$tn?>m2" name="<?=$tn?>m2"><?php foreach(array_keys(MONTHS) as $m){?><option value="<?=$m?>"  <?=($m == intval($sm2) ? 'selected="selected"': '')?>><?=MONTHS[$m]?></option><?php }?></select>
                        -ig
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <input type="checkbox" name="tip" id="tip_picker" value="on" data-size="mini" <?=($_GET['tip']=='on'?'checked':'')?> >
                        <script>
                        $(function() {
                            $('#tip_picker').bootstrapToggle({
                                off: '<span class="glyphicon glyphicon-minus"></span>',
                                on: '<span class="glyphicon glyphicon-plus"></span>',
                                onstyle: 'success',
                                offstyle: 'warning',
                            });
                        })
                        </script>
                        <label style="width: 15em;">Típus</label>
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default <?=($_GET['lak']=='on'?'active':'')?>">
                                <input type="checkbox" autocomplete="off" name="lak" value="on" <?=($_GET['lak']=='on'?'checked':'')?>><span class="glyphicon glyphicon-home"></span> Lakossági
                              </label>
                              <label class="btn btn-default <?=($_GET['ex']=='on'?'active':'')?>">
                                <input type="checkbox" autocomplete="off" name="ex" value="on" <?=($_GET['ex']=='on'?'checked':'')?>><span class="glyphicon glyphicon-globe"></span> Export
                              </label>
                            </div>
                        </div>
                    <div style="margin-top:2em;">
                        <button type="submit" class="btn btn-primary" >
            Frissítés</button>
                    </div>             
                </div>
            </div>
          </div>
        </div>
       
    </fieldset>
</form>
    

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
                <th style="vertical-align:bottom;">Szállítás</th>
                <th style="vertical-align:bottom;">Ár</th>
                <th style="vertical-align:bottom;">Fizetés</th>
                <th style="vertical-align:bottom;">Megjegyzés</th>
                <th style="vertical-align:bottom;">Művelet</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $f = [];
                if($_GET['md'] == 'on'){
                    $f['RogzitesDatum'] = [date("Y-m-d", mktime(0,0,0,$_GET['mdm1'],1, $_GET['mdy1'])), date("Y-m-d", mktime(0,0,0,intval($_GET['mdm2'])+1,0, $_GET['mdy2']))];                    
                }
                if($_GET['td'] == 'on'){
                    $f['KertDatum'] = [date("Y-m-d", mktime(0,0,0,$_GET['tdm1'],1, $_GET['tdy1'])), date("Y-m-d", mktime(0,0,0,intval($_GET['tdm2'])+1,0, $_GET['tdy2']))];                    
                }
                if($_GET['tip'] == 'on'){
                    $f['Tipus'] = [];
                    if($_GET['lak'] == 'on'){
                        $f['Tipus'][] = M_LAKOSSAGI;
                    }
                    if($_GET['ex'] == 'on'){
                        $f['Tipus'][] = M_EXPORT;
                    }
                }
                foreach(ordersGetAllData($filters=$f) as $og){?>
                <tr id="tr_<?=$og['ID']?>">
                    <td>
                        <?=$og['ID']?>
                    </td>
                    <td style="background:<?=M_S_SZINEK[$og['Statusz']][0]?>;color:#fff;vertical-align:middle;text-align:center;font-size:1.5em;"><i class="fa  fa-<?=M_S_SZINEK[$og['Statusz']][1]?>" aria-hidden="true"></i></td>
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
                        <?=($og['KertDatum'] <= date('Y-m-d') && in_array($og['Statusz'], M_S_AKTIV) ? '<span style="color:red;"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span>').$og['KertDatum']?></span>
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
                        <table class="orderItems"  >
                            <?php foreach(ordersGetItemsByID($og['ID']) as $oi){
                                
                            ?>
                                <tr >
                                    <td class="gyartasStatusz">
                                        <span class="label" title="<?=$oi['GyartasStatusza']?>" style="font-size:100%;background:<?=GY_S_SZINEK[$oi['GyartasStatusza']][0]?>;"><i class="fa fa-<?=GY_S_SZINEK[$oi['GyartasStatusza']][1]?> fa-fw"></i></span> </td>
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
                                    <td><?=($oi['GyartasVarhatoDatuma'] <= date('Y-m-d') && in_array($oi['GyartasStatusza'], GY_S_AKTIV) ? '<span style="color:red;"><b>V:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>V:</b>&nbsp;').$oi['GyartasVarhatoDatuma']?></span></td>
                                    <td>&nbsp;<b>T:</b> <?=$oi['GyartasDatuma']?>&nbsp;</td>
                                </tr>
                                <?php } ?>
                        </table>
                    </td>
                    <td data-order="array_search(<?=$og['SzallitasStatusza']?>, array_keys(SZ_S_SZINEK))"><span class="label" title="<?=$og['SzallitasStatusza']?>" style="font-size:100%;background:<?=SZ_S_SZINEK[$og['SzallitasStatusza']][0]?>;"><i class="fa fa-<?=SZ_S_SZINEK[$og['SzallitasStatusza']][1]?> fa-fw"></i></span>
                    </td>
                    <td style="white-space: nowrap;">
                        <b><?=($og['Vegosszeg'])?>&nbsp;<?=$og['Penznem']?></b><br>
                        <i class="fa fa-truck" aria-hidden="true"></i>&nbsp;<?=($og['Fuvardij'])?>&nbsp;<?=$og['Penznem']?>
                    </td>
                    <td data-order="array_search(<?=$og['FizetesStatusza']?>, array_keys(SZ_S_SZINEK))"><span class="label" title="<?=$og['FizetesStatusza']?>" style="font-size:100%;background:<?=F_S_SZINEK[$og['FizetesStatusza']][0]?>;"><i class="fa fa-<?=F_S_SZINEK[$og['FizetesStatusza']][1]?> fa-fw"></i></span>
                    </td>                    <td>
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
                    null,
                    {
                        'orderable': false,
                    },
                    null,

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