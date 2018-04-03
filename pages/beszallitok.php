<?php

if(isset($_GET['deluser'])){
    if(supplierGetDependencies($_GET['deluser']) > 0){
      $failMessage = 'Nem lehet törölni, a beszállítóra bevételezések hivatkoznak.';
    }
    else {
      $user = getSupplierNameById($_GET['deluser']);
      supplierDelete($_GET['deluser']);
      logEv(LOG_EVENT['del_supplier'].' ('.$user.')', null, null);
      $succMessage = 'A(z) <em>'.$user.'</em> beszállító törölve.';

    }
}

if(!empty($_POST['cegnev'])){
    if(isset($_POST['uid'])){
        supplierUpdate(
            $_POST['uid'],
            $_POST['cegnev'],
            $_POST['kapcsolattarto'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['address'],
            $_POST['eutr_ege']
        );
        logEv(LOG_EVENT['update_supplier'].' ('.$_POST['cegnev'].'):', null, implode(', ',[$_POST['cegnev'],
            $_POST['kapcsolattarto'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['address'],
            $_POST['eutr_ege']]));
        $succMessage = "A(z) <em>".$user."</em> beszállító adatai frissültek.";
    }
    else {
        supplierAdd(
            $_POST['cegnev'],
            $_POST['kapcsolattarto'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['address'],
            $_POST['eutr_ege']
        );
        $succMessage = "Az új beszállító rögzítésre került.";
        logEv(LOG_EVENT['new_supplier'].' ('.$_POST['cegnev'].'):', null, implode(', ',[$_POST['cegnev'],
            $_POST['kapcsolattarto'],
            $_POST['adoszam'],
            $_POST['tel'],
            $_POST['fax'],
            $_POST['email'],
            $_POST['address'],
            $_POST['eutr_ege']]));

    }

}
    include('lib/popups.php');

?>

    <h1>Beszállítók kezelése</h1>
    <table class="table table-striped table-hover display" id="export_customers" style="margin-right:1em;">
        <thead>
            <tr>
                <th>#</th>
                <th>Cégnév</th>
                <th>Székhely</th>
                <th>EUTR azonosító / EGE kód</th>
                <th>Adószám</th>
                <th>Kapcsolattartó</th>
                <th>E-mail</th>
                <th>Telefonszám</th>
                <th>Fax</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach(suppliersGetWithData() as $i){ ?>
                <tr>
                    <td scope="row">
                        <?=$i['ID']?>
                    </td>
                    <td>
                        <?=$i['Cegnev']?>
                    </td>
                    <td>
                        <?=$i['Szekhely']?>
                    </td>
                    <td>
                        <?=$i['EUTR_EGE']?>
                    </td>
                    <td>
                        <?=$i['Adoszam']?>
                    </td>
                    <td>
                        <?=$i['Kapcsolattarto']?>
                    </td>
                    <td>
                        <a href="mailto:<?=$i['Email']?>">
                            <?=$i['Email']?>
                        </a>
                    </td>
                    <td>
                        <?=$i['Telefonszam']?>
                    </td>
                    <td>
                        <?=$i['Fax']?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-xs btn-primary" onclick="window.location.href='?mode=beszallitok&szerk=<?=$i['ID']?>#szerkesztes'">Szerkesztés</button>
                        <?php if(supplierGetDependencies($i['ID'])==0){?> <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('Biztosan törölni akarja a(z) <?=removeSpecialChars($i['Cegnev'])?> beszállítót?')){window.location.href='?mode=beszallitok&deluser=<?=$i['ID']?>';}">Törlés</button> <?php }?>
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
    $ud = supplierGetDataById($_GET['szerk'])[0];
}
$EDIT_MODE = False;

if(!empty($ud)){
    $EDIT_MODE = True;
}
?>
        <div class="jumbotron" style="margin-top:2em;">
            <form class="form-horizontal" id="supplierform" name="supplierform" method="post" action="/?mode=beszallitok">
                <fieldset>
                    <a name="szerkesztes"></a>
                    <legend>
                        <?=($EDIT_MODE?'Beszállító szerkesztése':'Új beszállító felvétele')?>
                    </legend>
                    <?=($EDIT_MODE?'<input name="uid" id="uid" type="hidden" value="'.$_GET['szerk'].'">':'')?>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cegnev">Cégnév</label>
                            <div class="col-md-5">
                                <input id="cegnev" name="cegnev" type="text" placeholder="Verga Zrt." class="form-control input-md" <?=($EDIT_MODE ? ' value="'.$ud[ 'Cegnev']. '"': '')?> required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="kapcsolattarto">Kapcsolattartó</label>
                            <div class="col-md-5">
                                <input id="kapcsolattarto" name="kapcsolattarto" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Kapcsolattarto']. '"': '')?> placeholder="Kovács Kálmán" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="adoszam">Adószám</label>
                            <div class="col-md-5">
                                <input id="adoszam" name="adoszam" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Adoszam']. '"': '')?> placeholder="123-4-5671230" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tel">Telefonszám</label>
                            <div class="col-md-5">
                                <input id="tel" name="tel" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Telefonszam']. '"': '')?> placeholder="+36 23 1234-123" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fax">Fax</label>
                            <div class="col-md-5">
                                <input id="fax" name="fax" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Fax']. '"': '')?> placeholder="+36 23 1234-123" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">E-mail cím</label>
                            <div class="col-md-5">
                                <input id="email" name="email" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Email']. '"': '')?> placeholder="mail@example.com" class="form-control input-md">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="address">Székhely</label>
                            <div class="col-md-5">
                                <input id="address" name="address" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'Szekhely']. '"': '')?> placeholder="8200 Veszprém, Jutasi út 10." class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="eutr_ege">EUTR azonosító / EGE kód</label>
                            <div class="col-md-5">
                                <input id="eutr_ege" name="eutr_ege" type="text" <?=($EDIT_MODE ? ' value="'.$ud[ 'EUTR_EGE']. '"': '')?> placeholder="123456789876" class="form-control input-md">
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
                $('#supplierform').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        }
                    }
                });
            </script>

        </div>
