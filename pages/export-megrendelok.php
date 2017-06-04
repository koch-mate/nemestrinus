<?php

if(isset($_GET['deluser'])){
    // delete user
    $user = exportCustomerGetNameById($_GET['deluser']);
    exportCustomerDelete($_GET['deluser']);
    logEv(LOG_EVENT['del_export_customer'].' ('.$user.')', null, null);
    $succMessage = 'A(z) <em>'.$user.'</em> megrendelő törölve.';
}
if(isset($_GET['actuser'])){
    // activate/deactivate user
    $user = exportCustomerGetNameById($_GET['actuser']);
    exportCustomerStatusToggle($_GET['actuser']);
    logEv(LOG_EVENT['status_export_customer'].' ('.$user.'):', null, (exportCustomerGetStatus($user) ? 'aktív':'inaktív'));
    $succMessage = 'A(z) <em>'.$user.'</em> megrendelő státusza módosult.';
}

if(isset($_GET['jelszoemelezteto'])){
  // send password reminder
  $user = $_GET['jelszoemelezteto'];
  $dd = getExportCustomerDataById($user)[0];
  $dat = [
    'password' => $dd['Jelszo'],
    'userName' => $dd['Email'],
    'link'     => SERVER_PROTOCOL.SERVER_URL
  ];
  sendEmail($to=$d['Email'], $toName=$dd['MegrendeloNev'], $subj="Jelszó emlékeztető", $template="password", $d=$dat);
  logEv(LOG_EVENT['passwd_notify_export_customer'].' ('.$dd['MegrendeloNev'].')');
  $succMessage = 'A(z) <em>'.$dd['MegrendeloNev'].'</em> felhasználó számára emlékeztetőt küdtünk.';

}

if(!empty($_POST['cegnev'])){
    if(isset($_POST['uid'])){
        // TODO update existing user
        exportCustomerUpdate(
            $_POST['uid'],
            $_POST['cegnev'],
            $_POST['kepviselo'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['pass'],
            $_POST['bill_address'],
            $_POST['ship_address'],
            (!empty($_POST['state']) ? 1 : 0)
        );
        logEv(LOG_EVENT['update_export_customer'].' ('.$_POST['cegnev'].'):', null, implode(', ',[$_POST['cegnev'],
            $_POST['kepviselo'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['pass'],
            $_POST['bill_address'],
            $_POST['ship_address'],($_POST['state'] ? 'aktív':'inaktív')]));
        $succMessage = "A(z) <em>".$user."</em> megrendelő adatai frissültek.";
    }
    else {
        exportCustomerAdd(
            $_POST['cegnev'],
            $_POST['kepviselo'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['pass'],
            $_POST['bill_address'],
            $_POST['ship_address'],
            (!empty($_POST['state']) ? 1 : 0)
        );
        $succMessage = "Az új megrendelő rögzítésre került.";
        logEv(LOG_EVENT['new_export_customer'].' ('.$_POST['cegnev'].'):', null, implode(', ',[$_POST['cegnev'],
            $_POST['kepviselo'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['pass'],
            $_POST['bill_address'],
            $_POST['ship_address'],($_POST['state'] ? 'aktív':'inaktív')]));

    }

}
    include('lib/popups.php');

?>

    <h1>Export megrendelők kezelése</h1>
    <table class="table table-striped table-hover display" id="export_customers" style="margin-right:1em;">
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
                <th>Regisztráció dátuma</th>
                <th>Utolsó bejelentkezés dátuma</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach(getExportCustomersWithData() as $i){ ?>
                <tr <?=($i[ 'Aktiv'] ? '' : 'style="color:#bbb;"')?>>
                    <td scope="row">
                        <?=$i['ID']?>
                    </td>
                    <td>
                        <?=$i['MegrendeloNev']?>
                            <?=($i['Aktiv']?'':' <span class="label label-default">INAKTÍV</span>')?></td>
                    <td>
                        <?=$i['Kepviselo']?>
                    </td>
                    <td>
                        <?=$i['Adoszam']?>
                    </td>
                    <td>
                        <?=$i['Telefonszam']?>
                    </td>
                    <td>
                        <?=$i['Fax']?>
                    </td>
                    <td>
                        <a href="mailto:<?=$i['Email']?>">
                            <?=$i['Email']?>
                        </a>
                    </td>
                    <td>
                        <?=$i['SzallitasiCim']?>
                    </td>
                    <td>
                        <?=$i['SzamlazasiCim']?>
                    </td>
                    <td>
                      <a href="?mode=export-megrendelok&jelszoemelezteto=<?=$i['ID']?>" class="btn btn-xs btn-primary">Emlékeztető
                          <br>küldése</a>
                    </td>
                    <td>
                        <?=$i['RegisztraltDatum']?>
                    </td>
                    <td>
                        <?=$i['UtolsoBelepes']?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary" onclick="window.location.href='?mode=export-megrendelok&szerk=<?=$i['ID']?>#szerkesztes'">Szerkesztés</button>
                        <button type="button" class="btn btn-xs btn-warning" onclick="if(confirm('Biztosan módosítani akarja a(z) <?=$i['MegrendeloNev']?>  státuszát?')){window.location.href='?mode=export-megrendelok&actuser=<?=$i['ID']?>';}">
                            <?=($i['Aktiv']?'Felfüggesztés':'Engedélyezés')?>
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('Biztosan törölni akarja a(z) <?=$i['MegrendeloNev']?> megrendelőt?')){window.location.href='?mode=export-megrendelok&deluser=<?=$i['ID']?>';}">Törlés</button>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#export_customers').DataTable({
                "scrollX": true,
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
                },
                "paging": false,
                "info": true,
                "columns": [
                    {
                        "searchable": false
            },
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                    {
                        "searchable": false,
                        "orderable": false,
            },
                    {
                        "searchable": false
            },
                    {
                        "searchable": false
            },
                    {
                        "searchable": false,
                        "orderable": false,
            },
            ]


            });
        });
    </script>

    <?php
