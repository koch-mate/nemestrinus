<?php
session_start();

require_once("../lib/config.php");

require_once("../vendor/medoo.php");
require_once("../lib/db.php");
require_once("../lib/order.php");
require_once("../lib/export_customers.php");
require_once("../lib/units.php");


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
                      <table class="orderItems" style="font-size:100%; " >
                            <?php foreach($dat['items'] as $oi){ ?>
                                <tr onclick="showRow('<?=$oi['ID']?>');" style="height:4em; cursor:pointer;">
                                    <td>                                        
                                        <span class="label" title="<?=$oi['GyartasStatusza']?>" style="font-size:100%;background:<?=GY_S_SZINEK[$oi['GyartasStatusza']][0]?>;"><i class="fa fa-<?=GY_S_SZINEK[$oi['GyartasStatusza']][1]?> fa-fw"></i>&nbsp<?=$oi['GyartasStatusza']?></span> 
                                    </td>
</td>
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
                                <tr id="editSor<?=$oi['ID']?>" class="editSor" style="display:none;">
                                    <td colspan="9" >
                                        <ul class="nav nav-pills" role="tablist">
                                            <?php
                                            foreach(GY_S_STATUSZOK as $gys){
                                                ?>
                                                <li class="smallpills <?=$gys == $oi['GyartasStatusza']?'active':'newsel'?>" role="presentation" ><a role="tab" href="#tab_<?=GY_S_SZINEK[$gys][2]?>_<?=$oi['ID']?>" data-toggle="tab" <?=$gys == $oi['GyartasStatusza'] ? '' : ' onclick="edited=true;"'?> ><span style="background:<?=GY_S_SZINEK[$gys][0]?>;display:inline-block;width:1em;border-radius:4px;box-shadow:0px 0px 4px #fff;">&nbsp;</span>&nbsp;<i class="fa fa-<?=GY_S_SZINEK[$gys][1]?> fa-fw"></i>&nbsp;<?=$gys?></a></li>
                                            
                                            <?php
                                            }
                                            ?>
                                         
                                        </ul>

                                        <div class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_VISSZAIGAZOLASRA_VAR ? ' in active':''?>" id="tab_vv_<?=$oi['ID']?>"></div>
                                                
                                            
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_GYARTASRA_VAR ? ' in active':''?>"  id="tab_gyv_<?=$oi['ID']?>">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" >Gyártás várható dátuma: </label>
                                                <div class="col-md-8">
                                                    <div class="input-group date" style="width:50%" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                        <input class="form-control" name="datum" onchange="if($(this).val()!= '<?=$oi['GyartasVarhatoDatuma']?>'){edited=true;$(this).css('background-color', '#ffdcab');}" id="datum" type="dateISO" required placeholder="éééé-hh-nn" value="<?=$oi['GyartasVarhatoDatuma']?>">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              
                                          </div>
                                            
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_LEGYARTVA ? ' in active':''?>"  id="tab_l_<?=$oi['ID']?>">
                                          <div class="form-group">
                                                <label class="col-md-4 control-label" >Gyártás tényleges dátuma: </label>
                                                <div class="col-md-8">
                                                    <div class="input-group date" style="width:50%" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                        <input class="form-control" name="datum" onchange="if($(this).val() != '<?=$oi['GyartasDatuma']?>'){edited=true;$(this).css('background-color', '#ffdcab');}" id="datum" type="dateISO" required placeholder="éééé-hh-nn" value="<?=$oi['GyartasDatuma']?>">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              <label class="col-md-4 control-label" >Felhasználás: </label>

                                                <div class="col-md-8">
                                                    <p>Megrendelt mennyiség: <span class="label label-default"><?=$oi['Mennyiseg']?>&nbsp;<?=CSOMAGOLASTIPUSOK[$oi['Csomagolas']][1]?>&nbsp;<?=CSOMAGOLASTIPUSOK[$oi['Csomagolas']][0]?> = <?=rnd(CSOMAGOLASTIPUSOK[$oi['Csomagolas']][2]*$oi['Mennyiseg']).'&nbsp'.U_NAMES[CSOMAGOLASTIPUSOK[$oi['Csomagolas']][3]][0]?></span></p>
                                                    <p>Átszámított mennyiség: <span class="label label-primary"><?=rnd(unitChange(CSOMAGOLASTIPUSOK[$oi['Csomagolas']][3], U_STD, CSOMAGOLASTIPUSOK[$oi['Csomagolas']][2]*$oi['Mennyiseg'])).'&nbsp'.U_NAMES[U_STD][0]?></span></p>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Alapanyag ID</th>
                                                                <th>Típus</th>
                                                                <th>Beérkezési dátum</th>
                                                                <th>Mennyiség</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>21</td>
                                                                <td>Fenyo</td>
                                                                <td>3245-23-24</td>
                                                                <td>13234 t.m3</td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Összesen:</th>
                                                                <th></th>
                                                                <th></th>
                                                                <th>12345</th>
                                                                <th></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static"  data-target="#editorSmWin" data-id="<?=$oi['ID']?>" data-fatipus="<?=$oi['Fafaj']?>" data-rendeltmennyiseg="<?=rnd(unitChange(CSOMAGOLASTIPUSOK[$oi['Csomagolas']][3], U_STD, CSOMAGOLASTIPUSOK[$oi['Csomagolas']][2]*$oi['Mennyiseg']))?>">Hozzáadás</button>
                                              </div>

                                        </div>
                                            
                                            
                                            
                                            
                                          <div role="tabpanel" class="tab-pane fade<?=$oi['GyartasStatusza'] == GY_S_VISSZAUTASITVA ? ' in active':''?>" id="tab_v_<?=$oi['ID']?>"></div>
                                            
                                            
                                            
                                        </div>

                                    </td>
                                </tr>
                                <tr onclick="showRow('<?=$oi['ID']?>');">
                                    <td style="height:1em;vertical-align:bottom;" colspan="9"><hr style="margin:0;"></td>
                                </tr>
                                <?php } ?>
                        </table>
                  </td>
              </tr>
          </table>
<script>
    $().tab;
    var edited = false;
    var actId = 0;
    function showRow( rowId ) {
        if(actId == rowId){
            return;
        }
        actId = rowId;
        if(!(edited && !confirm('Másik rendelési tétel szerkesztése esetén a nem mentett módosítások elvesznek. Biztosan másik tételt kíván szerkeszteni?'))){
            // FIXME - az elozoleg editalt valtoztatasokat resetelni kell
            edited = false;
            $('.editSor').hide();
            $('#editSor'+rowId).show();
        }
    }
</script>

<?php
}
?>