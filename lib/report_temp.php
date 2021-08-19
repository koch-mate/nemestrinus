<?php
use Medoo\Medoo;

function kimutatasTemplate($cim = "", $cnt = "", $honapraugras=false, $tipusSzures = false, $osszesEv = false, $megrendeloNevSzures = false){
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
if($megrendeloNevSzures){
?>
<form action="">
<div class="form-group">
  <label class="col-md-2 control-label">Szűrés lakossági megrendelő alapján: </label>
  <div class="col-md-3">
    <input class="form-control input-md" type="text" name="MegrendeloNev" value="<?=$_GET['MegrendeloNev']?>">
  </div>
  <input type="submit" value="Szűrés" class="btn btn-success">
  <input type="hidden" name="mode" value="<?=$_GET['mode']?>">
</div>
</form>

<form action="">
<div class="form-group">
  <label class="col-md-2 control-label">Szűrés export megrendelő alapján: </label>
  <div class="col-md-3">
        <select class="selectpicker" name="MegrendeloID" data-live-search="true">
            <option value="">Összes</option>
            <?php foreach(getExportCustomersWithData() as $ec){?>
                <option value="<?=$ec['ID']?>">
                    <?=$ec['MegrendeloNev']?>
                </option>
                <?php }?>
        </select>
  </div>
  <input type="submit" value="Szűrés" class="btn btn-success">
  <input type="hidden" name="mode" value="<?=$_GET['mode']?>">
</div>
</form>
<?php
}

if(isset($_GET['MegrendeloNev']) && trim($_GET['MegrendeloNev']) != ""){
  ?>
  <div class="alert alert-warning">
    Szűrés <b>lakossági</b> megrendelőkre: "<?=trim($_GET['MegrendeloNev'])?>"
  </div>
  <?php
}
if(isset($_GET['MegrendeloID']) && trim($_GET['MegrendeloID']) != ""){
  ?>
  <div class="alert alert-warning">
    Szűrés <b>export</b> megrendelőre: "<?=exportCustomerGetNameById($_GET['MegrendeloID'])?>"
  </div>
  <?php
}


?>
<?php

$ev = (isset($_GET['ev']) ? $_GET['ev'] : date('Y'));

$lak_exp = 'mind';
if(isset($_GET['tipus'])){
  $lak_exp = $_GET['tipus'];
}

?>

<?php
if(!$osszesEv){ ?>
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
<?php } ?>
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

<?php
if($osszesEv){
  for($iev = 2015;$iev < date('Y')+1;$iev++)
  {

  $ev = $iev;
  $cntRow=call_user_func($cnt);

  ?>
      <div class="row">
      <?=$cntRow?>
      </div>

  <?php
  }
}
else { ?>

    <div class="row">
    <?=call_user_func($cnt)?>
    </div>

<?php
  } ?>

<?php } //func: kimutatasTemplate() ?>
