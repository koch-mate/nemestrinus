<?php
function orderTable($filters=[], $customerON = false, $customerDetailsON = false, $globStatusEditON = false, $orderStatusEdit = false, $shippingON = false, $priceON = false, $paymentON = false, $editButtonON = false, $trashButtonON = false, $shippingEditON = false, $shippingPriceEditON = false, $manufacturerEdit = false){
global $mode;
$orderItemsDetalis = false;

if(in_array(R_ADMINISZTRACIO, $_SESSION['userRights'])){
  $orderItemsDetalis = true;
}

?>
<style>
    div.dataTables_scrollBody {
        padding-bottom: 18em;
    }
    .highlight {
        color:#4d75b3;
    }
    td.gyartasStatusz {
        color:#fff;
        padding:3px;
        text-align: center;
    }

    table.orderItems {
        font-size:80%;
        white-space: nowrap;
    }
    .hand {
      cursor:pointer;
    }
</style>

<table class="table table-striped table-hover display" id="megrendelt_tetelek" style="min-width:100%;font-size:90%;">
        <thead style="font-weight:bold">
            <tr>
                <th style="vertical-align:bottom;">ID</th>
                <th style="vertical-align:bottom;"></th>
                <th style="vertical-align:bottom;" title="Típus">T.</th>
                <th style="vertical-align:bottom;" title="Prioritás">P.</th>
<?php if($customerON){ ?>
                <th style="vertical-align:bottom;">Megrendelő</th>
<?php } ?>
                <th style="vertical-align:bottom;">Megr. dátuma</th>
                <th style="vertical-align:bottom;">Ígért teljesítés dátuma</th>
                <th style="vertical-align:bottom;">Megr. státusza</th>
                <th style="vertical-align:bottom;">Gyártó</th>
                <th style="vertical-align:bottom;">Tétel(ek)</th>
<?php if($shippingON || $shippingEditON){ ?>
                <th style="vertical-align:bottom;">Szállítás</th>
<?php } ?>
<?php if($priceON){ ?>
                <th style="vertical-align:bottom;">Ár</th>
<?php } ?>
<?php if($paymentON){ ?>
                <th style="vertical-align:bottom;">Fizetés</th>
<?php } ?>
                <th style="vertical-align:bottom;">Megjegyzés</th>
<?php if($editButtonON || $trashButtonON){?>
                <th style="vertical-align:bottom;">Művelet</th>
<?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php

                foreach(ordersGetAllData($filters=$filters) as $og){

                  if(array_key_exists('Statuszok', $filters)){
                    if($filters['Statuszok'] == 'gyarthato'){
                      // hide orders with all items manufactured
                      $jump = true;
                      foreach( ordersGetItemsByID($og['ID']) as $oii ){
                        if( in_array($oii['GyartasStatusza'], GY_S_AKTIV)){
                          $jump = false;
                        }
                      }
                      if($jump){
                        continue;
                      }
                    }
                  }
                      ?>
                <tr id="tr_<?=$og['ID']?>">
                    <td>
                        <?=$og['ID']?>
                    </td>
                    <td style="background:<?=M_S_SZINEK[$og['Statusz']][0]?>;color:#fff;vertical-align:middle;text-align:center;font-size:1.5em;"><i class="fa  fa-<?=M_S_SZINEK[$og['Statusz']][1]?>" aria-hidden="true"></i></td>
                    <td data-order="<?=$og['Tipus']?>">
                        <span class="glyphicon glyphicon-<?=($og['Tipus']==M_LAKOSSAGI ? 'home" title="lakossági':'globe" title="export')?>" aria-hidden="true"></span>
                    </td>
                    <td style="font-size:80%;" data-order="<?=$og['Prioritas']?>">
                        <?=str_repeat('<span class="glyphicon glyphicon-star"></span><br>', $og['Prioritas'])?>
                    </td>
<?php if($customerON){ ?>
                    <td>
<?php if($customerDetailsON){?>
                        <a role="button" tabindex="1" customer-id="<?=$og['ID']?>"  title="Adatok" style="cursor:pointer;">
                            <?=($og['Tipus']==M_LAKOSSAGI ? $og['MegrendeloNev'] : exportCustomerGetNameById($og['MegrendeloID']))?>
                        </a>
<?php } else { // customerDetailsON ?>
            <?=($og['Tipus']==M_LAKOSSAGI ? $og['MegrendeloNev'] : exportCustomerGetNameById($og['MegrendeloID']))?>
<?php } ?>
                    </td>
<?php } ?>
                    <td>
                        <?=$og['RogzitesDatum']?>
                    </td>
                    <td>
                        <?=($og['KertDatum'] <= date('Y-m-d') && in_array($og['Statusz'], M_S_AKTIV) ? '<span style="color:red;"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span>').$og['KertDatum']?></span>
                    </td>
                    <td>
                      <span style="display:none;"><?=array_search($og['Statusz'], M_S_STATUSZOK_SORREND)?></span>
<?php if($globStatusEditON){?>
                        <div id="div_po_<?=$og['ID']?>" style="display:none">
                            <?php
                            foreach(M_S_STATUSZOK as $ms){
                                if($ms == $og['Statusz']){continue;}
                                if($ms == M_S_TELJESITVE && $og['SzallitasStatusza'] != SZ_S_LESZALLITVA){continue;} // ne lehessen lezarni, ha meg nincs leszallitva
                                ?>
                                <p>
                                    <button type='button' class='btn btn-xs btn-primary' style='background:<?=M_S_SZINEK[$ms][0]?>;border-color:<?=M_S_SZINEK[$ms][0]?>;font-weight:bold;width:100%;' onclick='if(confirm("Státusz módosítása erre: <?=$ms?>")){saveStatus(<?=$og['ID']?>,"<?=$ms?>")};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>
                                        <?=$ms?>
                                    </button>
                                </p>
                                <?php
                            }
                            ?>
                        </div>

                        <a tabindex="1" data-toggle="popover" id="po_<?=$og['ID']?>" class="btn btn-xs btn-primary " title="Státusz módosítása" style="background:<?=M_S_SZINEK[$og['Statusz']][0]?>;border-color:<?=M_S_SZINEK[$og['Statusz']][0]?>;font-weight:bold;" onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');">
                            <?=$og['Statusz']?>
                        </a>
<?php } else {?>
                        <span id="po_<?=$og['ID']?>" class="btn btn-xs btn-primary " style="cursor:default;background:<?=M_S_SZINEK[$og['Statusz']][0]?>;border-color:<?=M_S_SZINEK[$og['Statusz']][0]?>;font-weight:bold;" >
                            <?=$og['Statusz']?>
                        </span>
<?php } ?>

<?php if($globStatusEditON){?>
                        <script>
                            $("#po_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'bottom',
                                trigger: 'focus',
                                content: function () {
                                    return $('#div_po_<?=$og['ID']?>').html()
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");});
                        </script>
<?php } ?>
                    </td>

<?php // gyarto / kulso gyartas statusza ?>

<?php if( $manufacturerEdit == false){?>
                    <td data-order="<?=$og['Gyarto']?>">
                      <?php if($og['Gyarto'] == GYARTO_IHARTU){?>
                        <img style="height:1em;" class="zoom" src="/img/ihartu_logo.png" />&nbsp;
                        <?php } else {?>
                        <?php }?>
                        <?=$og['Gyarto']?>
                      <?php
                      if(!in_array($og['Gyarto'], GYARTO_BELSO)){
                        //kulso gyarto eseten:?>
                        <span class="label" title="<?=$og['KulsoGyartasStatusza']?>" style="font-size:100%;background:<?=K_GY_S_SZINEK[$og['KulsoGyartasStatusza']][0]?>;"><i class="fa fa-<?=K_GY_S_SZINEK[$og['KulsoGyartasStatusza']][1]?> fa-fw"></i></span>

                        <?php
                      }?>
                    </td>
<?php } else {?>
                      <td data-order="<?=$og['Gyarto']?>">

                        <?php
                        //csak akkor, ha meg nem kezdodott meg a gyartas, vagy ha kulso gyarto
                        $mfStatusEditable = !in_array($og['Gyarto'], GYARTO_BELSO) || orderProductionHasNotStarted($og['ID']);
                        if($mfStatusEditable){?>
                          <template id="mf_div_po_<?=$og['ID']?>" style="color:#000;" >
                              <div style="color:#000;">
                                <input type='text' value="<?=$og['Gyarto']?>" id="gyarto_input_<?=$og['ID']?>" class="form-control">
                                <div style="margin-top:0.5em;">
                                  <button class="btn btn-sm btn-default" onclick="$('#gyarto_input_<?=$og['ID']?>').val('<?=GYARTO_IHARTU?>')">
                                    <img style="height:1em;"  src="/img/ihartu_logo.png" />&nbsp;<?=GYARTO_IHARTU?>
                                  </button>
                                </div>

                                <div style="margin-top:0.5em;">
                                  <button class="btn btn-sm btn-success" onclick='if(confirm("Menti a változásokat?")){saveNewManufacturer(<?=$og['ID']?>, $("#gyarto_input_<?=$og['ID']?>").val() )};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>Mentés</button>
                                  <button class="btn btn-sm btn-danger" onclick='$("#tr_<?=$og['ID']?>").removeClass("highlight");$(".popover").popover("hide");'>Mégsem</button>
                                </div>
                              </div>
                          </template>

                        <a tabindex="1"  role="botton" id="mf_po_<?=$og['ID']?>" class="btn btn-xs btn-default " title="Gyártó módosítása" style="font-weight:bold;" onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');">
                        <?php }?>
                          <?php if($og['Gyarto'] == GYARTO_IHARTU){?>
                          <img style="height:1em;"  src="/img/ihartu_logo.png" />&nbsp;
                          <?php } ?>
                          <?=$og['Gyarto']?>
                        <?php if($mfStatusEditable){ ?>
                        </a>
                        <script>
                            $("#mf_po_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'bottom',
                                trigger: 'click',
                                content: function () {
                                  return $('#mf_div_po_<?=$og['ID']?>').html()
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");});

                        </script>
                        <?php } ?>
                        <?php
                        if(!in_array($og['Gyarto'], GYARTO_BELSO)){
                          //kulso gyarto eseten:?>
                          <template id="div_kgy_s_<?=$og['ID']?>">
                            <?php
                            foreach(K_GY_S_STATUSZOK as $ms){
                                if($ms == $og['KulsoGyartasStatusza']){continue;}
                                ?>
                                <p>
                                    <button type='button' class='btn btn-xs btn-primary' style='background:<?=K_GY_S_SZINEK[$ms][0]?>;border-color:<?=K_GY_S_SZINEK[$ms][0]?>;font-weight:bold;width:100%;' onclick='if(confirm("Státusz módosítása erre: <?=$ms?>")){saveExtMfStatus(<?=$og['ID']?>,"<?=$ms?>")};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>
                                        <?=$ms?>
                                    </button>
                                </p>
                                <?php
                            }
                            ?>

                          </template>

                          <div style="margin-top:1em;">
                            <button class="btn btn-xs" id="kgy_s_<?=$og['ID']?>" tabindex="1" title="Státusz módosítása" style="color:#fff;font-size:100%;background:<?=K_GY_S_SZINEK[$og['KulsoGyartasStatusza']][0]?>;" onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');"><i class="fa fa-<?=K_GY_S_SZINEK[$og['KulsoGyartasStatusza']][1]?> fa-fw"></i></button>
                          </div>
                          <script>
                              $("#kgy_s_<?=$og['ID']?>").popover({
                                  html: true,
                                  placement: 'bottom',
                                  trigger: 'click',
                                  content: function () {
                                    return $('#div_kgy_s_<?=$og['ID']?>').html()
                                  }
                              }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");});

                          </script>

                          <?php }?>
                      </td>
<?php } ?>
<?php // megrendelt tetelek ?>
                    <td>
                        <table class="orderItems"  >
                            <?php
                            $nemTeljesenLezart = false;
                            $tetelekSzama = 0;
                            foreach(ordersGetItemsByID($og['ID']) as $oi){
                              $tetelekSzama += 1;
                              if(in_array($oi['GyartasStatusza'], SZERKESZTHETO_GYARTAS_STATUSZOK)){
                                $nemTeljesenLezart = true;
                              }
                              ?>
                                <tr >
                                    <td class="gyartasStatusz" rowspan="2">
                                      <?php if(!in_array($og['Gyarto'], GYARTO_BELSO)){
                                        // kulso gyarts, nincs kulon visszajelzes ?>

                                        <?php
                                      } else { ?>
                                        <span class="label" title="<?=$oi['GyartasStatusza']?>" style="font-size:100%;background:<?=GY_S_SZINEK[$oi['GyartasStatusza']][0]?>;"><i class="fa fa-<?=GY_S_SZINEK[$oi['GyartasStatusza']][1]?> fa-fw"></i></span> </td>
                                        <?php } ?>
                                    <td><b>ID:</b>&nbsp;<?=$oi['ID']?></td>
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
<?php if($priceON){ ?>
                                    <td style="padding-right:0.8em;">
                                        <?=$oi['Ar']."&nbsp;".$og['Penznem']?>
                                    </td>
<?php } ?>
                                    <td style="padding-right:0.8em;">
                                        <?=csepp($oi['Nedvesseg'])?>
                                    </td>
                                    <tr>
                                      <td colspan="8">
                                      <?php if(in_array($og['Gyarto'], GYARTO_BELSO)){?>
                                      <?=($oi['GyartasSzamitottDatuma'] < $oi['GyartasVarhatoDatuma'] && in_array($oi['GyartasStatusza'], GY_S_AKTIV) ? '<span style="color:red;"><b>Sz:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>Sz:</b>&nbsp;').$oi['GyartasSzamitottDatuma']?>&nbsp;</span>
                                      <?=($oi['GyartasVarhatoDatuma'] <= date('Y-m-d') && in_array($oi['GyartasStatusza'], GY_S_AKTIV) ? '<span style="color:red;"><b>V:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>V:</b>&nbsp;').$oi['GyartasVarhatoDatuma']?></span>
                                      &nbsp;<b>T:</b> <?=$oi['GyartasDatuma']?>&nbsp;
                                      <?php }?>
                                      <?php if(in_array($mode, TETEL_SZERKESZTHETO) && in_array(R_ADMINISZTRACIO, $_SESSION['userRights']) && in_array($og['Statusz'], SZERKESZTHETO_MEGRENDELES_STATUSZOK) && in_array($oi['GyartasStatusza'], SZERKESZTHETO_GYARTAS_STATUSZOK) ){?>
                                          <div style="float:right;">
                                            <button type="button" class="btn btn-xs btn-danger" style="height:1em;" title="Törlés" onclick="delItem(<?=$oi['ID']?>)" >
                                              <span class="glyphicon glyphicon-trash" ></span>
                                            </button>&nbsp;
                                            <button type="button" class="btn btn-xs btn-warning" style="height:1em;" title="Szerkesztés" onclick="editItem(<?=$og['ID']?>,<?=$oi['ID']?>,'<?=$og['Penznem']?>', '<?=$og['KertDatum']?>','<?=$oi['Fafaj']?>','<?=$oi['Hossz']?>', '<?=$oi['Huratmero']?>', '<?=$oi['Csomagolas']?>', '<?=$oi['Mennyiseg']?>', '<?=$oi['Nedvesseg']?>',  '<?=$oi['Ar']?>' )" >
                                              <span class="glyphicon glyphicon-cog" ></span>
                                            </button>
                                          </div>
                                      <?php } ?>
                                      </td>
                                    </tr>
                                </tr>
                                <?php }
                                if($tetelekSzama == 0){
                                  $nemTeljesenLezart = true;
                                }

                                ?>

                        </table>
<?php if($orderItemsDetalis){ ?>
                        <div id="megrendeles_reszletek_<?=$og['ID']?>" style="margin-top:0.5em;">
                          <?php if(in_array($mode, TETEL_SZERKESZTHETO) && in_array(R_ADMINISZTRACIO, $_SESSION['userRights']) && in_array($og['Statusz'], SZERKESZTHETO_MEGRENDELES_STATUSZOK) && $nemTeljesenLezart ){?>
                            <button type="button" class="btn btn-xs btn-success" title="Új tétel" onclick="addItem(<?=$og['ID']?>, '<?=$og['Penznem']?>', '<?=$og['KertDatum']?>')"  >
                              <b>+</b> Új tétel
                            </button>
                          <?php } ?>
                          <button type="button" class="btn btn-xs btn-info" onclick="reszletek(<?=$og['ID']?>);">Részletek</button>

                        </div>
<?php } ?>
                    </td>
<?php if($shippingON){ ?>
                    <td data-order="<?=array_search($og['SzallitasStatusza'], SZ_S_STATUSZOK_SORREND)?>">
                      <table style="font-size:80%;">
                            <tr>
                                <td rowspan="2">
                                    <span class="label" title="<?=$og['SzallitasStatusza']?>" style="font-size:100%;background:<?=SZ_S_SZINEK[$og['SzallitasStatusza']][0]?>;"><i class="fa fa-<?=SZ_S_SZINEK[$og['SzallitasStatusza']][1]?> fa-fw"></i></span>
                                </td>
                                <td style="padding-left:0.5em;">
                                    <?=($og['SzallitasVarhatoDatuma'] <= date('Y-m-d') && in_array($og['Statusz'], GY_S_AKTIV) ? '<span style="color:red;"><b>V:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>V:</b>&nbsp;').$og['SzallitasVarhatoDatuma']?></span>

                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:0.5em;"><b>T:</b>&nbsp;<?=$og['SzallitasTenylegesDatuma']?><br />
                                  <b title="szállítólevél szám">Szálllsz.:&nbsp;</b><?=$og['SzallitolevelSzam']?><br />
                                  <b title="számlaszám">Számlasz.:&nbsp;</b><?=$og['Szamlaszam']?><br />
                                  <b>CMR:&nbsp;</b><?=$og['CMR']?><br />
                                  <b>EKAER:&nbsp;</b><?=$og['EKAER']?><br />
                                  <b>Fuvarozó:&nbsp;</b><?=$og['Fuvarozo']?>
                            </tr>
                        </table>
                    </td>
<?php } ?>
<?php if($shippingEditON){ ?>
                    <td data-order="<?=array_search($og['SzallitasStatusza'],SZ_S_STATUSZOK_SORREND)?>" style="white-space: nowrap; width:20em;">
                        <template id="div_szs_<?=$og['ID']?>" style="color:#000;">
                          <div style="width:20em;">

                            <?php
                            foreach(array_keys(SZ_S_SZINEK) as $fs){
                              if($og['SzallitasStatusza'] == SZ_S_GYARTAS_ALATT && $og['Gyarto'] == GYARTO_IHARTU && $fs != SZ_S_GYARTAS_ALATT && !in_array(R_ADMINISZTRACIO, $_SESSION['userRights'])){
                                continue;
                              }
                              if($og['SzallitasStatusza'] != SZ_S_GYARTAS_ALATT && $fs == SZ_S_GYARTAS_ALATT && !in_array(R_ADMINISZTRACIO, $_SESSION['userRights'])){
                                continue;
                              }

                                ?>
                                <p style="color:#000;">
                                    <label><input type="radio" name="szst_rad_<?=$og['ID']?>" value="<?=$fs?>" <?=($fs == $og['SzallitasStatusza'] ? 'checked="checked"':'')?>>&nbsp;
                                    <span class='label ' style="background:<?=SZ_S_SZINEK[$fs][0]?>;border-color:<?=SZ_S_SZINEK[$fs][0]?>;" ><i class="fa fa-<?=SZ_S_SZINEK[$fs][1]?> fa-fw" ></i><?=$fs?></span></label>
                                </p>
                          <?php } ?>
                          <div class="form-group">
                            <label style="color:#000;">Szállítás&nbsp;várható&nbsp;dátuma:</label>
                              <div class="input-group date" data-provide="datepicker" id="szhatarido_<?=$og['ID']?>" data-date-format="yyyy-mm-dd" style="width:10em;">
                                <input class="form-control" name="szihatarido_<?=$og['ID']?>" id="szihatarido_<?=$og['ID']?>" type="dateISO" required placeholder="éééé-hh-nn" value="<?=$og['SzallitasVarhatoDatuma']?>">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                              </div>

                          </div>
                          <div class="form-group">
                            <label style="color:#000;">Szállítás&nbsp;tényleges&nbsp;dátuma:</label>
                              <div class="input-group date" data-provide="datepicker" id="szdatum_<?=$og['ID']?>" data-date-format="yyyy-mm-dd" style="width:10em;">
                                <input class="form-control" name="szidatum_<?=$og['ID']?>" id="szidatum_<?=$og['ID']?>" type="dateISO" required placeholder="éééé-hh-nn" value="<?=$og['SzallitasTenylegesDatuma']?>" >
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                              </div>

                          </div>
                          <div class="form-group">
                            <label class="control-label" style="color:#000;">Szállítólevél szám:</label>
                              <div style="width:10em;">
                                <input class="form-control input-md" name="szszlev_<?=$og['ID']?>" id="szszlev_<?=$og['ID']?>"   value="<?=$og['SzallitolevelSzam']?>" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label" style="color:#000;">Számlaszám:</label>
                                <div style="width:10em;">
                                  <input class="form-control input-md" name="szsz_<?=$og['ID']?>" id="szsz_<?=$og['ID']?>"   value="<?=$og['Szamlaszam']?>" >
                                </div>
                              </div>
                            <div class="form-group">
                              <label style="color:#000;">CMR:</label>
                                <div  style="width:10em;">
                                  <input class="form-control input-md" name="szcmr_<?=$og['ID']?>" id="szcmr_<?=$og['ID']?>"  value="<?=$og['CMR']?>" >
                                </div>
                          </div>
                          <div class="form-group">
                            <label style="color:#000;">EKAER:</label>
                              <div    style="width:10em;">
                                <input class="form-control input-md" name="szekaer_<?=$og['ID']?>" id="szekaer_<?=$og['ID']?>"  value="<?=$og['EKAER']?>" >
                              </div>
                            </div>
                            <div class="form-group">

                              <label style="color:#000;">Fuvarozó:</label>
                                <div    style="width:10em;">
                                  <input class="form-control input-md" name="szfuvarozo_<?=$og['ID']?>" id="szfuvarozo_<?=$og['ID']?>"  value="<?=$og['Fuvarozo']?>" >
                                </div>

                          </div>

                              <div style="margin-top:0.5em;">
                                <button class="btn btn-sm btn-success" onclick='if(confirm("Menti a változásokat?")){saveShippingStatus(<?=$og['ID']?>, "<?=$og['Tipus']?>")};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>Mentés</button>
                                <button class="btn btn-sm btn-danger" onclick='$("#tr_<?=$og['ID']?>").removeClass("highlight");$(".popover").popover("hide");'>Mégsem</button>
                              </div>
                            </div>
                        </template>
                        <table style="font-size:80%;">
                            <tr>
                                <td rowspan="2">
                                  <a tabindex="1" data-toggle="popover" id="szs_<?=$og['ID']?>" class="btn btn-xs btn-primary " title="<span style='color:#000'>Státusz módosítása</span>" style="background:<?=SZ_S_SZINEK[$og['SzallitasStatusza']][0]?>;border-color:<?=SZ_S_SZINEK[$og['SzallitasStatusza']][0]?>;font-weight:bold;font-size:100%;" onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');">
                                    <i class="fa fa-<?=SZ_S_SZINEK[$og['SzallitasStatusza']][1]?> fa-fw"></i>
                                </a>

                                </td>
                                <td style="padding-left:0.5em;">
                                    <?=($og['SzallitasVarhatoDatuma'] <= date('Y-m-d') && in_array($og['Statusz'], GY_S_AKTIV) ? '<span style="color:red;"><b>V:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>V:</b>&nbsp;').$og['SzallitasVarhatoDatuma']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:0.5em;"><b>T:</b>&nbsp;<?=$og['SzallitasTenylegesDatuma']?>
                                  <br />
                                  <b title="szállítólevél szám">Szálllsz.:&nbsp;</b><?=$og['SzallitolevelSzam']?><br />
                                  <b title="számlaszám">Számlasz.:&nbsp;</b><?=$og['Szamlaszam']?><br />
                                  <b>CMR:&nbsp;</b><?=$og['CMR']?><br />
                                  <b>EKAER:&nbsp;</b><?=$og['EKAER']?><br />
                                  <b>Fuvarozó:&nbsp;</b><?=$og['Fuvarozo']?>
                                </td>
                            </tr>
                        </table>

                    </td>
                        <script>
                            $("#szs_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'bottom',
                                trigger: 'click',
                                content: function () {
                                    return $('#div_szs_<?=$og['ID']?>').html();
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");}).on('show.bs.popover',function (){$('.popover').popover('hide');});

                        </script>


<?php  } ?>

<?php if($priceON){
  if($og['Tipus']==M_EXPORT){ ?>
                    <td style="white-space: nowrap;"  >
                        <b><?=rnd(orderFullPrice($og['ID']))?>&nbsp;<?=$og['Penznem']?></b><br>
                        <span style="font-size:75%;"><span class="glyphicon glyphicon-tree-deciduous"></span>:&nbsp;<b><?=rnd(orderFullPrice($og['ID'])-$og['Fuvardij'])?>&nbsp;<?=$og['Penznem']?></span></b><br>
<?php } else { ?>
  <td style="white-space: nowrap;"  >
      <b><?=rnd(orderFullPrice($og['ID'])+$og['Fuvardij'])?>&nbsp;<?=$og['Penznem']?></b><br>
      <span style="font-size:75%;"><span class="glyphicon glyphicon-tree-deciduous"></span>:&nbsp;<b><?=rnd(orderFullPrice($og['ID']))?>&nbsp;<?=$og['Penznem']?></span></b><br>
<?php }

  if($shippingPriceEditON && $og['Tipus']==M_EXPORT){ ?>
    <template id="div_se_<?=$og['ID']?>" style="color:#000;">
      <label class="col-md-5 control-label" style="white-space:nowrap;color:#000;" for="szallitasiktsg">Szállítási díj: </label>
      <div class="col-md-8">
          <div class="input-group">
              <input class="form-control"style="width:10em;" name="szallktsg_<?=$og['ID']?>" id="szallktsg_<?=$og['ID']?>" type="number" required  value="<?=$og['Fuvardij']?>">
              <span class="input-group-addon" id="szk-penznem"><?=$og['Penznem']?></span>
          </div>

      </div>
      <div style="clear:both;text-align:right;padding-top:1em;">
        <button class="btn btn-sm btn-success" onclick='if(confirm("Menti a változásokat?")){saveShippingPrice(<?=$og['ID']?>)};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>Mentés</button>
        <button class="btn btn-sm btn-danger" onclick='$("#tr_<?=$og['ID']?>").removeClass("highlight");$(".popover").popover("hide");'>Mégsem</button>
      </div>

    </template>
    <a tabindex="1" data-toggle="popover" style="color:#000;cursor:pointer;text-decoration:none;" id="se_<?=$og['ID']?>"  title="<span style='color:#000'>Szállítási díj módosítása</span>"  onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');">
                        <span class="label label-default"><i class="fa fa-truck" aria-hidden="true"></i>:&nbsp;<?=rnd($og['Fuvardij'])?>&nbsp;<?=$og['Penznem']?></span>
    </a>
    <script>
        $("#se_<?=$og['ID']?>").popover({
            html: true,
            placement: 'bottom',
            trigger: 'click',
            content: function () {
                return $('#div_se_<?=$og['ID']?>').html();
            }
        }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");}).on('show.bs.popover',function (){$('.popover').popover('hide');});

    </script>

<?php } else {?>
                        <span style="font-size:75%;"><i class="fa fa-truck" aria-hidden="true"></i>:&nbsp;<?=rnd($og['Fuvardij'])?>&nbsp;<?=$og['Penznem']?></span>
<?php } ?>
                    </td>
<?php } ?>
<?php if($paymentON){ ?>
                    <td data-order="<?=array_search($og['FizetesStatusza'], F_S_STATUSZOK_SORREND)?>"  style="white-space: nowrap;">


                        <template id="div_fs_<?=$og['ID']?>" style="color:#000;">

                            <?php
                            foreach(array_keys(F_S_SZINEK) as $fs){
                                ?>
                                <p style="color:#000;">
                                    <label><input type="radio" name="fizst_rad_<?=$og['ID']?>" value="<?=$fs?>" <?=($fs == $og['FizetesStatusza'] ? 'checked="checked"':'')?>>&nbsp;
                                    <span class='label ' style="background:<?=F_S_SZINEK[$fs][0]?>;border-color:<?=F_S_SZINEK[$fs][0]?>;" ><i class="fa fa-<?=F_S_SZINEK[$fs][1]?> fa-fw" ></i><?=$fs?></span></label>
                                </p>
                          <?php } ?>

                          <label style="color:#000;">Fizetési&nbsp;határidő:</label>
                            <div class="input-group date" data-provide="datepicker" id="fhatarido_<?=$og['ID']?>" data-date-format="yyyy-mm-dd" style="width:10em;">
                              <input class="form-control" name="fihatarido_<?=$og['ID']?>" id="fihatarido_<?=$og['ID']?>" type="dateISO" required placeholder="éééé-hh-nn" value="<?=$og['FizetesiHatarido']?>">
                              <div class="input-group-addon">
                                  <span class="glyphicon glyphicon-th"></span>
                              </div>
                            </div>
                            <label style="color:#000;">Fizetés&nbsp;dátuma:</label>
                              <div class="input-group date" data-provide="datepicker" id="fdatum_<?=$og['ID']?>" data-date-format="yyyy-mm-dd" style="width:10em;">
                                <input class="form-control" name="fidatum_<?=$og['ID']?>" id="fidatum_<?=$og['ID']?>" type="dateISO" required placeholder="éééé-hh-nn" value="<?=$og['FizetesDatuma']?>" >
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                              </div>
                              <div style="margin-top:0.5em;">
                                <button class="btn btn-sm btn-success" onclick='if(confirm("Menti a változásokat?")){savePaidStatus(<?=$og['ID']?>)};$("#tr_<?=$og['ID']?>").removeClass("highlight");'>Mentés</button>
                                <button class="btn btn-sm btn-danger" onclick='$("#tr_<?=$og['ID']?>").removeClass("highlight");$(".popover").popover("hide");'>Mégsem</button>
                              </div>
                        </template>

                        <table style="font-size:80%;">
                            <tr>
                                <td rowspan="2">
                                  <a tabindex="1" data-toggle="popover" id="fs_<?=$og['ID']?>" class="btn btn-xs btn-primary " title="<span style='color:#000'>Sátusz módosítása</span>" style="background:<?=F_S_SZINEK[$og['FizetesStatusza']][0]?>;border-color:<?=F_S_SZINEK[$og['FizetesStatusza']][0]?>;font-weight:bold;font-size:100%;" onclick="$('#tr_<?=$og['ID']?>').addClass('highlight');">
                                      <i class="fa fa-<?=F_S_SZINEK[$og['FizetesStatusza']][1]?> fa-fw"></i>
                                  </a>
                                </td>
                                <td style="padding-left:0.5em;">
                                  <?=($og['FizetesiHatarido'] <= date('Y-m-d') && $og['FizetesStatusza']==F_S_FIZETESRE_VAR ? '<span style="color:red;"><b>H:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>H:</b>&nbsp;').$og['FizetesiHatarido']?></span>
                                </td>
                            </tr>
                            <tr>
                              <td  style="padding-left:0.5em;">
                                <?=($og['FizetesDatuma'] > $og['FizetesiHatarido'] && $og['FizetesStatusza']==F_S_FIZETVE ? '<span style="color:red;"><b>T:</b>&nbsp;<i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;':'<span><b>T:</b>&nbsp;').$og['FizetesDatuma']?></span>
                              </td>
                            </tr>
                        </table>

                    </td>
                        <script>
                            $("#fs_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'bottom',
                                trigger: 'click',
                                content: function () {
                                    return $('#div_fs_<?=$og['ID']?>').html();
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");}).on('show.bs.popover',function (){$('.popover').popover('hide');});

                        </script>


<?php } ?>
                    <td>
                        <div style="overflow:auto; font-size:80%;min-width:35em;" class="megj" id="megj_div_<?=$og['ID']?>" data-toggle="popover">
                            <?=renderMessages($og['Megjegyzes'], $desc = false)?>
                        </div>
                        <template id="megj_templ_<?=$og['ID']?>" >

                          <?=newMessage('megrendeles', $og['ID'],$msgDivID="megj_div_".$og['ID'],$callback="newMsgDone('megj_div_".$og['ID']."');");?>
                        </template>
                        <script>
                            $("#megj_div_<?=$og['ID']?>").popover({
                                html: true,
                                placement: 'left',
                                trigger: 'click',
                                content: function () {
                                    return $('#megj_templ_<?=$og['ID']?>').html();
                                }
                            }).on('hidden.bs.popover', function (){$("#tr_<?=$og['ID']?>").removeClass("highlight");}).on('show.bs.popover',function (){$('.popover').popover('hide'); });

                        </script>

                    </td>

<?php if($editButtonON || $trashButtonON){?>

                    <td>
<?php if($editButtonON){?>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editorWin" data-id="<?=$og['ID']?>">
  <span class="glyphicon glyphicon-cog"></span>
</button>
<?php } ?>
<?php if($trashButtonON && $og['Statusz'] == M_S_FELDOLGOZAS_ALATT){?>
<button type="button" class="btn btn-danger btn-sm" onclick="deleteOrder(<?=$og['ID']?>);" >
  <span class="glyphicon glyphicon-trash" ></span>
</button>
<?php } ?>


                    </td>
<?php } ?>
                </tr>
                <?php } ?>
        </tbody>
    </table>


<template id="itemAddForm">
<div style="background:#fff;border-radius:2em;padding:1em;">
  <div style="font-weight:bold; font-size:150%;" id="add_cim">--</div>
  <form id="newItemForm" action="?<?=$_SERVER['QUERY_STRING']?>" method="post">
    <p>
      <label style="width:9em;">ID: </label><input name="add_mtid2" id="add_mtid2" value="-" disabled="disabled" />
    </p>
    <p>
      <label style="width:9em;">Fafaj: </label><select name="add_fafaj" id="add_fafaj"><?php foreach(array_keys(FATIPUSOK) as $ft){
      echo "<option value='".$ft."'>".FATIPUSOK[$ft][0]."</option>";
    }?></select>
    </p>
    <p>
      <label style="width:9em;">Hossz: </label><select name="add_hossz" id="add_hossz"><?php foreach(orderGetHosszak() as $ha){
      echo "<option value='".$ha."'>".$ha." cm</option>";
    }?></select>
    </p>
    <p>
      <label style="width:9em;">Húrátmérő: </label><select name="add_huratmero" id="add_huratmero"><?php foreach(orderGetHuratmerok() as $ha){
      echo "<option value='".$ha."'>".$ha." cm</option>";
    }?></select>
    </p>
    <p>
      <label style="width:9em;">Csomagolás: </label><select name="add_csomagolas" id="add_csomagolas" onchange="$('#add_me').html($(this).find(':selected').attr('data-me'))"><?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $cst){
      echo "<option value='".$cst."' data-me='".CSOMAGOLASTIPUSOK[$cst][1]."'>".CSOMAGOLASTIPUSOK[$cst][0]."</option>";
    }?></select>
    </p>
    <p>
      <label style="width:9em;">Mennyiség: </label><input name="add_mennyiseg" id="add_mennyiseg" value="0" type="number" minx="0" />&nbsp;<span id="add_me"><?=CSOMAGOLASTIPUSOK[array_keys(CSOMAGOLASTIPUSOK)[0]][1]?></span>
    </p>
    <p>
      <label style="width:9em;">Nedvesség: </label><select name="add_nedvesseg" id="add_nedvesseg"><?php foreach(array_keys(NEDVESSEG) as $cst){
      echo "<option value='".$cst."' >".NEDVESSEG[$cst][1]."</option>";
    }?></select>
    </p>
    <p>
      <label style="width:9em;">Ár: </label><input name="add_ar" id="add_ar" value="0" type="number" minx="0" />
    </p>
    <p>
      <label style="width:9em;">Pénznem: </label><span id="add_curr"  class="label label-default">--</span>
    </p>
    <p>
      <input type="hidden" name="addNewItem" value="1" />
      <input type="hidden" name="add_mtid" id="add_mtid" value="0" />
      <input type="hidden" id="add_kertdatum" name="add_kertdatum" value="--" />
      <input type="hidden" id="add_mid" name="add_mid" value="0" />
      <input class="btn btn-sm btn-success" type="submit" value="Mentés"/>
      <button class="btn btn-sm btn-danger" type="button" onclick="restoreItemDiv()">Mégsem</button>
    </p>
  </form>
</div>
</template>
    <script>
    document.rdivid = -1;
    document.rdivcnt = '';

    $.validator.addMethod('minx', function (value, el, param) {
        return value > param;
    }, function(params, element) {
        return params + '-nál nagyobb érték szükséges.'
    });

    function deleteOrder( oid ){
        if(confirm("Biztosan törli a rendelést? (ID: "+oid+") Visszamondás esetén használja a 'visszamondott' státuszt!")){
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/delete_order.php",
                    data: ({'ID':oid}),
                    success: function(data){
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Hiba!");
                    }
                });

        };
    }


    function saveNewManufacturer(lid, gy){
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_new_manufacturer.php",
            data: ({'ID':lid, 'Gyarto': gy}),
            success: function(data){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Hiba!")
            }
        });
    }

    function saveExtMfStatus(lid, st){
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_ext_mf_status.php",
            data: ({'ID':lid, 'Status': st}),
            success: function(data){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Hiba!")
            }
        });
    }

    function saveStatus(lid, nst){
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_state_order.php",
            data: ({'ID':lid, 'Statusz':nst}),
            success: function(data){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Hiba!")
            }
        });
    }

    function prepareAjaxForm(){
      $("#newItemForm").submit(function(e) {
        if(!$("#newItemForm").valid()){
          return;
        }
        var url = "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/add_edit_order_item.php";
        $.ajax({
               type: "POST",
               url: url,
               data: $("#newItemForm").serialize(),
               success: function(data)
               {
                   alert("Rögzítve!");
                   location.reload();
               }
             });
        e.preventDefault();
      });
    }


    function addItem(orderID, currency, expDate){
      if(document.rdivid != -1){
        alert("Mentse el vagy zárja be a már megnyitott szerkesztőablakot, mielőtt újat nyitna.");
        return;
      };

      $("#newItemForm").trigger('reset');
      var rdiv = $('#megrendeles_reszletek_'+orderID);
      document.rdivcnt = rdiv.html();
      document.rdivid = orderID;
      rdiv.off('click');
      $('#megrendeles_reszletek_'+orderID).html($('#itemAddForm').html());
      $('#add_cim').html('Új tétel');
      $('#add_kertdatum').val(expDate);
      $('#add_mid').val(orderID);
      $('#add_curr').html(currency);
      $('#newItemForm').validate();
      prepareAjaxForm();
    }

    function editItem(orderID,orderLineID,currency, expDate, fafaj,hossz,huratmero,csomagolas,mennyiseg,nedvesseg,ar){
      if(document.rdivid != -1){
        alert("Mentse el vagy zárja be a már megnyitott szerkesztőablakot, mielőtt újat nyitna.");
        return;
      };

      $("#newItemForm").trigger('reset');
      var rdiv = $('#megrendeles_reszletek_'+orderID);
      document.rdivcnt = rdiv.html();
      document.rdivid = orderID;
      rdiv.off('click');
      $('#megrendeles_reszletek_'+orderID).html($('#itemAddForm').html());
      $('#add_cim').html('Tétel szerkesztése');
      $('#add_kertdatum').val(expDate);
      $('#add_mid').val(orderID);
      $('#add_curr').html(currency);
      $('#add_mtid').val(orderLineID);
      $('#add_mtid2').val(orderLineID);

      $('#add_ar').val(ar);
      $('#add_mennyiseg').val(mennyiseg);
      $('#add_fafaj option[value="'+fafaj+'"]').prop('selected', true);
      $('#add_hossz option[value="'+hossz+'"]').prop('selected', true);
      $('#add_huratmero option[value="'+huratmero+'"]').prop('selected', true);
      $('#add_csomagolas option[value="'+csomagolas+'"]').prop('selected', true);
      $('#add_nedvesseg option[value="'+nedvesseg+'"]').prop('selected', true);
      $('#newItemForm').validate();
      prepareAjaxForm();
    }

    function restoreItemDiv(){
        if(!document.rdivcnt){
          return;
        }
        var rdiv = $('#megrendeles_reszletek_'+document.rdivid);
        rdiv.html(document.rdivcnt);
        rdiv.on('click');
        document.rdivid = -1;
        document.rdivcnt = '';

    }

    function reszletek(oid){
      var rdiv = $("#megrendeles_reszletek_"+oid);
      var rdivcnt = rdiv.html();
      $("#megrendeles_reszletek_"+oid).load('/ajax/order_items_details.php?id='+oid);
      rdiv.click(function (){rdiv.html(rdivcnt);});
    }

    function delItem(itemID){
      if(confirm('Biztosan törli a tételt (ID: '+itemID+')?')){
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/delete_order_item.php",
            data: ({'ID':itemID}),
            success: function(data){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Hiba!");
            }
        });
      }
    }
    function newMsgDone(popid){
      $("#"+popid).popover('hide');
      $("#"+popid).animate({scrollTop: $("#"+popid).prop('scrollHeight')},1000);
    }

    function savePaidStatus(lid, ext = false, st = '', datum = '', hatarido = ''){
        var aData;
        if(ext == false){
          aData = (
            {
              'ID':lid,
              'Statusz':$("input[name=fizst_rad_"+lid+"]:checked").val(),
              'Datum': $("#fidatum_"+lid).val(  ),
              'Hatarido': $("#fihatarido_"+lid).val( ),
              'Ext':0
            }
          );
        }
        else {
          aData = {
            'ID':lid,
            'Statusz': st,
            'Datum': datum,
            'Hatarido': hatarido,
            'Ext':1
          }
        }
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_state_paid.php",
            data: aData,
            success: function(data){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Hiba (fizetés állapota) "+ textStatus + " - "+errorThrown +" !")
            }
        });
    }
    function isNumeric(n){
      return ! isNaN(parseFloat(n)) && isFinite(n);
    }
    function saveShippingPrice(lid){
        var aData = (
          {
            'ID':lid,
            'SzallitasiDij': $("#szallktsg_"+lid).val( )
          }
        );
        if(! isNumeric(aData['SzallitasiDij']))
        {
          alert('Hibás szállítási díj');
          return;
        }
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_shipping_price.php",
            data: aData,
            success: function(data){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Hiba!")
            }
        });
    }


    function saveShippingStatus(lid, rtip){
        var aData = (
          {
            'ID':lid,
            'Statusz':$("input[name=szst_rad_"+lid+"]:checked").val(),
            'Datum': $("#szidatum_"+lid).val(  ),
            'Hatarido': $("#szihatarido_"+lid).val( ),
            'Szlev': $("#szszlev_"+lid).val(),
            'Szsz': $("#szsz_"+lid).val(),
            'CMR': $("#szcmr_"+lid).val(),
            'EKAER': $("#szekaer_"+lid).val(),
            'Fuvarozo': $("#szfuvarozo_"+lid).val()
          }
        );
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_state_shipping.php",
            data: aData,
            success: function(data){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Hiba (szállítás állapota): "+textStatus+ " - " +errorThrown+" !" )
            }
        });
        // ha lakossagi es kiszallitva, akkor legyen fizetve is
        if(rtip == '<?=M_LAKOSSAGI?>' && $("input[name=szst_rad_"+lid+"]:checked").val() == '<?=SZ_S_LESZALLITVA?>'){
          savePaidStatus(lid, ext = true, st = '<?=F_S_FIZETVE?>', datum = $("#szidatum_"+lid).val(  ), hatarido = '');
        }
    }



        $(function () {
            document.dtab  = $('#megrendelt_tetelek').DataTable({
                "scrollX": true,
                "stateSave": true,
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
                "columns": [
                    null,   // ID
                    {
                        'searchable': false,
                        'orderable': false
                    },      // status icon
                    null,   // type
                    null,   // prio
<?php if($customerON){ ?>
                    null,   // customer
<?php } ?>
                    null,   // order date
                    null,   // promised date
                    null,   // status
                    null,   // manufacturer
                    {
                        'orderable': false,
                    },
<?php if($shippingON || $shippingEditON){ ?>
                    null,   // szallitas statusz
<?php } ?>
<?php if($priceON){ ?>
                    {       // ar
                        'orderable': false,
                    },
<?php } ?>
<?php if($paymentON){ ?>
                    null,   // fizetes statusz
<?php } ?>

                    {   // megjegyzes
                        'orderable': false,
                    },
<?php if($editButtonON || $trashButtonON){?>
                    {   // muvelet
                        'searchable': false,
                        'orderable': false
                    },
<?php } ?>
            ],
            }
          );






            // ugly hack to fix column headers
            setTimeout(function () {
                $('.megj').each(function (i, obj) {
                    $(obj).css('max-height', $(obj).parent().height() + 'px').css('display', 'block');
                });
                $("#megrendelt_tetelek").dataTable().fnAdjustColumnSizing();

                //initCustomerPopovers();
            }, 500);

           $('#megrendelt_tetelek').on("click", '*[customer-id]',
            function(){
              var e = $(this);

              $('.popover').popover('hide');
              //e.off('click');

              $.get('/ajax/<?=(in_array(R_ADMINISZTRACIO, $_SESSION['userRights'])?'editCustomerData':'getCustomerData')?>.php?id='+e.attr('customer-id'), function(data){
                e.popover({
                  content: data,
                  html:true,
                  placement:'bottom',
                  trigger:'click',
                }).popover('toggle');
              })

            }
          );



        });
      /*  function getCustomerDetails(){
          var el = $(this);
          var i = el.attr('customer-id');
          $.get('/ajax/getCustomerData.php?id='+i, function(data){
            el.popover({content: data})
          });
        }*/
    </script>

<?php } ?>
