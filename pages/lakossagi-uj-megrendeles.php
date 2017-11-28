<?php
// store values

if(!empty($_POST['datum'])){
    // store order
    $rogzitette = isset($_POST['rogzitette']) ? $_POST['rogzitette'] : $_SESSION['userID'];
    $felvette = isset($_POST['felvette']) ? $_POST['felvette'] : $_SESSION['userID'];
    $oid = orderResidentialAdd($felvette, $rogzitette, $_POST['datum'], $_POST['idatum'], $_POST['fizhat'], $_POST['megrendelonev'], $_POST['megrendelocim'], $_POST['megrendelotel'], $_POST['kapcsnev'], $_POST['szallcim'], $_POST['kapcstel'], $_POST['ar'], $_POST['szallitasiktsg'], $_POST['megjegyzes'], $_POST['gyarto'], $_POST['order_json']);

    logEv(LOG_EVENT['order_residental_add'].':',null,"ID: ".$oid);

    $succMessage = "A megrendelés rögzítésre került.";
}


include('lib/popups.php');

//TODO - megrendeles statusza
?>

    <script>
        document.order_db = {};
        document.order_db_id = 0;
        document.nval = 0; // atvaltott mennyiseg
        document.oval = 0; // eredeti mennyiseg
        document.Cfatipus = '<?=array_keys(FATIPUSOK)[0]?>';
        document.Ccsomagolas = '';
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
          <?php
          $n_arr = [];
          foreach (NEDVESSEG as $nk => $nv) {
            $n_arr[]= "'".$nk."' : ".$nv[0];
          }
          print implode(",", $n_arr);
           ?>
        }
        document.nedvNev = [
          <?php
          $n_arr = [];
          foreach (NEDVESSEG as $nk => $nv) {
             $n_arr[]= "'".$nv[1]."'";
          }
          print implode(",", $n_arr);

           ?>
        ]

        function addOrder() {
            if (($("input[name=csomagolas_r]:checked")).length == 0 ) {
                alert('Válasszon csomagolás típust!');
                return;
            }
            if (!$.isNumeric($("#ar").val())) {
                alert('Adjon meg egy árat!');
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
                'ar': $("#ar").val(),
            };
            document.order_db[document.order_db_id++] = order;
            document.megrendelt_tabla.row.add([
              order.id,
              document.fatipusok[order.fafaj],
              order.hossz,
              order.atm,
              document.csomtip[order.csom],
              order.menny + ' ' + order.mennyme,
              Array(order.nedvszam + 1).join('<span class="glyphicon glyphicon-tint" title="'+document.nedvNev[order.nedvszam-1]+'"></span>'),
              order.ar+"&nbsp;Ft",
              '<button type="button" class="btn btn-xs btn-danger" onclick="document.megrendelt_tabla.row($(this).parents(\'tr\')).remove().draw();torles(' + order.id + ')">Törlés</button>']).draw(false);
            $("#order_json").val(JSON.stringify(document.order_db));

            updateVegosszeg();
        }

        function updateVegosszeg(){
            s = 0;
            $.each(document.order_db, function(i,val){
                s += parseFloat( val.ar);
            });
            sz = parseFloat($("#szallitasiktsg").val());
            if(!isNaN(sz)){
                s += sz;
            }
            $("#vegosszeg").html('Végösszeg:&nbsp;'+s+'&nbsp;Ft');
        }

        function torles(id) {
            delete document.order_db[id];
            $("#order_json").val(JSON.stringify(document.order_db));
        }
        function woodChange(fafaj)
        {
          document.Cfatipus = fafaj;
          priceCal();
        }
        function priceCal(){
          var pt = <?=json_encode($ARLISTA[M_LAKOSSAGI])?>;
          document.Ccsomagolas = $('input[name=csomagolas_r]:checked').val();
          try{
            $("#ar").val(Math.round(document.oval*pt[document.Ccsomagolas][document.Cfatipus]*100)/100);
          }
          catch(TypeError){
            $("#ar").val(0);
          }
        }
        function distCalc(){
          var szc = $('#szallcim').val();
          if(szc == "")return;
          $('#tavKm').html('<i class="fa fa-cog  fa-spin fa-fw"></i>');
          // https://maps.googleapis.com/maps/api/distancematrix/json?origins=8444%20Szentgál,%20Magyarország&destinations=7451%20Kaposvár%20Margaréta%20u.%201/d&key=AIzaSyCNgpxoeDSu7tMM5SoTo0d-Gh3JZHrrXAY

          $.ajax({
            method:'GET',
            url:'<?=SERVER_PROTOCOL.SERVER_URL?>ajax/getDistance.php',
            data: {
              origins : '8444%20Szentgál,%20Magyarország',
              destinations : szc
            }
          }).done(function(data){
            $('#tavKm').html(data.rows[0].elements[0].distance.text);
          }).fail(function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
            $('#tavKm').html('-- km');
          });
        }

    </script>
    <form class="form-horizontal" id="megr" name="megr" action="/?mode=lakossagi-uj-megrendeles" method="post">
        <fieldset>

            <legend>Új lakossági megrendelés felvétele <span class="glyphicon glyphicon-home"></span></legend>

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
                        <input class="form-control" name="idatum" id="idatum" type="dateISO" required placeholder="éééé-hh-nn" value="<?=date('Y-m-d', time()+(SZALLITASI_IDO[M_LAKOSSAGI]*24*3600))?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="fizhat">Fizetési határidő</label>
                <div class="col-md-4">
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        <input class="form-control" name="fizhat" id="fizhat" type="dateISO" required placeholder="éééé-hh-nn" value="<?=date('Y-m-d', time()+(7*24*3600))?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="gyarto">Gyártó</label>
                <div class="col-md-4">
                <input id="rogzitette" name="gyarto" type="text"  value="<?=GYARTO_IHARTU?>" class="form-control input-md">
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
                        <button id="singlebutton" name="singlebutton" class="btn btn-default" onclick="$('#kapcsnev').val($('#megrendelonev').val());$('#szallcim').val($('#megrendelocim').val());$('#kapcstel').val($('#megrendelotel').val());$('#megr').valid();distCalc();" type="button">Megrendelő adatainak másolása</button>
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
                        <input id="szallcim" required name="szallcim" type="text" onblur="distCalc();" placeholder="irányítószám, helység, utca, házszám" class="form-control input-md">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="kapcstel">Kapcsolattartó telefonszáma</label>
                    <div class="col-md-4">
                        <input id="kapcstel" name="kapcstel" required type="text" placeholder="+36 20 1234567" class="form-control input-md">

                    </div>
                </div>
                <div class="jumbotron">
                    <?php require('lib/new_order_available_stock_table.php'); ?>

                    <div class="form-group" style="margin-top:2em;">
                        <label class="col-md-4 control-label" for="hossz">Fafaj</label>
                        <div class="col-md-4">
                            <?=woodTypesRadioButtons($supply=false, $callback="woodChange($(this).val());")?>
                        </div>
                    </div>
                    <div class="form-group" style="padding-top:1em;">
                        <label class="col-md-4 control-label" for="hossz">Hossz</label>
                        <div class="col-md-8">
                            <input id="hossz" name="hossz" type="text" data-provide="slider" class="span" value="" data-slider-step="1" data-slider-value="25" data-slider-ticks="[10, 25, 33, 50, 75]" data-slider-ticks-labels="['10', 25','33','50', '75']" style="width:100%;" /><? // FIXME - one value!!!  ?>
                            <script>
                                $("#hossz").slider({
                                    tooltip: 'always',
                                    ticks: [10, 25, 33, 50, 100],
                                    ticks_positions: [0, 23, 39, 66, 100],
                                    ticks_labels: ['10 cm', '25 cm', '33 cm', '50 cm', '100 cm'],
                                    ticks_snap_bounds: 4,
                                    formatter: function (v1) {
                                        return ('' + v1 + ' cm');
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

                    <?php foreach([POSCH_HALOS, OMLESZTETT] as $i){
                        $u_std_convert = unitChange(CSOMAGOLASTIPUSOK[$i][3], U_STD, CSOMAGOLASTIPUSOK[$i][2]);
                        $recalc = "recalc($u_std_convert, '$i');";
                        ?>
                        <div class="form-group" style="padding-top:1em;">
                            <label class="col-md-4 control-label">
                                <?=($i==POSCH_HALOS?'Csomagolás':'')?>
                            </label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" onclick="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>">
                                    <span style="display:inline-block;width:1.5em;"><img src="/img/<?=$i?>.png" style="height:1em;"></span>
                                    <?=ucfirst(CSOMAGOLASTIPUSOK[$i][0])?>
                                        <input type="radio" value="<?=$i?>" name="csomagolas_r" id='rad_<?=$i?>' onchange="<?=$recalc?>">
                                        </span>
                                        <input type="number"  step="any" id="menny_<?=$i?>" name="csomagolas_r_<?=$i?>" class="form-control" placeholder="-" onchange="<?=$recalc?>" onkeyup="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>" onfocus="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>">
                                        <span class="input-group-addon" id="menny_me_<?=$i?>"><?=(CSOMAGOLASTIPUSOK[$i][1])?></span>
                                </div>
                                <?php if($i == OMLESZTETT){?>
                                <div style="padding-top:2em;">
                                    <button type="button" class="btn btn-default btn-sm" onclick="$(this).hide();$('#egyebTipusok').slideDown();">Egyéb típusok <span class="glyphicon glyphicon-chevron-down"></span></button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php }?>
                    <div id='egyebTipusok' style='display:none; background:#f5f5f5;border-radius:4px;padding:1em;margin-bottom:1em;'>
                    <?php foreach([EGYUTAS_KALODA_KICSI, EGYUTAS_KALODA_NAGY, VISSZAVALTHATO_KALODA_KICSI, VISSZAVALTHATO_KALODA_NAGY, POSCH_HALOS_FOLIAS] as $i){
                        $u_std_convert = unitChange(CSOMAGOLASTIPUSOK[$i][3], U_STD, CSOMAGOLASTIPUSOK[$i][2]);
                        $recalc = "recalc($u_std_convert, '$i');";
                        ?>
                        <div class="form-group" style="padding-top:1em;">
                            <label class="col-md-4 control-label">
                            </label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon" onclick="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>">
                                    <span style="display:inline-block;width:1.5em;"><img src="/img/<?=$i?>.png" style="height:1em;"></span>
                                    <?=ucfirst(CSOMAGOLASTIPUSOK[$i][0])?>
                                        <input type="radio" value="<?=$i?>" name="csomagolas_r" id='rad_<?=$i?>' onchange="<?=$recalc?>">
                                        </span>
                                        <input type="number"  step="any" id="menny_<?=$i?>" name="csomagolas_r_<?=$i?>" class="form-control" placeholder="-" onchange="<?=$recalc?>" onkeyup="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>" onfocus="$('#rad_<?=$i?>').prop('checked', true);<?=$recalc?>">
                                        <span class="input-group-addon" id="menny_me_<?=$i?>"><?=(CSOMAGOLASTIPUSOK[$i][1])?></span>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        </div>
                            <script>
                                var i = 1;

                                function recalc(xr, nm) {
                                    if ($("#menny_" + nm).val() == "") {
                                        $("#menny_" + nm).val('0');
                                    }
                                    document.nval = xr * $("#menny_" + nm).val();
                                    document.oval = $("#menny_" + nm).val();
                                    $('#cmenny').html(Math.round(xr * $("#menny_" + nm).val() * 100) / 100 + " <?=U_NAMES[U_STD][0]?>");
                                    priceCal();
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
                                    <?php
                                    $ni = 0;
                                    foreach([N_FRISS] as $nedv){?>
                                    <div class="radio">
                                        <label for="nedvesseg-<?=$ni?>">
                                            <input type="radio" name="nedvesseg" id="nedvesseg-<?=$ni?>" value="<?=$nedv?>" <?=$ni == 0?'checked="checked"' : ''?></input> <span style="display:inline-block;width: 5em;"><?=NEDVESSEG[$nedv][1]?></span> <?=csepp($nedv)?>
                                        </label>
                                    </div>
                                    <?php $ni++; }?>
                                </div>
                            </div>

                            <div class="form-group" style="padding-top:1em;">
                                <label class="col-md-4 control-label" for="ar">Ár</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input id="ar" name="ar" class="form-control" placeholder="-" type="number"  step="any" value="" required>
                                        <span class="input-group-addon">Ft</span>
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
                                        <td>Ár</td>
                                        <td>Művelet</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                </div>


                <?php

                // google distance matrix api:
              //  https://maps.googleapis.com/maps/api/distancematrix/json?origins=8444%20Szentgál,%20Magyarország&destinations=7451%20Kaposvár%20Margaréta%20u.%201/d&key=AIzaSyCNgpxoeDSu7tMM5SoTo0d-Gh3JZHrrXAY
                 ?>

                 <div class="form-group" style="padding-top:1em;">
                     <label class="col-md-4 control-label" for="szallitasiktsg">Szállítási díj</label>
                     <div class="col-md-4">
                         <div class="input-group">
                             <input id="szallitasiktsg" name="szallitasiktsg" class="form-control" placeholder="-" onchange="updateVegosszeg()" onkeyup="updateVegosszeg()"  step="any" type="number" value="" required>
                             <span class="input-group-addon">Ft</span>
                         </div>

                     </div>
                 </div>
                 <div class="form-group" style="padding-top:1em;">
                     <label class="col-md-4 control-label" ></label>
                     <div class="col-md-4">
                          <div id="tavolsag">
                          Távolság Szentgáltól közúton: <span id="tavKm" style="font-size:120%;" class="label label-default">-- km</span>
                          </div>
                     </div>
                 </div>
                <div class="form-group" style="padding-top:1em;">
                    <label class="col-md-4 control-label" for="vegosszeg"></label>
                    <div class="col-md-4">
                        <div>
                            <span  id="vegosszeg" class="label label-default" style="font-size:120%">Végösszeg: - Ft </span>
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
