<h1>Szállításra váró lakossági megrendelések</h1>

<?php

require("lib/order_table.php");
orderTable($filters = ['Statuszok'=>'aktiv', 'Tipus'=>M_LAKOSSAGI], $customerON = true, $customerDetailsON = true, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = false, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false, $shippingEditON = true, $shippingPriceEditON = false, $manufacturerEdit = false);

?>
<script>
$(document).ready(function() {
    dataTable = $('#megrendelt_tetelek').DataTable();
    dataTable.order([10,'desc'],[0,'asc']).draw();
} );
</script>
