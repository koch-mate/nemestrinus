<h1>Export megrendelők kezelése</h1>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Cégnév</th>
            <th>Képviselő</th>
            <th>Adószám</th>
            <th>Telefonszám</th>
            <th>Fax</th>
            <th>E-mail</th>
            <th>Szállítási cím</th>
            <th>Számlázási cím</th>
            <th>Jelszó</th>
            <th>Utolsó bejelentkezés dátuma</th>
            <th>Művelet</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">1</td>
            <td>Brennstoffe Haring</td>
            <td>Laci</td>
            <td>12345986</td>
            <td>12-123-12345</td>
            <td>12-123-12346</td>
            <td><a href="mailto:">asdf@asdfg.hu</a></td>
            <td>1234 Karcag, Lajos utca 2.</td>
            <td>1234 Karcag, Elem utca 1.</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Emlékeztető
                    <br>küldése</button>
            </td>
            <td>2016-12-12</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                <button type="button" class="btn btn-xs btn-warning">Felfüggesztés</button>
                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
            </td>
        </tr>
        <tr style="color:#bbb;">
            <td scope="row">2</td>
            <td>Tommaso Pizzeria <span class="label label-default">INAKTÍV</span></td>
            <td>Kovacs Tamas</td>
            <td>12345986</td>
            <td>12-123-12345</td>
            <td>12-123-12346</td>
            <td><a href="mailto:">asdf@asdfg.hu</a></td>
            <td>1234 Karcag, Lajos utca 2.</td>
            <td>1234 Karcag, Elem utca 1.</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Emlékeztető
                    <br>küldése</button>
            </td>
            <td>2016-12-12</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                <button type="button" class="btn btn-xs btn-warning">Felfüggesztés</button>
                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
            </td>

        </tr>
        <tr>
            <td scope="row">3</td>
            <td>Grand Hotel, Milano</td>
            <td>Verdi</td>
            <td>12345986</td>
            <td>12-123-12345</td>
            <td>12-123-12346</td>
            <td><a href="mailto:">asdf@asdfg.hu</a></td>
            <td>1234 Karcag, Lajos utca 2.</td>
            <td>1234 Karcag, Elem utca 1.</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Emlékeztető
                    <br>küldése</button>
            </td>
            <td>2016-12-12</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                <button type="button" class="btn btn-xs btn-warning">Felfüggesztés</button>
                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
            </td>

        </tr>
    </tbody>
</table>
<div class="jumbotron">
    <form class="form-horizontal">
        <fieldset>

            <legend>Új export megrendelő felvétele</legend>

            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Cégnév</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="név" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Képviselő</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="név" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Adószám</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="1234567" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Telefonszám</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="(123) 23 1234-123" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Fax</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="(123) 23 1234-123" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">E-mail cím</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="asdf@example.com" class="form-control input-md">
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Jelszó</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="password" placeholder="" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class="alert alert-info">A regisztráció után a megrendlő e-mail értesítést kap a bejelentkezési adatairól.</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Számlázási cím</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="IT, Milano, Via Tazzoli 11. " class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Szállítási cím</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="IT, Milano, Via Tazzoli 11. " class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes">Státusz</label>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label for="checkboxes-0">
                            <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1" checked="checked">Engedélyezett</label>
                    </div>
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