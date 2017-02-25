<?php

if(isset($_POST['r_cs'])){
    packagingAdd( $_POST['r_cs'], $_POST['mennyiseg'], $_POST['szlaszam'], $_POST['datum'], $_POST['megj'], FORGALOM_BEVETEL );
    logEv(LOG_EVENT['packaging_add'].':',null,implode(', ',[CSOMAGOLOANYAGOK[$_POST['r_cs']][0], $_POST['mennyiseg'].CSOMAGOLOANYAGOK[$_POST['r_cs']][1], $_POST['szlaszam'], $_POST['datum']]));
    $succMessage = "Rögzítve.";
}

include('lib/messages.php');
?>
    <h2>Csomagoló alapanyagok bevételezése</h2>
    <div class="jumbotron">


        <form class="form-horizontal" id="csom" name="csom" method="post" action="/?mode=csomagoloanyag-bevitel">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="checkboxes">Csomagolóanyag</label>
                    <div class="col-md-4">
                        <?php
                packagingRadioButtons();
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
            $('#csom').validate();
        </script>
    </div>