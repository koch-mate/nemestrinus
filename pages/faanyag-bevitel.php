<?php

if(!empty($_POST['cmennyiseg'])){
    woodAdd($_POST['r_cs'], $_POST['cmennyiseg'], ($_POST['beszallito'] == '__uj__' ? $_POST['ujbeszallito'] : $_POST['beszallito']), $_POST['szlaszam'], $_POST['szallitolevel'], $_POST['datum'], $_POST['megj']);
    logEv(LOG_EVENT['wood_add'].':',null,implode(', ',[FATIPUSOK[$_POST['r_cs']][0], $_POST['cmennyiseg'].' '.U_NAMES[U_STD][0], ($_POST['beszallito'] == '__uj__' ? $_POST['ujbeszallito'] : $_POST['beszallito']), $_POST['szlaszam'], $_POST['szallitolevel'], $_POST['datum']]));  
    $succMessage = "Rögzítve.";
}

include('lib/messages.php');
?>

<h2>Alapanyag bevételezése</h2>

<script>
    var factor = 1.0;

    function btnClick(btn, txt, fact) {
        <?php foreach(array_keys(U_NAMES) as $un){?>
        $('#me_btn_<?=$un?>').removeClass().addClass('btn btn-default');
        <?php } ?>
        btn.addClass('btn-primary');
        $("#mertekegyseg").html(txt);
        factor = fact;
        recalc();
    }

    function recalc() {
        cval = parseFloat($('#mennyiseg').val()) / factor;
        if (isNaN(cval)) {
            cval = 0;
        }
        $("#cmenny").html('' + Math.round(cval * 100) / 100.0 + ' <?=U_NAMES[U_STD][0]?>');
        $("#cmennyiseg").val(Math.round(cval * 100) / 100.0);
    }
</script>
<div class="jumbotron">

    <form class="form-horizontal" id="alapanyag" name="alapanyag" method="post" action="/?mode=faanyag-bevitel">
        <fieldset>
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
                <label class="col-md-4 control-label" for="szallitolevel">Szállítólevél szám</label>
                <div class="col-md-5">
                    <input id="szallitolevel" name="szallitolevel" type="text" placeholder="12345678" class="form-control input-md">
                </div>
            </div>
            <div class="form-group" id="beszform">
                <label class="col-md-4 control-label" for="beszallito">Beszállító</label>
                <div class="col-md-5">
                    <select name="beszallito" class="selectpicker" id="besz" data-live-search="true" onchange="if($('#besz').val()=='__uj__'){$('#besz').parent().hide();$('#beszUj').show();}">
                        <optgroup label="Saját kitermelés">
                            <option value="Ihartü">Ihartü</option> 
                        </optgroup>
                        <optgroup label="Külső cég">  <?php // FIXME - get list of real names ?>
                            <option value="Lenti">Lenti</option>
                            <option value="Nagykanizsa">Nagykanizsa</option>
                            <option data-content="<em>&lt;Új beszállító&gt;</em>" value="__uj__">&lt;Új beszállító&gt;</option>
                        </optgroup>
                    </select>
                    <div class="input-group" id="beszUj" style="display:none;">
                        <input type="text" class="form-control" name="ujbeszallito" placeholder="új beszállító" required>
                        <span class="input-group-btn"><button class="btn btn-default" type="button" onclick="$('#besz').parent().show();$('#beszUj').hide();$('#besz').selectpicker('val', 'Ihartü');$('#besz').selectpicker('toggle');$('#beszform').removeClass('has-error');$('#ujbeszallito-error').hide()">Mégsem</button></span>
                    </div>
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