<form class="form-horizontal">
    <fieldset>

        <legend>Új lakossági megrendelés felvétele</legend>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Rendelést felvette</label>
            <div class="col-md-5">
                <input id="textinput" name="textinput" type="text" placeholder="név" class="form-control input-md">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="prependedcheckbox">Rendelést rögzítette</label>
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-addon">     
          <input type="checkbox">     
      </span>
                    <input id="prependedcheckbox" name="prependedcheckbox" class="form-control" type="text" placeholder="név">
                </div>
                <p class="help-block">csak papír alapú rendelés esetén</p>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Dátum</label>
            <div class="col-md-4">
                <input id="textinput" name="textinput" type="text" placeholder="éééé-hh-nn" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Ígért teljesítési határidő</label>
            <div class="col-md-4">
                <input id="textinput" name="textinput" type="text" placeholder="éééé-hh-nn" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> következő szabad időpont: 2016-09-11</div>
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Megrendelő neve</label>
            <div class="col-md-5">
                <input id="textinput" name="textinput" type="text" placeholder="név" class="form-control input-md">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Megrendelő címe</label>
            <div class="col-md-8">
                <input id="textinput" name="textinput" type="text" placeholder="irányítószám, helység, utca, házszám" class="form-control input-md">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Megrendelő telefonszáma</label>
            <div class="col-md-4">
                <input id="textinput" name="textinput" type="text" placeholder="+36 20 1234567" class="form-control input-md" required="">

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-default">Megrendelő adatainak másolása</button>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Kapcsolattartó neve</label>
            <div class="col-md-5">
                <input id="textinput" name="textinput" type="text" placeholder="név" class="form-control input-md">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Szállítási cím</label>
            <div class="col-md-8">
                <input id="textinput" name="textinput" type="text" placeholder="irányítószám, helység, utca, házszám" class="form-control input-md">

            </div>
        </div>



        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Kapcsolattartó telefonszáma</label>
            <div class="col-md-4">
                <input id="textinput" name="textinput" type="text" placeholder="+36 20 1234567" class="form-control input-md">

            </div>
        </div>
        <style>
            div#keszlet_filter {
                display: none;
            }
            
            img.leaf {
                height: 1em;
                margin-left: 2px;
            }
            
            img.leaf:hover {
                height: 2em;
                margin-left: 2px;
            }
        </style>

        <div class="jumbotron">
            <div class="form-group">
                <div class="col-md-4">
                    <strong>Elérhető készlet</strong>
                </div>
                <table id="keszlet" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Fafaj</th>
                            <th>Nedvesség</th>
                            <th>Hossz</th>
                            <th>Átmérő</th>
                            <th>Mennyiség</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>tölgy<img src="img/oak.png" class="leaf"></td>
                            <td><span class="glyphicon glyphicon-tint"></span></td>
                            <td>35-40 cm</td>
                            <td>10-13 cm</td>
                            <td>22 szórt űrméter</td>
                        </tr>
                        <tr>
                            <td>tölgy<img src="img/oak.png" class="leaf"></td>
                            <td><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span></td>
                            <td>35-40 cm</td>
                            <td>10-13 cm</td>
                            <td>4 szórt űrméter</td>
                        </tr>
                        <tr>
                            <td>akác<img src="img/acacia.png" class="leaf"></td>
                            <td><span class="glyphicon glyphicon-tint"></span></td>
                            <td>35-40 cm</td>
                            <td>10-13 cm</td>
                            <td>100 szórt űrméter</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <script>
            </script>


            <div class="form-group">
                <label class="col-md-4 control-label" for="selectbasic">Fafaj</label>
                <div class="col-md-4">
                    <select id="fafaj" name="selectbasic" class="form-control">
                        <option value="1">Akác</option>
                        <option value="2">Tölgy</option>
                        <option value="2">Gyertyán</option>
                        <option value="2">Bükk</option>
                        <option value="2">Cser</option>
                        <option value="2">Kőris</option>
                    </select>
                </div>
            </div>
            <script>
                var fun = function (e) {
                    document.mytable.search($("#fafaj option:selected").text()).draw();
                };

                $(document).ready(function () {
                    document.mytable = $('#keszlet').DataTable({
                        "language": {
                            "decimal": "",
                            "emptyTable": "Nincs adat",
                            "info": "Megjelenítve: _START_ és _END_ között, összesen _TOTAL_ adatsor",
                            "infoEmpty": "Nincs megjeleníthető adatsor",
                            "infoFiltered": "(_MAX_ adatsorból szűrve)",
                            "infoPostFix": "",
                            "thousands": ".",
                            "lengthMenu": "Show _MENU_ entries",
                            "loadingRecords": "Betöltés...",
                            "processing": "Feldolgozás...",
                            "search": "Keresés:",
                            "zeroRecords": "Nincs találat",
                            "paginate": {
                                "first": "First",
                                "last": "Last",
                                "next": "Next",
                                "previous": "Previous"
                            },
                            "aria": {
                                "sortAscending": ": activate to sort column ascending",
                                "sortDescending": ": activate to sort column descending"
                            }
                        },
                        "paging": false,
                        "info": false,
                        "searching": true,
                        "columns": [
                            {
                                "searchable": true,
                                "orderable": true
                            },
                            {
                                "searchable": false,
                                "orderable": true
                            },
                            {
                                "searchable": false,
                                "orderable": true
                            },
                            {
                                "searchable": false,
                                "orderable": true
                            },
                            {
                                "searchable": false,
                                "orderable": false
                            },
                        ]
                    });
                    fun();
                    $("#fafaj").on('change', fun);
                });
            </script>
            <!-- Appended Input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="appendedtext">Hossz</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input id="appendedtext" name="appendedtext" class="form-control" placeholder="tól - ig" type="text">
                        <span class="input-group-addon">cm</span>
                    </div>

                </div>
            </div>
            <!-- Appended Input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="appendedtext">Átmérő</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input id="appendedtext" name="appendedtext" class="form-control" placeholder="tól - ig" type="text">
                        <span class="input-group-addon">cm</span>
                    </div>

                </div>
            </div>
            <!-- Button Drop Down -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="buttondropdown">Mennyiség</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input id="buttondropdown" name="buttondropdown" class="form-control" placeholder="szám" type="text">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Csomagolás
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="#">ömlesztett</a></li>
                                <li><a href="#">hálós</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Multiple Radios -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="radios">Nedvességtartalom</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label for="radios-0">
                            <input type="radio" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 5em;">Száraz</span> <span class="glyphicon glyphicon-tint"></span>
                        </label>
                    </div>
                    <div class="radio">
                        <label for="radios-1">
                            <input type="radio" name="radios" id="radios-1" value="2"> <span style="display:inline-block;width: 5em;">Félszáraz</span> <span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                        </label>
                    </div>
                    <div class="radio">
                        <label for="radios-2">
                            <input type="radio" name="radios" id="radios-2" value="3"> <span style="display:inline-block;width: 5em;">Nedves</span> <span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textarea">Megjegyzés</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="textarea" name="textarea"></textarea>
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Hozzáadás a megrendeléshez</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <strong>Megrendelt tételek</strong>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fafaj</th>
                            <th>Hossz</th>
                            <th>Átmérő</th>
                            <th>Mennyiség</th>
                            <th>Nedvesség</th>
                            <th>Részösszeg</th>
                            <th>Művelet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td>Tölgy</td>
                            <td>35-40 cm</td>
                            <td>10-13 cm</td>
                            <td>2 szórt űrméter</td>
                            <td>Száraz</td>
                            <td>21.000 Ft</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>Akác</td>
                            <td>35-40 cm</td>
                            <td>10-13 cm</td>
                            <td>1 szórt űrméter</td>
                            <td>Száraz</td>
                            <td>14.000 Ft</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Appended Input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="appendedtext">Ár</label>
            <div class="col-md-4">
                <div class="input-group">
                    <input id="appendedtext" name="appendedtext" class="form-control" placeholder="-" type="text" value="35000">
                    <span class="input-group-addon">Ft</span>
                </div>

            </div>
        </div>
        <!-- Appended Input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="appendedtext">Szállítási költség</label>
            <div class="col-md-4">
                <div class="input-group">
                    <input id="appendedtext" name="appendedtext" class="form-control" placeholder="-" type="text" value="10000">
                    <span class="input-group-addon">Ft</span>
                </div>

            </div>
        </div>
        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textarea">Megjegyzés</label>
            <div class="col-md-4">
                <textarea class="form-control" id="textarea" name="textarea"></textarea>
            </div>
        </div>

        <!-- Button (Double) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="button1id"></label>
            <div class="col-md-8">
                <button id="button1id" name="button1id" class="btn btn-success">Rögzítés</button>
                <button id="button2id" name="button2id" class="btn btn-danger">Alaphelyzet</button>
            </div>
        </div>

    </fieldset>
</form>