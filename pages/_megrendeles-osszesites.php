<h1>Lakossági megrendelések összesítése</h1>

<div class="jumbotron">
    <form class="form-horizontal">
        <fieldset>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rendelés dátuma (tól)</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="éééé-hh-nn" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Rendelés dátuma (ig)</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="éééé-hh-nn" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="button1id"></label>
                <div class="col-md-8">
                    <button id="button1id" name="button1id" class="btn btn-success">Lekérdezés</button>
                    <button id="button2id" name="button2id" class="btn btn-danger">Alaphelyzet</button>
                </div>
            </div>


        </fieldset>
    </form>
</div>
<h3>Kiválasztott időszak: 2016-09-01 - 2016-11-01</h3>

<h4>Rendelések státusz szerint</h4>
<p>A megadott időszakban <b>231 megrendelés</b> került rögzítésre</p>
<p>
    <span class="label label-primary" style="width:10em;display:inline-block;">Gyártásra vár</span> 100 megrendelés
    <br>
    <span class="label label-info" style="width:10em;display:inline-block;">Gyártás alatt</span> 80 megrendelés
    <br>
    <span class="label label-warning" style="width:10em;display:inline-block;">Szállításra vár</span> 14 megrendelés
    <br>
    <span class="label label-success" style="width:10em;display:inline-block;">Teljesítve</span> 30 megrendelés
    <br>
    <span class="label label-danger" style="width:10em;display:inline-block;">Lemondva</span> 4 megrendelés
    <br>
</p>
<div class="progress">
    <div class="progress-bar progress-bar-primary" style="width: 25%">
        25% </div>
    <div class="progress-bar progress-bar-info" style="width: 35%">
        35% </div>
    <div class="progress-bar progress-bar-warning" style="width: 20%">
        20% </div>
    <div class="progress-bar progress-bar-success" style="width: 10%">
        10% </div>
    <div class="progress-bar progress-bar-danger" style="width: 10%">
        10% </div>
</div>

<h4>Határidőre történő teljesítések</h4>
<p>
    <span class="label label-primary" style="width:10em;display:inline-block;">Függő - időben</span> 100 megrendelés
    <br>
    <span class="label label-warning" style="width:10em;display:inline-block;">Függő - késésben</span> 14 megrendelés
    <br>
    <span class="label label-success" style="width:10em;display:inline-block;">Teljesítve - időben</span> 30 megrendelés
    <br>
    <span class="label label-danger" style="width:10em;display:inline-block;">Teljesítve - késve</span> 4 megrendelés
    <br>
</p>
<div class="progress">
    <div class="progress-bar progress-bar-default" style="width: 25%">
        25% </div>
    <div class="progress-bar progress-bar-warning" style="width: 20%">
        20% </div>
    <div class="progress-bar progress-bar-success" style="width: 40%">
        40% </div>
    <div class="progress-bar progress-bar-danger" style="width: 15%">
        15% </div>
</div>

<h4>Kifizetések</h4>
<p>
    <span class="label label-primary" style="width:15em;display:inline-block;">Függő kifizetések</span> 450.200 Ft
    <br>
    <span class="label label-success" style="width:15em;display:inline-block;">Teljesült kifizetések</span> 923.000 Ft
    <br>
</p>
<div class="progress">
    <div class="progress-bar progress-bar-default" style="width: 33%">
        33% </div>
    <div class="progress-bar progress-bar-success" style="width: 67%">
        67% </div>
</div>