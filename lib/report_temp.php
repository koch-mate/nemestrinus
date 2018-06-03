<?php
use Medoo\Medoo;

function kimutatasTemplate($cim = "", $cnt = "", $honapraugras=false, $tipusSzures = false){
  global $db, $mode, $ev, $lak_exp;

?>
<script src="js/Chart.min.js"></script>

<script>
function toInt(n){ return Math.round(Number(n)); };
const numberWithCommas = (x) => {
  x=toInt(x);
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>

<h1><?=$cim?></h1>

<?php

$ev = (isset($_GET['ev']) ? $_GET['ev'] : date('Y'));

$lak_exp = 'mind';
if(isset($_GET['tipus'])){
  $lak_exp = $_GET['tipus'];
}

?>

<div style="font-size:150% clearfix">
  <p>
  Vizsgált év: <span class="label label-primary"><?=$ev?></span>
  </p>
  <p>
    Év váltása:
    <?php for($i = 2010;  $i <= intval(date('Y'))+5; $i++){
      if($i == intval($ev))continue;
    ?>
    <a class="btn btn-sm btn-<?=($i == intval(date('Y'))?'info':'default')?>" href="?mode=<?=$mode?>&ev=<?=$i?>&tipus=<?=$lak_exp?>"><?=$i?></a>
    <?php
    }?>
  </p>
<?php if($honapraugras){?>
  <p>
    Hónapra ugrás: <?php
    foreach(MONTHS as $mi => $mn){ ?>
      <a href="#hodiv<?=$mi?>" onclick="toggle(this, $('#hodiv<?=$mi?>'));"><?=$mn?></a><?=$mi<12?', ':''?>
      <?php } ?>
  </p>
<?php } ?>

<?php if($tipusSzures){?>
Megrendelések szűrése:
  <div class="btn-group" data-toggle="buttons" id="tipusSel" style="display:inline-block;" >
    <label class="btn btn-primary btn-sm <?=$lak_exp=='mind'?'active':''?>">
      <input type="radio" name="options" value="mind" id="mind" autocomplete="off" <?=$lak_exp=='mind'?'checked':''?> >Mind
    </label>
    <label class="btn btn-primary btn-sm <?=$lak_exp=='lakossagi'?'active':''?>">
      <input type="radio" name="options" value="lakossagi" id="lakossagi" autocomplete="off" <?=$lak_exp=='lakossagi'?'checked':''?>> Lakossági
    </label>
    <label class="btn btn-primary btn-sm <?=$lak_exp=='export'?'active':''?>">
      <input type="radio" name="options" value="export" id="export" autocomplete="off" <?=$lak_exp=='export'?'checked':''?>> Export
    </label>
  </div>
<script>
$('#tipusSel input:radio').on('change', function() {
  window.location.href="?mode=<?=$mode?>&ev=<?=$ev?>&tipus="+$('#tipusSel input:radio:checked').val();
});
</script>

</div>
<?php } ?>

<div class="row">
<?=call_user_func($cnt)?>
</div>

<?php } //func: kimutatasTemplate() ?>
