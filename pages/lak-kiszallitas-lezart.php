<h1>Kiszállított lakossági megrendelések</h1>

<?php

require("lib/order_table.php");
orderTable($filters = ['Statuszok'=>'lezart', 'Tipus'=>M_LAKOSSAGI], $customerON = true, $customerDetailsON = true, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = true, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false, $shippingEditON = false, $shippingPriceEditON = false);

?>
