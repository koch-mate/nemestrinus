<h1>Felhasználók kezelése</h1>

<table class="table table-striped table-hover display" id="users">
    <thead>
        <tr>
            <th>#</th>
            <th>Felhasználó</th>
            <th>Teljes név</th>
            <th>Jogosultság</th>
            <th>Jelszó</th>
            <th>E-mail cím</th>
            <th>Utolsó belépés dátuma</th>
            <th>Művelet</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(getUsersWithData() as $i){ ?>
            <tr <?=($i[ 'Aktiv'] ? '' : 'style="color:#bbb;"')?>>
                <td scope="row">
                    <?=$i['ID']?>
                </td>
                <td>
                    <?=$i['UserName']?>
                </td>
                <td>
                    <?=$i['TeljesNev']?>
                </td>
                <td>
                    <?php
    foreach(array_keys(RIGHTS) as $rk){
    ?>
                        <span class="label label-<?=(in_array($rk,unserialize($i['Jogok'])) ? 'primary' : 'default')?>" title="<?=RIGHTS[$rk][1]?>"><?=RIGHTS[$rk][0]?></span>
                        <?php    }?>
                </td>
                <td>
                    <button type="button" class="btn btn-xs btn-primary">Emlékeztető küldése</button>
                </td>
                <td>
                    <?=$i['Email']?>
                </td>
                <td>
                    <?=$i['LastLogin']?>
                </td>
                <td>
                    <button type="button" class="btn btn-xs btn-primary" onclick="window.location.href='?mode=felhasznalok&szerk=<?=$i['ID']?>#szerkesztes'">Szerkesztés</button>
                    <?php if($i['Aktiv']){ ?>
                        <button type="button" class="btn btn-xs btn-warning">Felfüggesztés</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-xs btn-warning">Engedélyezés</button>
                            <?php } ?>
                                <button type="button" class="btn btn-xs btn-danger">Törlés</button>
                </td>
            </tr>
            <?php } ?>
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

<?php

if(!empty($_POST['user'])){
    // TODO update user
    if(userExists($_POST['user'])){
        $failMessage = "Már van ilyen nevű felhasználó a rendszerben.";
    }
    else {
        $user = $_POST['user'];
        $tn = $_POST['teljes'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $r = [];
        foreach(array_keys(RIGHTS) as $rk){
            if(!empty($_POST['r_'.$rk])){
                array_push($r, $rk);
            }
        }
        $akt = !empty($_POST['aktiv']) ? 1 : 0;
        userAdd($user, $tn, $pass, $email, $r, $akt);
        $succMessage = "Az új felhasználó rögzítésre került.";
    }
    
    
}

?>
    <div class="jumbotron" style="margin-top:2em;">
        <form class="form-horizontal" id="userform" name="userform" method="post" action="/felhasznalok">
            <fieldset>
                <a name="szerkesztes"></a>
                <legend>Új felhasználó felvétele</legend>
                <?php 
                // if "szerkesztes" mode
                $ud = getUserDataById($_GET['szerk'])[0];
                if(!empty($ud)){?>
                    <input name="ID" id="id" type="hidden" value="<?=$_GET['szerk']?>">
                    <?php }
                
                include('lib/messages.php');
                ?>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Felhasználónév</label>
                            <div class="col-md-5">
                                <input id="user" name="user" <?=(!empty($ud) ? ' value="'.$ud[ 'UserName']. '"': '')?> type="text" placeholder="jancsi" class="form-control input-md" required minlength="4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Teljes név</label>
                            <div class="col-md-5">
                                <input id="teljes" name="teljes" type="text" <?=(!empty($ud) ? ' value="'.$ud[ 'TeljesNev']. '"': '')?> placeholder="Kovács János" class="form-control input-md" required minlength="6">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Jelszó</label>
                            <div class="col-md-5">
                                <input id="pass" name="pass" required minlength="6" type="password" placeholder="" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="alert alert-info">
                                    <?=(!empty($ud) ? 'A mezőt üresen hagyva nem változik meg a felhasználó jelszava. A mező kitöltése esetén a jelszó megváltozik, a felhasználó pedig e-mail értesítést kap.':'Regisztráció után az új felhasználó e-mail értesítést kap a bejelentkezési adatairól.')?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">E-mail cím</label>
                            <div class="col-md-5">
                                <input id="email" name="email" type="text" <?=(!empty($ud) ? ' value="'.$ud[ 'Email']. '"': '')?> placeholder="kjanos@ihartu.hu" class="form-control input-md" type="email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes">Jogosultság</label>
                            <div class="col-md-4">
                                <?php
                foreach(array_keys(RIGHTS) as $rk){
?>
                                    <div class="checkbox">
                                        <label for="r_<?=$rk?>">
                                            <input type="checkbox" name="r_<?=$rk?>" id="r_<?=$rk?>" value="1" <?=(!empty($ud) ? (in_array($rk, unserialize($ud[ 'Jogok']))? ' checked="checked" ': ''): '')?>><span class="label label-primary"><?=RIGHTS[$rk][0]?></span>
                                            <?=RIGHTS[$rk][1]?>
                                        </label>
                                    </div>
                                    <?php
                }
?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes">Státusz</label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="aktiv">
                                        <input type="checkbox" name="aktiv" id="aktiv" value="1" <?=(empty($ud) || intval($ud[ 'Aktiv'])==1 ? ' checked="checked"': '')?>>Aktív</label>
                                </div>
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
            $('#userform').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });
        </script>
    </div>