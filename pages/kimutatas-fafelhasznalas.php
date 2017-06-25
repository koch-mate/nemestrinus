<h1>Faanyag felhasználás</h1>
<p>
  A táblázat a gyártás során felhasznált tényleges alapanyagok mennyiségét mutatja.
</p>
<p>
  <b>M:</b> a megrendelt fatípust és átszámított mennyiséget mutatja, <b>F:</b> pedig a ténylegesen felhasznált tételeket. Ezek külünbsége a <b>&Delta;</b>.
</p>
<p>
  Ha a gyártás során a felhasznált mennyiség több, mint 10%-kal eltér a megrendelttől, akkor az érték színezve jelenik meg. <span style="color:#c00;">Piros</span> szín esetén a gyártás <span style="color:#c00;">kevesebb</span> anyagot használt fel az elvártnál, <span style="color:#00c;">kék</span> szín esetén a gyártás <span style="color:#00c;">több</span> anyagot használt fel, mint az elvárt.
</p>
<table class="table table-striped table-hover" id="megrendet_tetelek" style="min-width:100%;">
  <thead>
    <th>
      ID
    </th>
    <th>
      Típus
    </th>
    <th>
      Státusz
    </th>
    <th>
      Tételek
    </th>
  </thead>
  <tbody>
    <?php
foreach(ordersGetAllData() as $o){
  if($o['Statusz'] == M_S_FELDOLGOZAS_ALATT){continue;}
    ?>
    <tr>
      <td>
        <?=$o['ID']?>
      </td>
      <td data-order="<?=$o['Tipus']?>">
        <span class="glyphicon glyphicon-<?=($o['Tipus']==M_LAKOSSAGI ? 'home" title="lakossági':'globe" title="export')?>" aria-hidden="true"></span>
      </td>
      <td data-order="<?=$o['Statusz']?>">
        <span class="label" style="background:<?=M_S_SZINEK[$o['Statusz']][0]?>"><i class="fa  fa-<?=M_S_SZINEK[$o['Statusz']][1]?>" aria-hidden="true"></i>&nbsp;<?=$o['Statusz']?></span>
      </td>
      <td>
        <table>

          <?php
          foreach (ordersGetItemsByID($o['ID']) as $oi) {
            ?>
            <tr>
              <td>
                <b>ID:&nbsp;</b><?=$oi['ID']?>&nbsp;
              </td>
              <td>
                <span class="label" title="<?=$oi['GyartasStatusza']?>" style="background:<?=GY_S_SZINEK[$oi['GyartasStatusza']][0]?>;"><i class="fa fa-<?=GY_S_SZINEK[$oi['GyartasStatusza']][1]?> fa-fw"></i></span>&nbsp;
              </td>
              <td>
                <b title="megrendelt">M:</b>&nbsp;<img src="img/<?=$oi['Fafaj']?>.png" class="zoom" style="height:1em;" title="<?=FATIPUSOK[$oi['Fafaj']][0]?>">
                &nbsp;<?=rnd($oi['MennyisegStd']).U_NAMES[U_STD][1]?>&nbsp;
              </td>
              <td>
                <b title="felhasznált">F:</b><?php
                  $elemek = [];
                  $ossz = 0;
                  foreach(woodGetUsedForOrder($oi['ID']) as $ii){
                    //print '&nbsp;<b>ID:</b>&nbsp'.$ii['ID'];
                    $ossz += -$ii['Mennyiseg'];
                    $elemek[]='&nbsp;<img  title="'.FATIPUSOK[$ii['Fatipus']][0].'" src="img/'.$ii['Fatipus'].'.png" class="zoom" style="height:1em;">&nbsp;'.(-rnd($ii['Mennyiseg']).U_NAMES[U_STD][1]).'&nbsp;';
                  }
                  if(count($elemek)){
                    print implode('<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;', $elemek);
                  }
                  else {
                    print '&nbsp;0&nbsp;'.U_NAMES[U_STD][1].'&nbsp;';
                  }

                 if(count($elemek)>1){
                 ?>
                 &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;<?=rnd($ossz).U_NAMES[U_STD][1]?>&nbsp;<?php }?>
              </td>
              <?php $delta = $ossz-$oi['MennyisegStd']; ?>
              <td style="color:<?=abs($delta/$oi['MennyisegStd'])>0.1? ($delta < 0?'#c00;':'#00c;'): 'inherit'?>">
                <b>&Delta;:</b>&nbsp;<?=rnd($delta).U_NAMES[U_STD][1]?>
              </td>
            </tr>
            <?php
          }
            ?>

        </table>
       </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<script>
$(document).ready(function () {
    $('#megrendet_tetelek').DataTable({
        "scrollX": true,
        "lengthMenu": [[50, 100, 250, 500, -1], [50, 100, 250, 500, "minden"]],
        "language": {
            "decimal": "",
            "emptyTable": "Nincs adat",
            "info": "Megjelenítve: _START_ és _END_ között, összesen _TOTAL_ adatsor",
            "infoEmpty": "Nincs megjeleníthető adatsor",
            "infoFiltered": "(_MAX_ adatsorból szűrve)",
            "infoPostFix": "",
            "thousands": ".",
            "lengthMenu": "Mutass _MENU_ megrendelést",
            "loadingRecords": "Betöltés...",
            "processing": "Feldolgozás...",
            "search": "Keresés:",
            "zeroRecords": "Nincs találat",
            "paginate": {
                "first": "Első",
                "last": "Utolsó",
                "next": "Következő",
                "previous": "Előző"
            },
        },
        "info": true,
        "stateSave": true,
        "columns": [
            null,
            null,
            null,
            {
                'searchable': false,
                'orderable': false
            },
          ]
        });
      });

</script>
