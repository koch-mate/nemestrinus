<!-- Modal -->
<div id="modalUzenet" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=(!empty($failMessage)?'Hiba':'Értesítés')?></h4>
            </div>
            <div class="modal-body">
                <?php if(!empty($succMessage)){ ?>
                    <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-glyphicon-ok" aria-hidden="true"></span>
                        <?=$succMessage?>
                    </div>
                    <?php } 
if(!empty($failMessage)){ 
?>
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <?=$failMessage?>
                        </div>
                        <?php } ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>

    </div>
</div>
<?php

if(!empty($failMessage) || !empty($succMessage)){?>
    <script>
        $(document).ready(function () {
            $("#modalUzenet").modal();
        });
    </script>

    <?php }?>