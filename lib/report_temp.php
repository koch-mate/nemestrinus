<?php
use Medoo\Medoo;

function kimutatasTemplate($cim = "", $cnt = ""){
  global $db, $mode, $ev;

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

<?php $ev = (isset($_GET['ev']) ? $_GET['ev'] : date('Y')); ?>

<div style="font-size:150% clearfix">
  <p>
  Vizsgált év: <span class="label label-primary"><?=$ev?></span>
  </p>
  <p>
    Év váltása:
    <?php for($i = 2010;  $i <= intval(date('Y'))+5; $i++){
      if($i == intval($ev))continue;
    ?>
    <a class="btn btn-sm btn-<?=($i == intval(date('Y'))?'info':'default')?>" href="?mode=<?=$mode?>&ev=<?=$i?>"><?=$i?></a>
    <?php
    }?>
  </p>
</div>


<div class="row">
<?=call_user_func($cnt)?>
</div>

<?php } //func: kimutatasTemplate() ?>
