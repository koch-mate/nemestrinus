<div class="debug" id="debug_div" style="display:none;">
    <div style="text-align:right;"><a href="#" onclick="$('#debug_div').fadeOut();">X</a></div>
    <table>
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
        <?php
        $debug_names = [
            ['activeLogin',$_SESSION['activeLogin']],
            ['lastActivity',$_SESSION['lastActivity']],
            ['userName',$_SESSION['userName']],
            ['realName',$_SESSION['realName']],
            ['userRights',implode(", ",$_SESSION['userRights'])],
            ['activeLogin',$_SESSION['activeLogin']],
                       ];
        foreach($debug_names as $dn){
?>
            <tr>
                <td>
                    <?=$dn[0]?>
                </td>
                <td style="text-align:right;">
                    <?=$dn[1]?>
                </td>
            </tr>
            <?php }
            ?>
    </table>
    <div>
        <?php var_dump($db->log());?>
            <?php // print_r($db->info());?>
    </div>
</div>
