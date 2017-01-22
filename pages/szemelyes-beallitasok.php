<h1>Személyes beállítások</h1>

<div class="jumbotron">
    <form class="form-horizontal">
        <fieldset>

            <legend>Adatok</legend>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Teljes név</label>
                <div class="col-md-5">
                    <?=getUserFullName($_SESSION['userName'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">E-mail cím</label>
                <div class="col-md-5">
                    <?=getUserEmail($_SESSION['userName'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Legutolsó bejelentkezés</label>
                <div class="col-md-5">
                    <?=getUserLastLogin($_SESSION['userName'])?>
                </div>
            </div>
            <legend>Jelszóváltoztatás</legend>

            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Aktuális jelszó</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="password" placeholder="" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Új jelszó</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="password" placeholder="" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Új jelszó megerősítése</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="password" placeholder="" class="form-control input-md">
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label" for="button1id"></label>
                <div class="col-md-8">
                    <button id="button1id" name="button1id" class="btn btn-success">Rögzítés</button>
                    <button id="button2id" name="button2id" class="btn btn-danger">Alaphelyzet</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>