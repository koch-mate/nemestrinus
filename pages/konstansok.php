<h1>Konstansok</h1>

<table class="table table-hover table-striped">
    <thead>
        <tr>
        <th></th>
<?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $cst) { ?> 
        <th><?=CSOMAGOLASTIPUSOK[$cst][0]?></th>
<?php }?>   
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Ikon</th>
<?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $cst2) { ?> 
            <td><img src="/img/<?=$cst2?>.png" style="height:2em;"></td>
<?php }?>               
        </tr>
        <tr>
            <th>Mértékegység</th>
<?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $cst2) { ?> 
            <td><?=CSOMAGOLASTIPUSOK[$cst2][1]?></td>
<?php }?>               
        </tr>
        <tr>
        <th colspan="<?=count(CSOMAGOLASTIPUSOK)+1?>" style="text-align:center;">Átváltások (1 egység = X)</th>
        </tr>
<?php foreach(array_keys(U_NAMES) as $us) { ?> 
        <tr>
            <th><?=mb_ucfirst(U_NAMES[$us][0])?></th>
<?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $cst2) { ?> 
            <td><?=rnd(unitChange(CSOMAGOLASTIPUSOK[$cst2][3], $us, CSOMAGOLASTIPUSOK[$cst2][2]))?>&nbsp;<?=U_NAMES[$us][1]?></td>
<?php }?>   
        
        </tr>
<?php }?>   
        <tr>
            <th colspan="<?=count(CSOMAGOLASTIPUSOK)+1?>"  style="text-align:center;">Felhasznált csomagolóanyagok</th>
        </tr>
        
        <?php foreach(array_keys(CSOMAGOLOANYAGOK) as $cs){ ?>
        <tr>
            <th><?=CSOMAGOLOANYAGOK[$cs][0]?></th>
            <?php foreach(array_keys(CSOMAGOLASTIPUSOK) as $cst2) { ?> 
            <td><?=CS_FELHASZNALAS[$cst2][$cs]?>&nbsp;<?=CSOMAGOLOANYAGOK[$cs][1]?></td>
<?php }?>   

        </tr>
        <?php } ?>
    </tbody>
    
</table>