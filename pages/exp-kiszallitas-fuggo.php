<h1>Szállításra váró export megrendelések</h1>

<?php

require("lib/order_table.php");
orderTable($filters = ['Statuszok'=>'gyarthato', 'Tipus'=>M_EXPORT], $customerON = true, $customerDetailsON = true, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = false, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false, $shippingEditON = true, $shippingPriceEditON = false);

?>