<?php

if(!empty($_POST['cmennyiseg'])){
    woodAdd($_POST['fatipus'], -$_POST['cmennyiseg'], null, $_POST['szlaszam'], $_POST['szallitolevel'], $_POST['datum'], $_POST['megj'], FORGALOM_KIADAS, $_POST['ekaer'], $_POST['cmr'], $_POST['fuvarozo'],$faanyagID=$_POST['refID']);
    logEv(LOG_EVENT['wood_sell'].':',null,implode(', ',[FATIPUSOK[$_POST['fatipus']][0], $_POST['cmennyiseg'].' '.U_NAMES[U_STD][0], $_POST['szlaszam'], $_POST['datum']]));
    $succMessage = "Rögzítve.";
}

include('lib/popups.php');

woodJsUnitConversion($maxVal =( isset($_POST['mennyiseg']) ? $_POST['mennyiseg']:0 ));
?>


    <h2>Alapanyagok eladása</h2>
    <div class="alert alert-info" role="alert">Faanyag egyedi értékesítése esetén használandó. A gyártás során történő felhasználást a gyártás menü alatt kell rögzíteni.</div>

    <?php if(isset($_POST['mennyiseg']) && isset($_POST['id'])){ ?>
        <form class="form-horizontal" id="csom" name="alapanyag" method="post" action="/?mode=faanyag-kiadas">
            <fieldset>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkboxes">Értékesítés ebből a készletelemből</label>
                    <div class="col-md-4">
                      <?php $dat = (woodGetDataById($_POST['id']));?>
                      <p> <b>ID:</b> <?=$dat['ID']?> </p>
                      <p> <b>Eredeti mennyiség:</b> <?=rnd($dat['Mennyiseg']).' '.U_NAMES[U_STD][0]?> </p>
                      <p> <b>Fel nem használt mennyiség:</b> <?=rnd($_POST['mennyiseg']).' '.U_NAMES[U_STD][0]?> </p>
                      <p> <b>Beszállító:</b> <?=$dat['Beszallito']?> </p>
                      <p> <b>Fatípus:</b> <?=FATIPUSOK[$dat['Fatipus']][0]?> <span style="display:inline-block;width:2em;"><img src="/img/<?=$dat['Fatipus']?>.png" class="zoom" style="height:1em;"></span> </p>
                      <p> <b>Dátum:</b> <?=$dat['Datum']?> </p>
                      <p> <b>Számlaszám:</b> <?=$dat['Szamlaszam']?>  </p>
                    </div>
                </div>
            <input type="hidden" name="fatipus" value="<?=$dat['Fatipus']?>" />
            <input type="hidden" name="refID" value="<?=$dat['ID']?>" />
            <input type="hidden" id="cmennyiseg" name="cmennyiseg" value="0">
            <div class="form-group">
                <label class="col-md-4 control-label" for="mennyiseg">Eladandó mennyiség</label>
                <div class="col-md-6">
                    <div class="btn-group btn-group-xs" role="group">
                        <?php foreach(array_keys(U_NAMES) as $un){?>
                            <button type="button" class="btn btn-<?=($un == array_keys(U_NAMES)[0]?'primary':'default')?>" id="me_btn_<?=$un?>" onclick="btnClick($('#me_btn_<?=$un?>'),'<?=U_NAMES[$un][1]?>','<?=U_FACT[$un]?>');">
                                <?=U_NAMES[$un][0]?>
                            </button>
                            <?php }?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="">&nbsp;</label>
                <div class="col-md-5">
                    <div class="input-group">
                        <input id="mennyiseg" name="mennyiseg" class="form-control" placeholder="-" type="number" step="any" required onchange="recalc()" onkeyup="recalc();">
                        <span class="input-group-addon" id="mertekegyseg">XX</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="">&nbsp;</label>
                <div class="col-md-5">
                    <div class="input-group">
                        <p>Rögzített érték: <span class="label label-default" id="cmenny">- <?=U_NAMES[U_STD][0]?></span></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="szlaszam">Számlaszám</label>
                <div class="col-md-5">
                    <input id="szlaszam" name="szlaszam" type="text" placeholder="2017/12345" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="szallitolevel">Szállítólevél szám</label>
                <div class="col-md-5">
                    <input id="szallitolevel" name="szallitolevel" type="text" placeholder="12345678" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="ekaer">EKÁER szám</label>
                <div class="col-md-5">
                    <input id="ekaer" name="ekaer" type="text" placeholder="12345678" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="cmr">CMR szám</label>
                <div class="col-md-5">
                    <input id="cmr" name="cmr" type="text" placeholder="12345678" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="fuvarozo">Fuvarozó</label>
                <div class="col-md-5">
                    <input id="fuvarozo" name="fuvarozo" type="text" placeholder="" class="form-control input-md">
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
                <label class="col-md-4 control-label" for="megj">Megjegyzés</label>
                <div class="col-md-5">
                    <textarea id="megj" name="megj" class="form-control input-md" rows="4"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="button1id"></label>
                <div class="col-md-8">
                    <input type="submit" id="button1id" name="button1id" class="btn btn-success" value="Rögzítés">
                </div>
            </div>

        </fieldset>
    </form>
    <script>
        $('#alapanyag').validate();
        $(document).ready(function () {
            btnClick($("#me_btn_<?=array_keys(U_NAMES)[0]?>"), '<?=U_NAMES[array_keys(U_NAMES)[0]][1]?>', '<?=U_FACT[array_keys(U_NAMES)[0]]?>');
        });
    </script>
    <?php } else { ?>
      <div class="alert alert-warning" role="alert">Faanyag eladást bevételezett készleten tud kezdeményezni. <a href="?mode=faanyag-keszlet">Válassza ki</a> a kívánt készlet tételt, és kattintson az <b>Eladás</b> gombra.</div>

    <?php }?>
