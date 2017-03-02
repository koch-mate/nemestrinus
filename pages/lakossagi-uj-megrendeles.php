<?php
// store values

if(!empty($_POST['datum'])){
    // store order
    $oid = orderResidentialAdd($_POST['felvette'], $_POST['rogzitette'], $_POST['datum'], $_POST['idatum'], $_POST['megrendelonev'], $_POST['megrendelocim'], $_POST['megrendelotel'], $_POST['kapcsnev'], $_POST['szallcim'], $_POST['kapcstel'], $_POST['ar'], $_POST['szallitasiktsg'], $_POST['megjegyzes'], $_POST['order_json']);

    logEv(LOG_EVENT['order_export_add'].':',null,"ID: ".$oid);  

    $succMessage = "A megrendelés rögzítésre került.";
}


include('lib/messages.php');

//TODO - megrendeles statusza
?>

    <script>
        document.order_db = {};
        document.order_db_id = 0;
        document.fatipusok = {
            <?php foreach(array_keys(FATIPUSOK) as $i){
            ?>
            '<?=$i?>': '<?=FATIPUSOK[$i][0]?>',
            <?php
}?>
        }
        document.csomtip = {
            <?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $i){
            ?>
            '<?=$i?>': '<?=CSOMAGOLASTIPUSOK[$i][0]?>',
            <?php
}?>
        }

        document.nedvesseg = {
            'szaraz': 1,
            'felszaraz': 2,
            'nedves': 3
        }

        function addOrder() {
            if (($("input[name=csomagolas_r]:checked")).length == 0) {
                alert('Válasszon csomagolás típust!');
                return;
            }
            var order = {
                'id': document.order_db_id,
                'fafaj': $("input[name=r_cs]:checked").val(),
                'hossz': $("#hossz").val().replace(',', '-'),
                'atm': $("#huratmero").val().replace(',', '-'),
                'csom': $("input[name=csomagolas_r]:checked").val(),
                'menny': $("#menny_" + $("input[name=csomagolas_r]:checked").val()).val(),
                'mennyme': $("#menny_me_" + $("input[name=csomagolas_r]:checked").val()).html(),
                'nedv': $("input[name=nedvesseg]:checked").val(),
                'nedvszam': document.nedvesseg[$("input[name=nedvesseg]:checked").val()],
            };
            document.order_db[document.order_db_id++] = order;
            document.megrendelt_tabla.row.add([order.id, document.fatipusok[order.fafaj], order.hossz, order.atm, document.csomtip[order.csom], order.menny + ' ' + order.mennyme, Array(order.nedvszam + 1).join('<span class="glyphicon glyphicon-tint"></span>'), '<button type="button" class="btn btn-xs btn-danger" onclick="document.megrendelt_tabla.row($(this).parents(\'tr\')).remove().draw();torles(' + order.id + ')">Törlés</button>']).draw(false);
            $("#order_json").val(JSON.stringify(document.order_db));

        }

        function torles(id) {
            delete document.order_db[id];
            $("#order_json").val(JSON.stringify(document.order_db));
        }
    </script>
    <form class="form-horizontal" id="megr" name="megr" action="/?mode=lakossagi-uj-megrendeles" method="post">
        <fieldset>

            <legend>Új lakossági megrendelés felvétele</legend>

            <div class="form-group">
                <label class="col-md-4 control-label" for="rogzitette">Rendelést rögzítette</label>
                <div class="col-md-5">
                    <input id="rogzitette" name="rogzitette" type="text" placeholder="név" disabled="disabled" value="<?=$_SESSION['realName']?>" class="form-control input-md">
                </div>
            </div>

            <div class="form-group" id="felvdiv">
                <label class="col-md-4 control-label" for="felvcb">Rendelést felvette</label>
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-addon">     
                          <input type="checkbox" id="felvcb"  onchange="$('#felvette').prop('disabled', !this.checked);if(!this.checked){$('#felvdiv').removeClass('has-error');$('#felvette-error').hide();}">     
                      </span>
                        <input id="felvette" required disabled="disabled" name="felvette" class="form-control" type="text" placeholder="név">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput"></label>
                <div class="col-md-5">
                    <div class="alert alert-info" role="alert">Csak papír alapú rendelésfelvétel esetén.</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="datum">Dátum</label>
                <div class="col-md-4">
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        <input class="form-control" name="datum" id="datum" type="dateISO" required placeholder="éééé-hh-nn" value="<?=date('Y-m-d')?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="idatum">Ígért teljesítési határidő</label>
                <div class="col-md-4">
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        <input class="form-control" name="idatum" id="idatum" type="dateISO" required placeholder="éééé-hh-nn" value="<?=date('Y-m-d', time()+(7*24*3600))?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
            </div>


            <?php /*
        <div class="form-group">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> következő szabad időpont: 2016-09-11</div>
            </div>
        </div>
        */ // TODO - kovetkezo szabad idopont
    ?>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="megrendelonev">Megrendelő neve</label>
                    <div class="col-md-5">
                        <input id="megrendelonev" name="megrendelonev" type="megrendelonev" placeholder="név" class="form-control input-md" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="megrendelocim">Megrendelő címe (számlázási cím)</label>
                    <div class="col-md-8">
                        <input id="megrendelocim" name="megrendelocim" type="text" placeholder="irányítószám, helység, utca, házszám" class="form-control input-md" required>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="megrendelotel">Megrendelő telefonszáma</label>
                    <div class="col-md-4">
                        <input id="megrendelotel" name="megrendelotel" type="text" placeholder="+36 20 1234567" class="form-control input-md" required>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button id="singlebutton" name="singlebutton" class="btn btn-default" onclick="$('#kapcsnev').val($('#megrendelonev').val());$('#szallcim').val($('#megrendelocim').val());$('#kapcstel').val($('#megrendelotel').val());$('#megr').valid()" type="button">Megrendelő adatainak másolása</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="kapcsnev">Kapcsolattartó neve</label>
                    <div class="col-md-5">
                        <input id="kapcsnev" name="kapcsnev" required type="text" placeholder="név" class="form-control input-md">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="szallcim">Szállítási cím</label>
                    <div class="col-md-8">
                        <input id="szallcim" required name="szallcim" type="text" placeholder="irányítószám, helység, utca, házszám" class="form-control input-md">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="kapcstel">Kapcsolattartó telefonszáma</label>
                    <div class="col-md-4">
                        <input id="kapcstel" name="kapcstel" required type="text" placeholder="+36 20 1234567" class="form-control input-md">

                    </div>
                </div>
                <div class="jumbotron">

                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Alapanyag</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Félkész termék</a></li>
                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Késztermék</a></li>
                        </ul>
                        <div class="tab-content" style="background:white;padding:1em;border:1px solid #ddd; border-top:none;border-radius:0 0 4px 4px;">
                            <div role="tabpanel" class="tab-pane fade in active" id="alapanyag_tab">
                                <table class="table table-striped table-hover display">
                                    <thead style="font-weight:bold;">
                                        <tr>
                                            <td>Fafaj</td>
                                            <td>Készlet</td>
                                            <td>Függő megrendelés</td>
                                            <td>Különbség</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    foreach(array_keys(FATIPUSOK) as $p){ $pq = rnd(woodGetSumByType($p));?>
                                            <tr>
                                                <td>
                                                    <?=FATIPUSOK[$p][0]?>
                                                </td>
                                                <td><span class="label label-<?=($pq>10?'success':($pq<=0?'danger':'warning'))?>"><?=$pq.' '.U_NAMES[U_STD][0]?></span></td>
                                                <td>???
                                                    <?php // TODO - fuggo megrendelesek ?>
                                                </td>
                                                <td>???
                                                    <?// TODO - kulonbseg ?>
                                                </td>
                                            </tr>

                                            <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="felkesz_termek_tab">...
                                <?// TODO - felkesz termekek ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="kesztermek_tab">...
                                <?// TODO - kulonbseg ?>
                            </div>
                        </div>

                    </div>


                    <div class="form-group" style="margin-top:2em;">
                        <label class="col-md-4 control-label" for="hossz">Fafaj</label>
                        <div class="col-md-4">
                            <?=woodTypesRadioButtons($supply=false)?>
                        </div>
                    </div>
                    <div class="form-group" style="padding-top:1em;">
                        <label class="col-md-4 control-label" for="hossz">Hossz</label>
                        <div class="col-md-8">
                            <input id="hossz" name="hossz" type="text" data-provide="slider" class="span2" value="" data-slider-step="1" data-slider-value="[25,33]" data-slider-ticks="[10, 25, 33, 50, 75]" data-slider-ticks-labels="['10', 25','33','50', '75']" style="width:100%;" />
                            <script>
                                $("#hossz").slider({
                                    tooltip: 'always',
                                    ticks: [10, 25, 33, 50, 75],
                                    ticks_positions: [0, 23, 39, 77, 100],
                                    ticks_labels: ['10 cm', '25 cm', '33 cm', '50 cm', '75 cm'],
                                    ticks_snap_bounds: 4,
                                    formatter: function (v1) {
                                        return ('' + v1 + ' cm').replace(',', '-');
                                    }

                                });
                            </script>
                        </div>
                    </div>
                    <div class="form-group" style="padding-top:1em;">
                        <label class="col-md-4 control-label" for="huratmero">Húrátmérő</label>
                        <div class="col-md-8">
                            <input id="huratmero" name="huratmero" type="text" data-provide="slider" class="span2" value="" data-slider-step="1" data-slider-value="[8,16]" style="width:100%;" />
                            <script>
                                $("#huratmero").slider({
                                    tooltip: 'always',
                                    ticks: [5, 8, 16, 40],
                                    ticks_positions: [0, 23, 49, 100],
                                    ticks_labels: ['5 cm', '8 cm', '16 cm', '40 cm'],
                                    ticks_snap_bounds: 4,
                                    formatter: function (v1) {
                                        return ('' + v1 + ' cm').replace(',', '-');
                                    }

                                });
                            </script>
                        </div>
                    </div>

                    <?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $i){
                        $u_std_convert = unitChange(CSOMAGOLASTIPUSOK[$i][3], U_STD, CSOMAGOLASTIPUSOK[$i][2]);
                        $recalc = "recalc($u_std_convert, '$i');";
                        ?>
                        <div class="form-group" style="padding-top:1em;">
                            <label class="col-md-4 control-label">
                                <?=($i==array_keys(CSOMAGOLASTIPUSOK)[0]?'Csomagolás':'')?>
                            </label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" onclick="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>">
                                    <span style="display:inline-block;width:1.5em;"><img src="/img/<?=$i?>.png" style="height:1em;"></span>
                                    <?=ucfirst(CSOMAGOLASTIPUSOK[$i][0])?>
                                        <input type="radio" value="<?=$i?>" name="csomagolas_r" id='rad_<?=$i?>' onchange="<?=$recalc?>">
                                        </span>
                                        <input type="number" id="menny_<?=$i?>" name="csomagolas_r_<?=$i?>" class="form-control" placeholder="-" onchange="<?=$recalc?>" onkeyup="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>" onfocus="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>">
                                        <span class="input-group-addon" id="menny_me_<?=$i?>"><?=(CSOMAGOLASTIPUSOK[$i][1])?></span>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                            <script>
                                var i = 1;

                                function recalc(xr, nm) {
                                    if ($("#menny_" + nm).val() == "") {
                                        $("#menny_" + nm).val('1');
                                    }
                                    $('#cmenny').html(Math.round(xr * $("#menny_" + nm).val() * 100) / 100 + " <?=U_NAMES[U_STD][0]?>");
                                }
                            </script>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="">&nbsp;</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <p>Rögzített érték: <span class="label label-default" id="cmenny">- <?=U_NAMES[U_STD][0]?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="padding-top:1em;">
                                <label class="col-md-4 control-label" for="huratmero">Nedvesség</label>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="nedvesseg-0">
                                            <input type="radio" name="nedvesseg" id="nedvesseg-0" value="szaraz" checked="checked"> <span style="display:inline-block;width: 5em;">Száraz</span> <span class="glyphicon glyphicon-tint"></span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="nedvesseg-1">
                                            <input type="radio" name="nedvesseg" id="nedvesseg-1" value="felszaraz"> <span style="display:inline-block;width: 5em;">Félszáraz</span> <span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="nedvesseg-2">
                                            <input type="radio" name="nedvesseg" id="nedvesseg-2" value="nedves"> <span style="display:inline-block;width: 5em;">Nedves</span> <span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button id="singlebutton" name="singlebutton" class="btn btn-primary" type="button" onclick="addOrder();">Hozzáadás a megrendeléshez</button>
                                </div>
                            </div>
                            <h4>Megrendelt tételek</h4>

                            <table class="table table-striped table-hover display" id="megrendelt_tetelek" style="min-width:100%;">
                                <thead style="font-weight:bold;">
                                    <tr>
                                        <td>ID</td>
                                        <td>Fafaj</td>
                                        <td>Hossz</td>
                                        <td>Húrátmérő</td>
                                        <td>Csomagolás</td>
                                        <td>Mennyiség</td>
                                        <td>Nedvesség</td>
                                        <td>Művelet</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                </div>


                <div class="form-group" style="padding-top:1em;">
                    <label class="col-md-4 control-label" for="ar">Ár</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input id="ar" name="ar" class="form-control" placeholder="-" type="number" value="" required>
                            <span class="input-group-addon">Ft</span>
                        </div>

                    </div>
                </div>

                <div class="form-group" style="padding-top:1em;">
                    <label class="col-md-4 control-label" for="szallitasiktsg">Szállítási költség</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input id="szallitasiktsg" name="szallitasiktsg" class="form-control" placeholder="-" type="number" value="" required>
                            <span class="input-group-addon">Ft</span>
                        </div>

                    </div>
                </div>

                <div class="form-group" style="padding-top:1em;">
                    <label class="col-md-4 control-label" for="huratmero">Megjegyzés</label>
                    <div class="col-md-5">
                        <textarea class="form-control" id="megjegyzes" name="megjegyzes" rows="4"></textarea>

                    </div>
                </div>

                <input type="hidden" value="{}" name="order_json" id="order_json">

                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" id="rogzites" name="rogzites" class="btn btn-success" value="Rögzítés">
                    </div>
                </div>


        </fieldset>
    </form>

    <script>
        $('#megr').validate({
            submitHandler: function (form) {
                if ($("#order_json").val() == "{}") {
                    alert("Nem adott hozzá egyetlen tételt sem a megrendeléshez.");
                    return false;
                } else {
                    form.submit();
                }
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            document.megrendelt_tabla = $('#megrendelt_tetelek').DataTable({
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
                "info": false,
                "searching": false,
                "ordering": false,

            });
        });
    </script>