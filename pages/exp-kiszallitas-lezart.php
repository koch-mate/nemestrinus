<h1>Kiszállított export megrendelések</h1>

<?php

require("lib/order_table.php");
orderTable($filters = ['Statuszok'=>'lezart', 'Tipus'=>M_EXPORT], $customerON = true, $customerDetailsON = true, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = true, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false, $shippingEditON = false, $shippingPriceEditON = false);

?>
