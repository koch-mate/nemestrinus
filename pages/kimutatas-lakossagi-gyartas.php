<h1>Lakossági megrendelések</h1>
<p>Dátum: <?=date("Y-m-d H:i:s")?></p>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Dátum</th>
      <th>Név</th>
      <th>Megrendelés</th>
      <th>Ár</th>
      <th>Fuvardíj</th>
      <th>Telefon</th>
      <th>Cím</th>
      <th>Megjegyzés</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach (ordersGetAllData($filters=['Tipus'=>M_LAKOSSAGI, 'Statuszok'=>  'aktiv']) as $i) {
      $ois = ordersGetItemsByID($i['ID']);
      $oin = count($ois);
    ?>
    <tr>
      <th><?=$i[ID]?></th>
      <td><?=$i[RogzitesDatum]?></td>
      <td><?=$i[MegrendeloNev]?></td>
      <td>
        <?php foreach($ois as $oi){ ?>
          <p>
            <?=FATIPUSOK[$oi[Fafaj]][0]?>,&nbsp;<?=$oi[Hossz]?>&nbsp;cm,&nbsp;<?=$oi[Mennyiseg]?>&nbsp;<?=CSOMAGOLASTIPUSOK[$oi[Csomagolas]][1]?>&nbsp;<?=mb_strtolower(CSOMAGOLASTIPUSOK[$oi[Csomagolas]][0])?>
          </p>
        <?php } ?>
      </td>
      <td><?=ezres($i[Vegosszeg])?>&nbsp;<?=$i[Penznem]?></td>
      <td><?=ezres($i[Fuvardij])?>&nbsp;<?=$i[Penznem]?></td>
      <td><?=$i[MegrendeloTel]?></td>
      <td><?=$i[MegrendeloCim]?></td>
      <td><?=messageSimpleRender($i[Megjegyzes])?></td>
    </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<?php
?>
