<h1>Export megrendelések</h1>
<p>Dátum: <?=date("Y-m-d H:i:s")?></p>
<p>
  Az alábbi táblázat azokat az éppen aktuálisan a rendszerben lévő export megrendeléseket mutatja, melyek már elfogadott státuszban vannak, de még van olyan tételük, ami nincs legyártva.
</p>
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
{
  border-color:#000;
  padding:2px;
  margin:0;
}

.table p {
  padding:0;
  margin:0;
}
</style>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>ID</th>
      <th>Dátum</th>
      <th>Ígért telj. dátum</th>
      <th>Megrendelő</th>
      <th>Rendelés</th>
      <th>Cím</th>
      <th>Megjegyzés</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $num = 1;
      foreach (ordersGetAllData($filters=['Tipus'=>M_EXPORT, 'Statuszok'=>  'gyarthato', 'OrderBy'=>['KertDatum'=>'ASC']]) as $i) {
      $ois = ordersGetItemsByID($i['ID']);
      $mindLegyartva = 1;
      foreach($ois as $iois){
        if($iois[GyartasStatusza] != GY_S_LEGYARTVA){
          $mindLegyartva =0;
        }
      }
      if($mindLegyartva){
        continue;
      }
      $oin = count($ois);
    ?>
    <tr>
      <th><?=$num++?></th>
      <th><?=$i[ID]?></th>
      <td style="white-space:nowrap;"><?=$i[RogzitesDatum]?></td>
      <td style="white-space:nowrap;"><?=$i[KertDatum]?></td>
      <td><?=exportCustomerGetNameById($i[MegrendeloID])?></td>
      <td>
        <?php foreach($ois as $oi){ ?>
          <p>
            <?=FATIPUSOK[$oi[Fafaj]][0]?>,&nbsp;H:&nbsp;<?=$oi[Hossz]?>&nbsp;cm,&nbsp;&Oslash;:&nbsp;<?=$oi[Huratmero]?>&nbsp;cm,&nbsp;<?=$oi[Mennyiseg]?>&nbsp;<?=CSOMAGOLASTIPUSOK[$oi[Csomagolas]][1]?>&nbsp;<?=mb_strtolower(CSOMAGOLASTIPUSOK[$oi[Csomagolas]][0])?>&nbsp;[<?=NEDVESSEG[$oi[Nedvesseg]][1]?>]
          </p>
        <?php } ?>
      </td>
      <td><?=exportCustomerGetShipAddressById($i[MegrendeloID])?></td>
      <td><?=messageSimpleRender($i[Megjegyzes])?></td>
    </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<?php
?>
