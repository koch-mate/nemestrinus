<?php

if(!empty($_POST['cmennyiseg'])){
    woodAdd($_POST['r_cs'], -$_POST['cmennyiseg'], null, $_POST['szlaszam'], null, $_POST['datum'], $_POST['megj'], FORGALOM_KIADAS, 'ekaer', 'cmr', 'fuvarozo');
    logEv(LOG_EVENT['wood_sell'].':',null,implode(', ',[FATIPUSOK[$_POST['r_cs']][0], $_POST['cmennyiseg'].' '.U_NAMES[U_STD][0], $_POST['szlaszam'], $_POST['datum']]));
    $succMessage = "Rögzítve.";
}

include('lib/popups.php');

woodJsUnitConversion();
?>


    <h2>Alapanyagok eladása</h2>
    <div class="jumbotron">

        <form class="form-horizontal" id="csom" name="alapanyag" method="post" action="/?mode=faanyag-kiadas">
            <fieldset>
                <div class="alert alert-info" role="alert">Faanyag egyedi értékesítése esetén használandó. A gyártás során történő felhasználást a gyártás menü alatt kell rögzíteni.</div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkboxes">Fafaj</label>
                    <div class="col-md-4">
                        <?php
                               woodTypesRadioButtons();

?>
                    </div>
                </div>

            <input type="hidden" id="cmennyiseg" name="cmennyiseg" value="0">
            <div class="form-group">
                <label class="col-md-4 control-label" for="mennyiseg">Mennyiség</label>
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
                        <input id="mennyiseg" name="mennyiseg" class="form-control" placeholder="-" type="number" required onchange="recalc()" onkeyup="recalc();">
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
</div>
