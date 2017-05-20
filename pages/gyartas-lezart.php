<h1>Lezárt gyártások</h1>

<?php

require("lib/order_table.php");
orderTable($filters = ['Statuszok'=>'lezart'], $customerON = false, $customerDetailsON = false, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = true, $priceON = false, $paymentON = false);

?>
