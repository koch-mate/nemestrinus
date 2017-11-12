<h1>Árlista</h1>

<h3>Lakossági <span class="glyphicon glyphicon-home"></span></h3>

<table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>Fatípus</th>
<?php
$tid = 1;
foreach (CSOMAGOLASTIPUSOK as $csk => $csv) { ?>
  <th style="text-align:center;"><img src="/img/<?=$csk?>.png" style="height:2em;"><br /><?=mb_ucfirst($csv[0])?></th>
<?php } ?>
  </tr>
</thead>
<tbody>
  <?php foreach(FATIPUSOK as $ft => $ftv){ ?>
    <tr>

    <th>
      <span style="display:inline-block;width:2em;"><img src="/img/<?=$ft?>.png" class="zoom" style="height:1em;"></span><?=mb_ucfirst($ftv[0])?>
    </th>
    <?php foreach (CSOMAGOLASTIPUSOK as $csk => $csv) {
      $tid +=1;?>
      <td id="tid_<?=$tid?>" style="text-align:right;" >
        <span onclick="edit(<?=$tid?>, '<?=$csk?>', '<?=$ft?>', <?=$ARLISTA[M_LAKOSSAGI][$csk][$ft]?>)">
          <span style="cursor:pointer;" title="Szerkesztés"><?php
      if(isset($ARLISTA[M_LAKOSSAGI][$csk][$ft])){
        echo ezres("".$ARLISTA[M_LAKOSSAGI][$csk][$ft])."&nbsp;Ft/";
        echo CSOMAGOLASTIPUSOK[$csk][1];
      } else {
        echo "-"."&nbsp;Ft/";
        echo CSOMAGOLASTIPUSOK[$csk][1];
      }

       ?></span></span></td>
    <?php } ?>
  </tr>

    <? }?>
</tbody>
</table>
<template id="editCell">

  <div class="input-group input-group-sm">
    <input type="text" class="form-control" id="newPrice" />
    <span class="input-group-btn">
      <button class="btn btn-default" type="button" onclick="save();"><i class="fa fa-check" style="color:#090;" aria-hidden="true"></i></button>
      <button class="btn btn-default" type="button" onclick="cancel();"><i class="fa fa-times" style="color:#900;" aria-hidden="true"></i></button>
    </span>
  </div>

</template>
<script>
document.editedCell = 0;

function edit(tid, csom, fafaj, regiar){
  if(document.editedCell > 0){return;}
  else{
    document.editedCell = tid;
    document.fafaj = fafaj;
    document.csom = csom;
    document.regiar = regiar;

    document.origCell = $("#tid_"+tid).html();
    $("#tid_"+tid).html($("#editCell").html());
    $("#newPrice").val(regiar);
  }
}

function cancel(){
  $("#tid_"+document.editedCell).html(document.origCell);
  document.editedCell = 0;
  document.fafaj = null;
  document.csom = null;
}

function refresh(){
  fafaj = document.fafaj;
  csom = document.csom;
  tid = document.editedCell;
  $.ajax({
    method:'GET',
    url:'<?=SERVER_PROTOCOL.SERVER_URL?>ajax/get_unit_price.php',
    data: ({
      'tid':    tid,
      'fafaj':  fafaj,
      'csom':   csom,
    }),
  }).done(function(data){
    $("#tid_"+tid).html(data);
    document.editedCell = 0;
    document.fafaj = null;
    document.csom = null;
  }).fail(function(jqXHR, textStatus, errorThrown){
    location.reload();
  });

};


function save(){
  ujar = $("#newPrice").val();
  fafaj = document.fafaj;
  csom = document.csom;
  $.ajax({
      type: "POST",
      dataType: "html",
      url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/update_unit_price.php",
      data: ({
        'fafaj':  fafaj,
        'csom':   csom,
        'ujar':   ujar,
      }),
      success: function(data){
          refresh();
      },
      error: function(jqXHR, textStatus, errorThrown) {
          alert("Hiba!");
          cancel();
      }
  });

}
</script>
