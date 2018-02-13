<?php


session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");


if(empty($_SESSION['activeLogin']) || empty($_GET['id']) ){
    ?>

Hibás autentikáció.

<?php
}
else {

$mid = $_GET['id'];

$og = ordersGetAllData(['ID'=>$mid])[0];

 if($og['Tipus']==M_LAKOSSAGI){?>
<form id="customerEditForm" method="post">
<input name="id" value="<?=$mid?>" type="hidden">
  <table class='table table-striped table-hover' style='font-size:80%'>
    <tbody>
        <tr>
            <th>Megrendelő neve</th>
            <td>
                <input name="MegrendeloNev" value="<?=($og['MegrendeloNev'])?>"/>
            </td>
        </tr>
        <tr>
            <th>Számlázási cím</th>
            <td>
                <input name="MegrendeloCim" value="<?=($og['MegrendeloCim'])?>"/>
            </td>
        </tr>
        <tr>
            <th>Telefonszám</th>
            <td>
                <input name="MegrendeloTel" value="<?=($og['MegrendeloTel'])?>"/>
            </td>
        </tr>
        <tr>
            <th>Kapcsolattartó neve</th>
            <td>
                <input name="KapcsolattartoNev" value="<?=($og['KapcsolattartoNev'])?>"/>
            </td>
        </tr>
        <tr>
            <th>Szállítási cím</th>
            <td>
                <input name="SzallitasiCim" value="<?=($og['SzallitasiCim'])?>"/>
            </td>
        </tr>
        <tr>
            <th>Telefonszám</th>
            <td>
                <input name="KapcsolattartoTel" value="<?=($og['KapcsolattartoTel'])?>"/>
            </td>
        </tr>
    </tbody>
</table>
<button class="btn btn-success btn-xs" type="submit">Mentés</button>
<button class="btn btn-danger btn-xs" type="button" onclick="$('.popover').popover('hide');">Mégsem</button>
</form>
<script>

$("#customerEditForm").submit(function(e) {

    var url = "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_customer_data.php";

    $.ajax({
           type: "POST",
           url: url,
           data: $("#customerEditForm").serialize(),
           success: function(data)
           {
               alert("Rögzítve!");
               location.reload();
           }
         });
    e.preventDefault();
});

</script>


<?}
else
{
  $ec = getExportCustomerDataById($og['MegrendeloID'])[0];
  ?>
  <table class='table table-striped table-hover' style='font-size:80%'>
    <tbody>
        <tr>
            <th>Cégnév</th>
            <td>
                <?=($ec['MegrendeloNev'])?>
            </td>
        </tr>
        <tr>
            <th>Képviselő</th>
            <td>
                <?=htmlentities($ec['Kepviselo'])?>
            </td>
        </tr>
        <tr>
            <th>Adószám</th>
            <td>
                <?=htmlentities($ec['Adoszam'])?>
            </td>
        </tr>
        <tr>
            <th>Telefon</th>
            <td>
                <?=htmlentities($ec['Telefonszam'])?>
            </td>
        </tr>
        <tr>
            <th>Fax</th>
            <td>
                <?=htmlentities($ec['Fax'])?>
            </td>
        </tr>
        <tr>
            <th>E-mail cím</th>
            <td>
              <a href='mailto:<?=htmlentities($ec['Email'])?>'><?=htmlentities($ec['Email'])?></a>
            </td>
        </tr>
        <tr>
            <th>Szállításdi cím</th>
            <td>
                <?=htmlentities($ec['SzallitasiCim'])?>
            </td>
        </tr>
        <tr>
            <th>Számlázási cím</th>
            <td>
                <?=htmlentities($ec['SzamlazasiCim'])?>
            </td>
        </tr>
    </tbody>
</table>
<a role="button" href="/?mode=export-megrendelok&szerk=<?=$og['MegrendeloID']?>#szerkesztes" class="btn btn-xs btn-primary">Szerkesztés</a>

<?php }
}
?>