// check if we are in edit mode
if(isset($_GET['szerk'])){
    $ud = getExportCustomerDataById($_GET['szerk'])[0];
}
$EDIT_MODE = False;

if(!empty($ud)){
    $EDIT_MODE = True;
}
?>
        <div class="jumbotron" style="margin-top:2em;">
            <form class="form-horizontal" id="export_customerform" name="export_customerform" method="post" action="/?mode=export-megrendelok">
                <fieldset>
                    <a name="szerkesztes"></a>
                    <legend>
                        <?=($EDIT_MODE?'Export megrendelő szerkesztése':'Új export megrendelő felvétele')?>
                    </legend>
                    <?=($EDIT_MODE?'<input name="uid" id="uid" type="hidden" value="'.$_GET['szerk'].'">':'')?>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cegnev">Cégnév</label>
                            <div class="col-md-5">
                                <input id="cegnev" name="cegnev" type="text" placeholder="Pizzeria Al Portichetto" class="form-control input-md" <?=($EDIT_MODE ? ' value="'.$ud[ 'MegrendeloNev']. '"': '')?> required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="kepviselo">Képviselő</label>
                            <div class="col-md-5">
                                <input id="kepviselo" name="kepviselo" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Kepviselo']. '"': '')?> placeholder="Bernardo Bissacco" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="adoszam">Adószám</label>
                            <div class="col-md-5">
                                <input id="adoszam" name="adoszam" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Adoszam']. '"': '')?> placeholder="IT12345671230" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tel">Telefonszám</label>
                            <div class="col-md-5">
                                <input id="tel" name="tel" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Telefonszam']. '"': '')?> placeholder="+39 23 1234-123" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fax">Fax</label>
                            <div class="col-md-5">
                                <input id="fax" name="fax" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Fax']. '"': '')?> placeholder="+39 23 1234-123" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">E-mail cím</label>
                            <div class="col-md-5">
                                <input id="email" name="email" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Email']. '"': '')?> placeholder="mail@example.com" class="form-control input-md">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label" for="pass">Jelszó</label>
                            <div class="col-md-5">
                                <input id="pass" name="pass" type="password" placeholder="" class="form-control input-md" <?=($EDIT_MODE ? '': ' required ')?> minlength="6">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="alert alert-info">
                                    <?=($EDIT_MODE ? 'A mezőt üresen hagyva nem változik meg a jelszó. A mező kitöltése esetén a jelszó megváltozik. A megrendelő <b>NEM</b> kap automatikus e-mail értesítést az új jelszóról. (Az értesítés rögzítés után, az "Emlékeztető küldése" gomb segítségével lehetséges.)':'Regisztráció után az új megrendelő <b>NEM</b> kap automatikus e-mail értesítést a bejelentkezési adatairól. (Az értesítés rögzítés után, az "Emlékeztető küldése" gomb segítségével lehetséges.)')?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="bill_address">Számlázási cím</label>
                            <div class="col-md-5">
                                <input id="bill_address" name="bill_address" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'SzamlazasiCim']. '"': '')?> placeholder="IT, Milano, Via Tazzoli 11. " class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ship_address">Szállítási cím</label>
                            <div class="col-md-5">
                                <input id="ship_address" name="ship_address" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'SzallitasiCim']. '"': '')?> placeholder="IT, Milano, Via Tazzoli 11. " class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="state">Státusz</label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label for="state">
                                        <input type="checkbox" name="state" id="state" value="1" <?=(!$EDIT_MODE || intval($ud[ 'Aktiv'])==1 ? ' checked="checked"': '')?>>Engedélyezett</label>
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
                $('#export_customerform').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        }
                    }
                });
            </script>

        </div>
