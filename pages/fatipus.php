<h2>Fafajok</h2>


<table class="table table-striped table-hover display" >
    <thead style="font-weight:bold;">
        <tr>
            <th>Fafaj</th>
            <th>
                <?=ucfirst(F_KEMENY)?>
            </th>
            <th>
                <?=ucfirst(F_LAGY)?>
            </th>
            <th>
                <?=ucfirst(F_FENYOFELE)?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(array_keys(FATIPUSOK) as $ft){?>
            <tr>
                <th style="white-space:nowrap;">
                    <span style="display:inline-block;width:2em;"><img src="/img/<?=$ft?>.png" class="zoom" style="height:1em;"></span><?=FATIPUSOK[$ft][0]?>
                </th>
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
