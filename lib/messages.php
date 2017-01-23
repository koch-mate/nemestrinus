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