<?php

if(!empty($_POST['cmennyiseg'])){
    woodAdd($_POST['r_cs'], $_POST['cmennyiseg'], $_POST['beszallito'], $_POST['szlaszam'], $_POST['szallitolevel'], $_POST['datum'], $_POST['megj'], FORGALOM_BEVETEL, $_POST['ekaer'], $_POST['cmr'], $_POST['fuvarozo'], $_POST['knkod'], $_POST['import'], $_POST['kitermeles']);
    logEv(LOG_EVENT['wood_add'].':',null,implode(', ',[FATIPUSOK[$_POST['r_cs']][0], $_POST['cmennyiseg'].' '.U_NAMES[U_STD][0], getSupplierNameById($_POST['beszallito']), $_POST['szlaszam'], $_POST['szallitolevel'], $_POST['ekaer'], $_POST['cmr'], $_POST['fuvarozo'], $_POST['datum'], $_POST['knkod'], $_POST['import'], $_POST['kitermeles']]));
    $succMessage = "Rögzítve.";
}

include('lib/popups.php');

woodJsUnitConversion();

?>

<h2>Alapanyag bevételezése</h2>


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
                    <input id="fuvarozo" name="fuvarozo" type="text" placeholder="Kiss Jónás" class="form-control input-md">
                </div>
            </div>
            <div class="form-group" id="beszform">
                <label class="col-md-4 control-label" for="beszallito">Beszállító</label>
                <div class="col-md-5">
                    <select name="beszallito" class="selectpicker" id="besz" data-live-search="true" >
                      <?php
                      $suppList = suppliersGetList();
                      $ihartuID = 0;
                      foreach($suppList as $b){
                        if($b['Cegnev'] == 'Ihartü'){
                          $ihartuID = $b['ID'];
                          break;
                        }
                      }
                      ?>

                      <optgroup label="Saját kitermelés">
                          <option value="<?=$ihartuID?>">Ihartü</option>
                      </optgroup>
                      <optgroup label="Külső cég">
                          <?php
                          foreach($suppList as $b){
                            if($b["ID"]==$ihartuID){
                              continue;
                            }
                              ?>
                          <option value="<?=$b['ID']?>"><?=$b['Cegnev']?></option>
                          <?php
                          }
                          ?>
                      </optgroup>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="knkod">KN kód szerinti választék</label>
                <div class="col-md-5">
                    <input id="knkod" name="knkod" type="text" placeholder="12345678" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="kitermeles">Kitermelés helye</label>
                <div class="col-md-5">
                    <input id="kitermeles" name="kitermeles" type="text" placeholder="Libickozma" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="import">Import esetén származást igazoló dokumentumok azonosítói</label>
                <div class="col-md-5">
                    <input id="import" name="import" type="text" placeholder="12345678" class="form-control input-md">
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
