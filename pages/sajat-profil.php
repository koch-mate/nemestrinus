<?php

if(!empty($_POST['curr_pass'])){
    if(userUpdatePassword($_POST['curr_pass'], $_POST['new_pass1'])) {
        $succMessage = 'A jelszó frissítésre került.';
    }
    else {
        $failMessage = 'Hibás jelszó.';
    }
}

?>
    <h1>Személyes beállítások</h1>

    <?php if(!empty($succMessage)){ ?>
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-glyphicon-ok" aria-hidden="true"></span>
            <?=$succMessage?>
        </div>
        <?php } ?>
            <?php if(!empty($failMessage)){ ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <?=$failMessage?>
                </div>
                <?php } ?>

                    <div class="jumbotron">
                        <form class="form-horizontal" name="passwordform" id="passwordform" method="post" action="?mode=szemelyes-beallitasok">
                            <fieldset>

                                <legend>Adatok</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Teljes név</label>
                                    <div class="col-md-5">
                                        <?=getUserFullName($_SESSION['userName'])?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">E-mail cím</label>
                                    <div class="col-md-5">
                                        <?=getUserEmail($_SESSION['userName'])?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Legutolsó bejelentkezés</label>
                                    <div class="col-md-5">
                                        <?=getUserLastLogin($_SESSION['userName'])?>
                                    </div>
                                </div>
                                <legend>Jelszóváltoztatás</legend>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="curr_pass">Aktuális jelszó</label>
                                    <div class="col-md-5">
                                        <input id="curr_pass" name="curr_pass" type="password" placeholder="" class="form-control input-md" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="new_pass1">Új jelszó</label>
                                    <div class="col-md-5">
                                        <input id="new_pass1" name="new_pass1" type="password" placeholder="" class="form-control input-md" required minlength="6">
                                    </div>
                                </div>

                                <div class="form-group" id="pass2">
                                    <label class="col-md-4 control-label" for="new_pass2">Új jelszó megerősítése</label>
                                    <div class="col-md-5">
                                        <input id="new_pass2" name="new_pass2" type="password" placeholder="" class="form-control input-md" required minlength="6">
                                    </div>
                                </div>


                                <div class="form-group has-error has-feedback">
                                    <label class="col-md-4 control-label" for="button1id"></label>
                                    <div class="col-md-8">
                                        <input id="button1id" type="submit" name="button1id" class="btn btn-success" value="Rögzítés">
                                    </div>
                                </div>

                                <script>
                                    $("#passwordform").validate({
                                        rules: {
                                            new_pass1: "required",
                                            new_pass2: {
                                                equalTo: "#new_pass1"
                                            }
                                        }
                                    });
                                </script>

                            </fieldset>
                        </form>
                    </div>