<h2>Függő megrendelések</h2>
<?php 
    
require("lib/order_table.php"); 

orderTable($filters = ['Statuszok'=>'aktiv'], $orderStatusEdit = true );
     

?>
<div class="modal fade" id="editorWin"  tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Bezár (mentés nélkül)"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Megrendelés</h4>
      </div>
      <div class="modal-body" id="modalCont" style="overflow-x:auto;">
          Betöltés...
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Mégsem</button>
        <button type="button" class="btn btn-primary">Mentés</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#editorWin').on('show.bs.modal', function (event) {
    $('#modalCont').html('Betöltés...')
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

})

</script>