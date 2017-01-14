<h1>Felhasználók kezelése</h1>

<table class="table table-striped table-hover display" id="users">
    <thead>
        <tr>
            <th>#</th>
            <th>Név</th>
            <th>Jogosultság</th>
            <th>Jelszó</th>
            <th>E-mail cím</th>
            <th>Utolsó belépés dátuma</th>
            <th>Művelet</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">1</td>
            <td>Példa Pál</td>
            <td>
                <span class="label label-primary" title="Megrendelés">M</span>
                <span class="label label-primary" title="Fakitermelés">F</span>
                <span class="label label-primary" title="Gyártás">Gy</span>
                <span class="label label-primary" title="Szállítás">Sz</span>
                <span class="label label-default" title="Kimutatás">K</span>
                <span class="label label-default" title="Adminisztráció">A</span>
            </td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Emlékeztető küldése</button>
            </td>
            <td>pp@ihartu.hu</td>
            <td>2016-01-12</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                <button type="button" class="btn btn-xs btn-warning">Felfüggesztés</button>
                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
            </td>
        </tr>
        <tr style="color:#bbb;">
            <td scope="row">2</td>
            <td>Telepvezető János <span class="label label-default">INAKTÍV</span></td>
            <td>
                <span class="label label-default" title="Megrendelés">M</span>
                <span class="label label-primary" title="Fakitermelés">F</span>
                <span class="label label-primary" title="Gyártás">Gy</span>
                <span class="label label-default" title="Szállítás">Sz</span>
                <span class="label label-default" title="Kimutatás">K</span>
                <span class="label label-default" title="Adminisztráció">A</span>
            </td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Emlékeztető küldése</button>
            </td>
            <td>tv@ihartu.hu</td>
            <td>2016-09-24</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                <button type="button" class="btn btn-xs btn-warning">Engedélyezés</button>
                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
            </td>
        </tr>
        <tr>
            <td scope="row">3</td>
            <td>Admin Péter</td>
            <td>
                <span class="label label-primary" title="Megrendelés">M</span>
                <span class="label label-primary" title="Fakitermelés">F</span>
                <span class="label label-primary" title="Gyártás">Gy</span>
                <span class="label label-primary" title="Szállítás">Sz</span>
                <span class="label label-primary" title="Kimutatás">K</span>
                <span class="label label-primary" title="Adminisztráció">A</span>
            </td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Emlékeztető küldése</button>
            </td>
            <td>ap@ihartu.hu</td>
            <td>2016-05-01</td>
            <td>
                <button type="button" class="btn btn-xs btn-primary">Szerkesztés</button>
                <button type="button" class="btn btn-xs btn-warning">Felfüggesztés</button>
                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
            </td>
        </tr>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#users').DataTable({
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
            "info": true,
            "columns": [
                {
                    "searchable": false
                },
                null,
                {
                    "searchable": false,
                    "orderable": false
                },
                {
                    "searchable": false,
                    "orderable": false
                },
                null,
                {
                    "searchable": false
                },
                {
                    "searchable": false,
                    "orderable": false,
                }
            ]


        });
    });
</script>
<div class="jumbotron" style="margin-top:2em;">
    <form class="form-horizontal">
        <fieldset>

            <legend>Új felhasználó felvétele</legend>

            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Név</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="név" class="form-control input-md">
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
                    <div class="alert alert-info">A regisztráció után az új felhasználó e-mail értesítést kap a bejelentkezési adatairól.</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">E-mail cím</label>
                <div class="col-md-5">
                    <input id="textinput" name="textinput" type="text" placeholder="asdf@ihartu.hu" class="form-control input-md">
                </div>
            </div>

            <!-- Multiple Checkboxes -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes">Jogosultság</label>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label for="checkboxes-1">
                            <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><span class="label label-primary">M</span> Megrendelés</label>
                    </div>
                    <div class="checkbox">
                        <label for="checkboxes-1">
                            <input type="checkbox" name="checkboxes" id="checkboxes-1" value="1"><span class="label label-primary">F</span> Fakitermelés</label>
                    </div>
                    <div class="checkbox">
                        <label for="checkboxes-2" class="checkbox-custom">
                            <input type="checkbox" name="checkboxes" id="checkboxes-2" value="1"><span class="label label-primary">Gy</span> Gyártás</label>
                    </div>
                    <div class="checkbox">
                        <label for="checkboxes-3">
                            <input type="checkbox" name="checkboxes" id="checkboxes-3" value="1"><span class="label label-primary">Sz</span> Szállítás</label>
                    </div>
                    <div class="checkbox">
                        <label for="checkboxes-4">
                            <input type="checkbox" name="checkboxes" id="checkboxes-4" value="1"><span class="label label-primary">K</span> Kimutatások</label>
                    </div>
                    <div class="checkbox">
                        <label for="checkboxes-5">
                            <input type="checkbox" name="checkboxes" id="checkboxes-5" value="1"><span class="label label-primary">A</span> Adminisztráció</label>
                    </div>
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