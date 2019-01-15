<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");
require_once("../lib/wood.php");


if(empty($_SESSION['activeLogin']) || empty($_POST['ID'])){

}
else {
?>
<div class="form-horizontal">
<div class="form-group">
    <label class="col-md-4 control-label">Fafaj: </label>
    <div class="col-md-4" id="">
        <select class="form-control" id="selectFafaj">
            <option value="" >-- MIND --</option>
            <?php foreach(array_keys(FATIPUSOK) as $f){?>
            <option value="<?=$f?>" <?=($f == $_POST['Tipus']?'selected="selected"':'')?>><?=FATIPUSOK[$f][0]?></option>
            <?php }?>
        </select>
    </div>
</div>
<script>
$(document).ready(function () {
    $("#selectFafaj").on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        document.selectDataTable.column(1)
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                        $('#selectForm')[0].reset();
                    } );
});

</script>
<div class="form-group">
    <label class="col-md-4 control-label">ID: </label>
    <div class="col-md-4" >
        <span class="label label-default"><?=$_POST['ID']?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Rendelt mennyiség: </label>
    <div class="col-md-4">
        <span class="label label-default"><?=$_POST['RendeltMennyiseg']?>&nbsp;<?=U_NAMES[U_STD][0]?></span>
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Kiválasztott mennyiség: </label>
    <div class="col-md-4" >
        <span class="label label-primary" id="sumSzam">0&nbsp;<?=U_NAMES[U_STD][0]?></span>
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Külünbözet: </label>
    <div class="col-md-4" >
        <span class="label label-<?=($_POST['RendeltMennyiseg']==0?'success':'warninig')?>" id="kulSzam">-<?=$_POST['RendeltMennyiseg']?>&nbsp;<?=U_NAMES[U_STD][0]?></span>
    </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">&nbsp; </label>
  <div class="col-md-4" >
    <button type="button" id="selectSubmit" class="btn btn-primary">Mentés</button>
  </div>
</div>

<form name="select" id="selectForm">
<table class="table table-striped table-hover display" id="selectTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fafaj</th>
            <th>Mennyiség</th>
            <th>Beérkezési dátum</th>
            <th>Megjegyzés</th>
            <th>Felhasználás (<?=U_NAMES[U_STD][1]?>)</th>
        </tr>
    </thead>
    <tbody>
        <?php
          foreach(woodGetStock() as $w){
            $ossz = $w['Mennyiseg'];
            $felh = woodGetUsedPortion($w['ID']);
            $maradek = $ossz-$felh;

            if( $maradek<=EPSILON){continue;}


        ?>
        <tr>
            <td><?=$w['ID']?></td>
            <td data-filter="<?=$w['Fatipus']?>"><?=FATIPUSOK[$w['Fatipus']][0]?></td>
            <td><?=rnd($maradek)?>&nbsp;<?=U_NAMES[U_STD][1]?></td>
            <td><?=$w['Datum']?></td>
            <td><?=$w['Megjegyzes']?></td>
            <td><input name="menny_<?=$w['ID']?>" data-id="<?=$w['ID']?>" class="form-control mennySum" value="0" style="width:5em;" onkeyup="$(this).change()" onchange="updateSum();" required max="<?=rnd($maradek)?>" min="0" type="number"></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</form>


<script>
    $("#selectForm").validate();
    $("#selectSubmit").unbind();
    $("#selectSubmit,#selectSubmit2").click(function(){
        if( $("#selectForm" ).valid()
          ){
            var vals = {};
            var ni = 0;
            $(".mennySum").each(function () {
                if($(this).val() > 0 ){
                    vals[$(this).data('id')] = $(this).val();
                    ni++;
                }
            } );
            if(ni == 0){
                alert('Nincs megadva pozitív érték.')
            }
            else {
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_sources_for_production.php",
                    data: ({'ID':<?=$_POST['ID']?>, 'data':vals}),
                    success: function(data){
                        alert("Rögzítve!");
                        $('#editorSmWin').modal('hide');
                        loadTabla(<?=$_POST['ID']?>);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Hiba a rögzítés során!");
                    }
                });
            }
        }
        else {
          alert("Hibás adat.");        }
    }
                            );
    function updateSum(){
        var s = 0;
        $(".mennySum").each(function () {
            s+= parseFloat($(this).val());
        });
        $("#sumSzam").html((Math.round(s*100)/100)+"&nbsp;<?=U_NAMES[U_STD][0]?>");
        $("#kulSzam").html((Math.round((s-(<?=$_POST['RendeltMennyiseg']?>))*100)/100)+"&nbsp;<?=U_NAMES[U_STD][0]?>");
        if(s == <?=$_POST['RendeltMennyiseg']?>)
        {
          $("#kulSzam").removeClass('label-warning');
          $("#kulSzam").addClass('label-success');
        }
        else
        {
          $("#kulSzam").removeClass('label-success');
          $("#kulSzam").addClass('label-warning');
        }
    }

    $(document).ready(function () {
        updateSum();
        document.selectDataTable = $('#selectTable').DataTable({

            "info": true,
            "paging": false,
            "language": {
                "decimal": "",
                "emptyTable": "Nincs adat",
                "info": "Megjelenítve: _START_ és _END_ között, összesen _TOTAL_ adatsor",
                "infoEmpty": "Nincs megjeleníthető adatsor",
                "infoFiltered": "(_MAX_ adatsorból szűrve)",
                "infoPostFix": "",
                "thousands": ".",
                "lengthMenu": "Mutass _MENU_ eseményt",
                "loadingRecords": "Betöltés...",
                "processing": "Feldolgozás...",
                "search": "Keresés:",
                "zeroRecords": "Nincs találat",
                "paginate": {
                    "first": "Első",
                    "last": "Utolsó",
                    "next": "Következő",
                    "previous": "Előző"
                },
            },


            "columns" : [
                null,
                null,
                null,
                null,
                null,
                {orderable: false, searchable: false}
            ],

        });
        document.selectDataTable.column(1).search("<?=$_POST['Tipus']?>").draw();
    });
</script>
<?php
}
?>
