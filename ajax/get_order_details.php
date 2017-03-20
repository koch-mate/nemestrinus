<?php
session_start();
require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");


if(empty($_SESSION['activeLogin']) || empty($_POST['ID'])){
    
}
else {
    $dat = orderGetByID($_POST['ID']);
    $og = $dat['data'];
    ?>

          <table class="table" style="overflow-x:auto;">
              <tr>
                  <th>ID</th>
                  <td><?=$og['ID']?></td>
              </tr>
              <tr>
                  <th>Státusz</th>
                  <td>
                      <span id="po_<?=$og['ID']?>" class="btn btn-xs btn-primary " style="cursor:default;background:<?=M_S_SZINEK[$og['Statusz']][0]?>;border-color:<?=M_S_SZINEK[$og['Statusz']][0]?>;font-weight:bold;" >
                            <i class="fa  fa-<?=M_S_SZINEK[$og['Statusz']][1]?>" aria-hidden="true"></i>&nbsp;<?=$og['Statusz']?>
                      </span>
                  </td>
              </tr>
              <tr>
                  <th>Típus</th>
                  <td><span class="glyphicon glyphicon-<?=($og['Tipus']==M_LAKOSSAGI ? 'home" title="lakossági':'globe" title="export')?>" aria-hidden="true"></span></td>
              </tr>
              <tr>
                  <th>Prioritás</th>
                  <td><?=str_repeat('<span class="glyphicon glyphicon-star"></span><br>', $og['Prioritas'])?></td>
              </tr>
              <tr>
                  <th>Megrendelő</th>
                  <td><?=($og['Tipus']==M_LAKOSSAGI ? $og['MegrendeloNev'] : exportCustomerGetNameById($og['MegrendeloID']))?></td>
              </tr>
              <tr>
                  <th>Megrendelés dátuma</th>
                  <td><?=$og['RogzitesDatum']?></td>
              </tr>
              <tr>
                  <th>Ígért teljesítés dátuma</th>
                  <td><?=($og['KertDatum'] <= date('Y-m-d') && in_array($og['Statusz'], M_S_AKTIV) ? '<span style="color:red;"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span>').$og['KertDatum']?></span></td>
              </tr>
              <tr>
                  <th>Megjegyzés</th>
                  <td><div><?=$og['Megjegyzes']?></div>
                  <textarea class="form-control"></textarea></td>
              </tr>
              <tr>
                  <th>Tételek</th>
                  <td>
                      <table class="orderItems" style="font-size:100%; border-spacing:3px; border-collapse:separate;" >
                            <?php foreach($dat['items'] as $oi){ ?>
                                <tr >
                                    <td class="gyartasStatusz" style="text-align:left;">
                                        <span class="label" title="<?=$oi['GyartasStatusza']?>" style="font-size:100%;background:<?=GY_S_SZINEK[$oi['GyartasStatusza']][0]?>;"><i class="fa fa-<?=GY_S_SZINEK[$oi['GyartasStatusza']][1]?> fa-fw"></i>&nbsp;<?=$oi['GyartasStatusza']?></span> </td>
                                    <td style="padding:0 0.8em 0 0.8em;">
                                        <img src="img/<?=$oi['Fafaj']?>.png" class="zoom" style="height:1em;">
                                        <?=FATIPUSOK[$oi['Fafaj']][0]?>
                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <span class="glyphicon glyphicon-minus"></span>
                                        <?=$oi['Hossz']?> cm
                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <span class="glyphicon glyphicon-resize-full"></span>
                                        <?=$oi['Huratmero']?> cm
                                    </td>
                                    <td style="padding-right:0.8em;text-align:center;">
                                        <img src="img/<?=$oi['Csomagolas']?>.png" style="height:1em;" class="zoom" title="<?=CSOMAGOLASTIPUSOK[$oi['Csomagolas']][0]?>">

                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <?=$oi['Mennyiseg']?>
                                            <?=CSOMAGOLASTIPUSOK[$oi['Csomagolas']][1]?>
                                    </td>
                                    <td style="padding-right:0.8em;">
                                        <?=str_repeat('<span class="glyphicon glyphicon-tint"></span>',NEDVESSEG[$oi['Nedvesseg']][0])?>
                                    </td>
                                    <td><?=($oi['GyartasVarhatoDatuma'] <= date('Y-m-d') && in_array($oi['GyartasStatusza'], GY_S_AKTIV) ? '<span style="color:red;"><b>V:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>V:</b>&nbsp;').$oi['GyartasVarhatoDatuma']?></span></td>
                                    <td>&nbsp;<b>T:</b> <?=$oi['GyartasDatuma']?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="8" >
                                        <ul class="nav nav-pills" role="tablist">
                                            <?php
                                            foreach(GY_S_STATUSZOK as $gys){
                                                ?>
                                                <li class="smallpills <?=$gys == $oi['GyartasStatusza']?'active':'newsel'?>" role="presentation"><a role="tab" href="#tab_<?=GY_S_SZINEK[$gys][2]?>_<?=$oi['ID']?>" data-toggle="tab"><?=$gys?></a></li>
                                            
                                            <?php
                                            }
                                            ?>
                                         
                                        </ul>

                                        <div class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_VISSZAIGAZOLASRA_VAR ? ' in active':''?>" id="tab_vv_<?=$oi['ID']?>"></div>
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_GYARTASRA_VAR ? ' in active':''?>"  id="tab_gyv_<?=$oi['ID']?>">
                                              <label>Gyártás várható dátuma: </label>
                                                    <input class="form-control" name="datum" id="datum" type="dateISO"  placeholder="éééé-hh-nn" value="<?=date('Y-m-d')?>">
                                          </div>
                                            
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_LEGYARTVA ? ' in active':''?>"  id="tab_l_<?=$oi['ID']?>">
                                            <label>Gyártás tényleges dátuma dátuma: </label>
                                                    <input class="form-control" name="datum" id="datum" type="dateISO"  placeholder="éééé-hh-nn" value="<?=date('Y-m-d')?>">
                                              <div>Felhasználás...</div>
                                        </div>
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_VISSZAUTASITVA ? ' in active':''?>" id="tab_v_<?=$oi['ID']?>"></div>
                                        </div>

                                    </td>
                                </tr>
                                <tr style="height:2px;background:#333;">
                                    <td style="height:1px;background:#999;" colspan="9"></td>
</tr>
                                <?php } ?>
                        </table>
                  </td>
              </tr>
          </table>
<script>
    $().tab;
</script>

<?php
}
?>