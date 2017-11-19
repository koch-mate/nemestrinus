<h2>Export megrendelések</h2>

<form method="get"  >
    <input type="hidden" name="mode" value="megrendeles-lakossagi">
    <fieldset>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" data-target="#collapseOne" role="tab" id="headingOne" style="cursor:pointer;">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="<?=empty($_GET['id']) && empty($_GET['md']) && empty($_GET['td']) && empty($_GET['tip']) ? 'false' : 'true'?>" aria-controls="collapseOne">
                    <span class="glyphicon glyphicon-filter" style="margin-right:1em;"></span>Szűrők
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse <?=(empty($_GET['id']) && empty($_GET['md']) && empty($_GET['td']) && empty($_GET['tip'])) ? '' : 'in'?>" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">

             <?php
                    $tnev = [
                        'md' => 'Megrendelés dátuma',
                        'td' => 'Ígért teljesítés dátuma',
                    ];
                    foreach(array_keys($tnev) as $tn){
                    ?>
                    <div class="form-group">
                        <input type="checkbox" name="<?=$tn?>" id="<?=$tn?>_picker" value="on" data-size="mini" <?=(isset($_GET[$tn])&&$_GET[$tn]=='on'?'checked':'')?> >
                        <script>
                        $(function() {
                            $('#<?=$tn?>_picker').bootstrapToggle({
                                off: '<span class="glyphicon glyphicon-minus"></span>',
                                on: '<span class="glyphicon glyphicon-plus"></span>',
                                onstyle: 'success',
                                offstyle: 'warning',
                            });
                        })
                        </script>
                        <label style="width: 15em;"><?=$tnev[$tn]?></label>
                        <?php
                        $sy1 = empty($_GET[$tn.'y1']) ? 2016 : $_GET[$tn.'y1'];
                        $sm1 = empty($_GET[$tn.'m1']) ? 1 : $_GET[$tn.'m1'];
                        $sy2 = empty($_GET[$tn.'y2']) ? intval(date('Y'))+4 : $_GET[$tn.'y2'];
                        $sm2 = empty($_GET[$tn.'m2']) ? 12 : $_GET[$tn.'m2'];

                        ?>
                        <select id="<?=$tn?>y1" name="<?=$tn?>y1"><?php for($y = 2016;$y<=intval(date('Y'))+4;$y++){?><option value="<?=$y?>" <?=($y == intval($sy1) ? 'selected="selected"': '')?>><?=$y?></option><?php }?></select>
                        <select id="<?=$tn?>m1" name="<?=$tn?>m1"><?php foreach(array_keys(MONTHS) as $m){?><option value="<?=$m?>"  <?=($m == intval($sm1) ? 'selected="selected"': '')?>><?=MONTHS[$m]?></option><?php }?></select>
                        -tól
                        <span style="margin-right:3em;">&nbsp;</span>
                        <select id="<?=$tn?>y2" name="<?=$tn?>y2"><?php for($y = 2016;$y<=intval(date('Y'))+4;$y++){?><option value="<?=$y?>"  <?=($y == intval($sy2) ? 'selected="selected"': '')?>><?=$y?></option><?php }?></select>
                        <select id="<?=$tn?>m2" name="<?=$tn?>m2"><?php foreach(array_keys(MONTHS) as $m){?><option value="<?=$m?>"  <?=($m == intval($sm2) ? 'selected="selected"': '')?>><?=MONTHS[$m]?></option><?php }?></select>
                        -ig
                    </div>
                    <?php } ?>

                      <div class="form-group">
                        <input type="checkbox" name="idp" id="id_picker" value="on" data-size="mini" onchange="if(!$(this).prop('checked')){$('#idinput').val('');}" <?=(!empty($_GET['id'])?'checked':'')?> >
                        <script>
                        $(function() {
                            $('#id_picker').bootstrapToggle({
                                off: '<span class="glyphicon glyphicon-minus"></span>',
                                on: '<span class="glyphicon glyphicon-plus"></span>',
                                onstyle: 'success',
                                offstyle: 'warning',
                            });
                        })
                        </script>
                        <label style="width: 15em;">ID</label>
                          <input name="id" id="idinput" type="number" class="form_control" value="<?=$_GET['id']?>">
                  </div>




                    <div style="margin-top:2em;">
                        <button type="submit" class="btn btn-primary" >
            Frissítés</button>
                    </div>
                </div>
            </div>
          </div>
        </div>

    </fieldset>
</form>

<?php

require("lib/order_table.php");

$f = [];
$f['Tipus'][] = M_EXPORT;
if(isset($_GET['md'] ) && $_GET['md'] == 'on'){
    $f['RogzitesDatum'] = [date("Y-m-d", mktime(0,0,0,$_GET['mdm1'],1, $_GET['mdy1'])), date("Y-m-d", mktime(0,0,0,intval($_GET['mdm2'])+1,0, $_GET['mdy2']))];
}
if(isset($_GET['td']) && $_GET['td'] == 'on'){
    $f['KertDatum'] = [date("Y-m-d", mktime(0,0,0,$_GET['tdm1'],1, $_GET['tdy1'])), date("Y-m-d", mktime(0,0,0,intval($_GET['tdm2'])+1,0, $_GET['tdy2']))];
}
if(!empty($_GET['id'])){
    $f['ID'] = $_GET['id'];
}

orderTable($filters=$f, $customerON = true, $customerDetailsON = true, $globStatusEditON = true, $orderStatusEdit = true, $shippingON = false, $priceON = true, $paymentON = true, $editButtonON = false, $trashButtonON = true, $shippingEditON = true, $shippingPriceEditON = true, $manufacturerEdit = true);


?>


<script>

function deleteOrder( oid ){
    if(confirm("Biztosan törli a rendelést? (ID: "+oid+") Visszamondás esetén használja a 'visszamondott' státuszt!")){
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/delete_order.php",
                data: ({'ID':oid}),
                success: function(data){
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Hiba!");
                }
            });

    };
}

</script>

<script>
$(document).ready(function() {
    dataTable = $('#megrendelt_tetelek').DataTable();
    dataTable.order([7,'asc'],[0,'asc']).draw();
} );
</script>
