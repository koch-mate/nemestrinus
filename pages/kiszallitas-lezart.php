<h1>Kiszállított megrendelések</h1>

<?php

require("lib/order_table.php");
orderTable($filters = ['Statuszok'=>'lezart'], $customerON = true, $customerDetailsON = true, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = true, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false, $shippingEditON = false, $shippingPriceEditON = false);

?>
