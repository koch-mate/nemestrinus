<h2>Fatípusok</h2>


<table class="table table-striped table-hover display" style="width:60%;">
    <thead style="font-weight:bold;">
        <tr>
            <td>Fafaj</td>
            <td>
                <?=ucfirst(F_KEMENY)?>
            </td>
            <td>
                <?=ucfirst(F_LAGY)?>
            </td>
            <td>
                <?=ucfirst(F_FENYOFELE)?>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php foreach(array_keys(FATIPUSOK) as $ft){?>
            <tr>
                <td style="white-space:nowrap;">
                    <span style="display:inline-block;width:2em;"><img src="/img/<?=$ft?>.png" class="zoom" style="height:1em;"></span>&nbsp;<span class="label label-default"><?=FATIPUSOK[$ft][0]?></span>
                </td>
                <td>
                    <?=(FATIPUSOK[$ft][1]==F_KEMENY ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>':'')?>
                </td>
                <td>
                    <?=(FATIPUSOK[$ft][1]==F_LAGY ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>':'')?>
                </td>
                <td>
                    <?=(FATIPUSOK[$ft][1]==F_FENYOFELE ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>':'')?>
                </td>
            </tr>
            <?php }?>
    </tbody>
</table>