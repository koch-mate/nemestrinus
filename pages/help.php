<?php
require_once("vendor/Parsedown.php");
$Parsedown = new Parsedown();
?>
<div class="container">

<div class="jumbotron">
    <img src="img/logo.png" style="float:left;height:10em;margin-right:3em;" />
    <h1>IHARTÜ 2000 Kft.</h1>
    <p>Tűzifa megrendelés, gyártás és szállítás nyilvántartó program</p>
</div>

  <div class="col-sm">
    <?=$Parsedown->text(file_get_contents('docs/help.md'));?>
  </div>
</div>
