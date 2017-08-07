<h2>Függő gyártások</h2>

<div class="alert alert-info" role="alert">A gyártás menü alatt csak a saját telepen gyártott megrendelések jelennek meg.</div>

<style>
.modal {
  overflow-y:auto;
}
</style>
<?php

require("lib/order_table.php");

orderTable($filters = ['Statuszok'=>'gyarthato', 'Gyarto'=>GYARTO_IHARTU], $customerON = false, $customerDetailsON = false, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = true, $priceON = false, $paymentON = false, $editButtonON = true, $trashButtonON = false, $shippingEditON = false, $shippingPriceEditON = false, $manufacturerEdit = false );

?>
<div class="modal fade" id="editorWin"  tabindex="-3" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Bezár (mentés nélkül)"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Megrendelés</h4>
      </div>
      <div class="modal-body" id="modalCont" style="overflow-x:auto;">
          <i class="fa fa-cog fa-spin fa-fw"></i> Betöltés...
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editorSmWin"  tabindex="-2" role="dialog" aria-labelledby="modalLabel2" style="z-index:9999;" >
  <div class="modal-dialog modal-sm" style="min-width:60%;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Bezár (mentés nélkül)"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel2">Felhasználás</h4>
      </div>
      <div class="modal-body" id="modalSmCont" style="overflow-x:auto;">
          <i class="fa fa-cog fa-spin fa-fw"></i> Betöltés...
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
        <button type="button" id="selectSubmit" class="btn btn-primary">Mentés</button>
      </div>
    </div>
  </div>
</div>
<script>
var loadCnt = $('#modalSmCont').html();

$('#editorWin').on('shown.bs.modal', function (event) {
    $('#modalCont').html(loadCnt)
    var button = $(event.relatedTarget);
    var orderId = button.data('id');
    var modal = $(this);
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/get_order_details.php",
        data: ({'ID':orderId}),
        success: function(data){
            $('#modalCont').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error: ', textStatus, errorThrown);
            modal.modal('hide');
        }
    });

});

$('#editorWin').on('hidden.bs.modal', function(event) {
    window.location.href = '?mode=<?=$_GET['mode']?>';      // FIXME - do in a more elegant way, reload only if meaningful change has happened, or even do it via AJAX
});

$('#editorSmWin').on('shown.bs.modal', function (event) {
    $('#modalSmCont').html(loadCnt);
    $('.modal-backdrop').last().css('z-index',9990);

    var button = $(event.relatedTarget);
    var orderId = button.data('id');
    var orderTipus = button.data('fatipus');
    var rendeltMennyiseg = button.data('rendeltmennyiseg');
    var modal = $(this);
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/select_source_for_production.php",
        data: ({'ID':orderId, 'Tipus':orderTipus, 'RendeltMennyiseg': rendeltMennyiseg}),
        success: function(data){
            $('#modalSmCont').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error: ', textStatus, errorThrown);
            modal.modal('hide');
        }
    });

});

</script>
