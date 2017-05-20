<h1>Árlista</h1>
<h3>Lakossági <span class="glyphicon glyphicon-home"></span></h3>

<table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>Fatípus</th>
<?php foreach (CSOMAGOLASTIPUSOK as $csk => $csv) { ?>
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
    <?php foreach (CSOMAGOLASTIPUSOK as $csk => $csv) { ?>
      <td style="text-align:right;"><?php
      if(isset(ARLISTA[M_LAKOSSAGI][$csk][$ft])){
        echo ezres("".ARLISTA[M_LAKOSSAGI][$csk][$ft])."&nbsp;Ft/";
        echo CSOMAGOLASTIPUSOK[$csk][1];
      } else {
        echo "-";
      }

       ?></td>
    <?php } ?>
  </tr>

    <? }?>
</tbody>
</table>
