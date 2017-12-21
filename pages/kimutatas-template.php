<?php

use Medoo\Medoo;
require("lib/report_temp.php");

kimutatasTemplate("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX", 'cnt');

function label($cnt, $style){
    return "<span class='label label-$style'>$cnt</span>";
}

function cnt(){
  global $ev, $db;
?>

<div class="row">

  <div class=" col-md-4" style="background:rgba(255, 255, 255, 0.9);margin:2em;padding:1em;">
    <h3>XXXXXXXXXXXXXXXXXXXXXXXX</h3>
  </div>

</div>

<?php }
?>
