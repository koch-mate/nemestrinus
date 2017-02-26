<h1>Lakossági megrendelések áttekintése</h1>
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
                <label class="col-md-4 control-label" for="radios">Fafaj</label>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">Akác <img src="img/acacia.png" class="zoom" style="height:1em;margin-right:2px;"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">Bükk <img src="img/beech.png" style="height:1em;margin-right:2px;"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">Cser <img src="img/turkey_oak.png" style="height:1em;margin-right:2px;"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">Gyertyán <img src="img/hornbeam.png" style="height:1em;margin-right:2px;"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">Kőris <img src="img/ash.png" style="height:1em;margin-right:2px;"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">Tölgy <img src="img/oak.png" style="height:1em;margin-right:2px;"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="radios">Státusz</label>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">gyártásra vár</span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">gyártás alatt</span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">szállításra vár</span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">teljesítve</span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="radios-0">
                            <input type="checkbox" name="radios" id="radios-0" value="1" checked="checked"> <span style="display:inline-block;width: 7em;">lemondva</span>
                        </label>
                    </div>

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
</div>
<div class="container-fluid">

    <div class="starter-template">

        <style>
            td {
                white-space: nowrap;
            }
            
            table.dataTable {
                border-collapse: collapse;
            }
            
            table.dataTable thead .sorting_asc,
            table.dataTable thead .sorting,
            table.dataTable thead .sorting_desc {
                background-position: 100% 75%;
            }
        </style>

        <table id="keszlet" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Státusz</th>
                    <th>Megrendelő</th>
                    <th>Telefonszám</th>
                    <th>Kapcsolattartó</th>
                    <th>Telefonszám</th>
                    <th>Szállítási cím</th>
                    <th>Fafaj</th>
                    <th>Nedvesség</th>
                    <th>Hossz</th>
                    <th>Átmérő</th>
                    <th>Mennyiség</th>
                    <th>Ár</th>
                    <th>Fuvardíj</th>
                    <th>Rendelés dátuma</th>
                    <th>Ígért szállítási határidő</th>
                    <th>Tényleges szállítási határidő</th>
                    <th>Fizetve</th>
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>00001</td>
                    <td><span class="label label-info">Gyártás alatt</span></td>
                    <td>Kiss Miklós</td>
                    <td>21/1234567</td>
                    <td>Kun Béla</td>
                    <td>12/34567789</td>
                    <td>1234 Kiskunhalas,
                        <br>Kossuth utca 123.</td>
                    <td><img src="img/oak.png" style="height:1em;margin-right:2px;">tölgy
                        <br><img src="img/beech.png" style="height:1em;margin-right:2px;">bükk</td>
                    <td><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                        <br><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span></td>
                    <td>25-40 cm
                        <br>12-15 cm</td>
                    <td>11-13 cm
                        <br>22-30 cm</td>
                    <td>2 szórt űrméter
                        <br>1 szórt űrméter</td>
                    <td>21.000 Ft</td>
                    <td>5.000 Ft</td>
                    <td>2016-06-10</td>
                    <td>2016-10-10</td>
                    <td>2016-10-10</td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                        <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                    </td>
                </tr>
                <tr>
                    <td>00002</td>
                    <td><span class="label label-info">Gyártás alatt</span></td>
                    <td>Kovacs Aladar</td>
                    <td>21/1234567</td>
                    <td>-</td>
                    <td>-</td>
                    <td>1122 Budapset,
                        <br>Kaposvari u. 44/b</td>
                    <td><img src="img/turkey_oak.png" style="height:1em;margin-right:2px;">cser</td>
                    <td><span style="display:none;">1</span><span class="glyphicon glyphicon-tint"></span></td>
                    <td>25-40 cm</td>
                    <td>11-13 cm</td>
                    <td>2 szórt űrméter</td>
                    <td>11.000 Ft</td>
                    <td>6.000 Ft</td>
                    <td>2016-10-12</td>
                    <td>2016-10-12</td>
                    <td>2016-10-12</td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                        <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                    </td>
                </tr>
                <tr>
                    <td>00003</td>
                    <td><span class="label label-warning">Szállításra vár</span></td>
                    <td>Mezga Geza</td>
                    <td>21/1234567</td>
                    <td>Kun Béla</td>
                    <td>12/34567789</td>
                    <td>1234 Kiskunhalas,
                        <br>Kossuth utca 123.</td>
                    <td><img src="img/acacia.png" style="height:1em;margin-right:2px;">akác
                        <br><img src="img/ash.png" style="height:1em;margin-right:2px;">kőris</td>
                    <td><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                        <br><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span></td>
                    <td>25-40 cm
                        <br>12-15 cm</td>
                    <td>11-13 cm
                        <br>22-30 cm</td>
                    <td>2 szórt űrméter
                        <br>1 szórt űrméter</td>
                    <td>21.000 Ft</td>
                    <td>5.000 Ft</td>
                    <td>2016-10-10</td>
                    <td>2016-10-10</td>
                    <td>2016-10-10</td>
                    <td><span class="glyphicon glyphicon-ok"></span></td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                        <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                    </td>
                </tr>
                <tr>
                    <td>00004</td>
                    <td><span class="label label-danger">Lemondva</span></td>
                    <td>Toth Eleonora</td>
                    <td>34/24345367</td>
                    <td>Kun Béla</td>
                    <td>12/34567789</td>
                    <td>1234 Kiskunhalas,
                        <br>Kossuth utca 123.</td>
                    <td><img src="img/oak.png" style="height:1em;margin-right:2px;">tölgy
                        <br><img src="img/beech.png" style="height:1em;margin-right:2px;">bükk</td>
                    <td><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                        <br><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span></td>
                    <td>25-40 cm
                        <br>12-15 cm</td>
                    <td>11-13 cm
                        <br>22-30 cm</td>
                    <td>2 szórt űrméter
                        <br>1 szórt űrméter</td>
                    <td>21.000 Ft</td>
                    <td>5.000 Ft</td>
                    <td>2016-10-10</td>
                    <td>2016-10-10</td>
                    <td>2016-10-10</td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                        <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                    </td>
                </tr>
                <tr>
                    <td>00005</td>
                    <td><span class="label label-success">Teljesítve</span></td>
                    <td>Kiss Miklós</td>
                    <td>21/1234567</td>
                    <td>Kun Béla</td>
                    <td>12/34567789</td>
                    <td>1234 Kiskunhalas,
                        <br>Kossuth utca 123.</td>
                    <td><img src="img/oak.png" style="height:1em;margin-right:2px;">tölgy
                        <br><img src="img/beech.png" style="height:1em;margin-right:2px;">bükk</td>
                    <td><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span>
                        <br><span style="display:none;">2</span><span class="glyphicon glyphicon-tint"></span><span class="glyphicon glyphicon-tint"></span></td>
                    <td>25-40 cm
                        <br>12-15 cm</td>
                    <td>11-13 cm
                        <br>22-30 cm</td>
                    <td>2 szórt űrméter
                        <br>1 szórt űrméter</td>
                    <td>21.000 Ft</td>
                    <td>5.000 Ft</td>
                    <td>2016-10-10</td>
                    <td>2016-10-10</td>
                    <td>2016-10-10</td>
                    <td><span class="glyphicon glyphicon-ok"></span></td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                        <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                    </td>
                </tr>

            </tbody>
        </table>



        <script>
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
                        "search": "Gyorskeresés:",
                        "zeroRecords": "Nincs találat",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": "Next",
                            "previous": "Previous"
                        },
                        "aria": {
                            "sortAscending": ": rendezés csökkenő sorba",
                            "sortDescending": ": rendezés növekvő sorba"
                        }
                    },
                    "paging": false,
                    "info": false,
                    "searching": true
                });
            });
        </script>