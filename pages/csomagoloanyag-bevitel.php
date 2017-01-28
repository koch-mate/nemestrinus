<?php

if(isset($_POST['r_cs'])){
    packagingAdd( $_POST['r_cs'], $_POST['mennyiseg'], $_POST['szlaszam'], $_POST['datum'], $_POST['megj'] );
    logEv(LOG_EVENT['packaging_add'].':',null,implode(', ',[CSOMAGOLOANYAGOK[$_POST['r_cs']][0], $_POST['mennyiseg'].CSOMAGOLOANYAGOK[$_POST['r_cs']][1], $_POST['szlaszam'], $_POST['datum']]));
    $succMessage = "Rögzítve.";
}

include('lib/messages.php');
?>

    <form class="form-horizontal" id="csom" name="csom" method="post" action="/?mode=csomagoloanyag-bevitel">
        <fieldset>
            <legend>
                Csomagoló alapanyagok bevételezése
            </legend>
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes">Csomagolóanyag</label>
                <div class="col-md-4">
                    <?php
                foreach(array_keys(CSOMAGOLOANYAGOK) as $rk){
?>
                        <div class="radio">
                            <label for="r_cs_<?=$rk?>">
                                <input type="radio" onclick=" $('#menny_me').html('<?=CSOMAGOLOANYAGOK[$rk][1]?>');" name="r_cs" id="r_cs_<?=$rk?>" value="<?=$rk?>" <?=($rk==array_keys(CSOMAGOLOANYAGOK)[0]? ' checked="checked"': '')?> >
                                <span style="width: 6em; display:inline-block;"><img src="/img/<?=$rk?>.png" title="<?=CSOMAGOLOANYAGOK[$rk][0]?>" style="height:3em;" /></span>
                                <?=CSOMAGOLOANYAGOK[$rk][0]?>
                            </label>
                        </div>
                        <?php
                }
?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="mennyiseg">Mennyiség</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input id="mennyiseg" name="mennyiseg" class="form-control" placeholder="123" required type="number">
                        <span class="input-group-addon" id="menny_me"><?=CSOMAGOLOANYAGOK[array_keys(CSOMAGOLOANYAGOK)[0]][1]?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="szlaszam">Bevételi számlaszám</label>
                <div class="col-md-5">
                    <input id="szlaszam" name="szlaszam" type="text" placeholder="2017/12345" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="datum">Dátum</label>
                <div class="col-md-5">
                    <input id="datum" name="datum" type="dateISO" required placeholder="éééé-hh-nn" class="form-control input-md" value="<?=date('Y-m-d')?>">
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
        $('#csom').validate();
    </script>