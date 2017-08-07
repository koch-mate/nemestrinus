<h1>Lezárt gyártások</h1>

<div class="alert alert-info" role="alert">A gyártás menü alatt csak a saját telepen gyártott megrendelések jelennek meg.</div>

<?php

require("lib/order_table.php");
orderTable($filters = ['Statuszok'=>'lezart', 'Gyarto'=>GYARTO_IHARTU], $customerON = false, $customerDetailsON = false, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = true, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false, $shippingEditON = false, $shippingPriceEditON = false, $manufacturerEdit = false);

?>
