<h1>Lezárt megrendelések</h1>

<?php

require("lib/order_table.php"); 
orderTable($filters = ['Statuszok'=>'lezart'], $customerON = true, $customerDetailsON = true, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = true, $priceON = false, $paymentON = false);

?>