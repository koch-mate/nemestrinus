<?php

function getMsg($tabla, $id){
    global $db;
    return $db->get($tabla, 'Megjegyzes', ['ID'=> $id]);
}

function testMsg(){
    $testMessage = [[
        'u' => 'mkoch',
        'd' => date("Y-m-d H:m:s", time()-123367),
        'm' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum egestas felis ac ultricies. Quisque quis leo ultrices, vulputate tortor ac, laoreet turpis. Suspendisse est tortor, volutpat placerat venenatis non, laoreet id leo.'
        ],
        [
        'u' => 'mkoch',
        'd' => date("Y-m-d H:m:s",time()-12456),
        'm' => 'Fusce eu arcu et orci finibus.'
    ]];

    return (serialize($testMessage));
}

function renderMessages($_m){
    $msg = unserialize($_m);
    foreach($msg as $m){
        ?>
        <p><b><?=$m['d']?> - <?=getUserFullName($m['u'])?>:</b> <?=$m['m']?></p>
        <?php
    }
}

function newMessage($tabla, $id){
    ?>
        <button type="button" class="btn btn-primary " onclick="$(this).hide();$('#msg_new').fadeIn()">Új üzenet</button>
        <div id="msg_new" style="display:none;">
            <b><?=date('Y-m-d H:i:s')?> - <?=getUserFullName($_SESSION['userName'])?>:</b>
            <table style="width:100%;">
                <tr>
                    <td>
                        <textarea class="form-control" id="new_msg_text" style="height:4em;border-radius:4px 0 0 4px;"></textarea>
                    </td>
                    <td style="width:2em;">
                        <button type="button" class="btn btn-primary" style="height:4em;border-radius:0 8px 8px 0;position:relative;top:1px;" onclick="if($('#new_msg_text').val().length){saveNewMessage($('#new_msg_text').val())}">Ment</button>
                    </td>
                </tr>
            </table>
        </div>
        <script>
        function saveNewMessage( msg ){
            $("#renderMessages").addClass('loadMsg');
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?=SERVER_PROTOCOL.SERVER_URL?>ajax/save_new_message.php",
                data: ({ 'msg': msg, 'table': '<?=$tabla?>', 'id': '<?=$id?>' }),
                success: function(data){
                    // reload messages
                    loadMessages();
                    $("#renderMessages").removeClass('loadMsg');
                    // clear textarea
                    $('#new_msg_text').val('');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Hiba a rögzítés során!");
                    $("#renderMessages").removeClass('loadMsg');
                }
            });            
        }
        function loadMessages(){
            $('#renderMessages').load("<?=SERVER_PROTOCOL.SERVER_URL?>ajax/render_messages.php?table=<?=$tabla?>&id=<?=$id?>");
        }
        </script>
    <?php
}

function sortByDate($a, $b){
    return  $b[1]['d'] <=> $a[1]['d'];
}

function messagesGetLast($i){
    global $db;
    $msgs = $db->select('megrendeles',['ID','Megjegyzes'], ['Deleted'=>0]);
    $dm = [];
    foreach($msgs as $m){
        $ms = unserialize($m['Megjegyzes']);
        if(!empty($ms)){
            foreach($ms as $ims){
                $dm[] = [$m['ID'], $ims];
            }
        }
    }
    usort($dm, 'sortByDate');
    $n = 0;
    foreach($dm as $m){
        if($n ++ >= $i){
            break;
        }
        ?>
        <p><b><?=$m[1]['d']?> <a href="?mode=megrendeles-osszesites&id=<?=$m[0]?>">[ID: <?=$m[0]?>]</a> <?=getUserFullName($m[1]['u'])?>: </b> <?=$m[1]['m']?></p>
<?php
    }
}


function recordNewMessage($msg, $tabla, $id){
    global $db;
    $t = '';
    if($tabla == 'megrendeles'){
        $t = 'megrendeles';
    }
    if($t != ''){
        try {
            $cmsg = unserialize(getMsg($tabla, $id));
        }
        catch (Exception $e) {
            $cmsg = [];
        }
        
        $cmsg[] = [
            'u' => $_SESSION['userName'],
            'd' => date('Y-m-d H:i:s'),
            'm' => $msg
        ];
        
        $db->update($tabla, ['Megjegyzes' => $cmsg], ['ID'=>$id]);
    }
}


?>