<?php
// log writing

function getEvents(){
    global $db;
    return $db->select('naplo', ['ID', 'UserID', 'Timestamp', 'Action', 'OldValue', 'NewValue']
               ,["ORDER"=>['Timestamp'=>'DESC']]);
}

function logEv($ev, $old=null, $new=null){
    global $db;
    $db->insert('naplo', [
        'UserID'=>$_SESSION['userID'], 
        'Timestamp' =>date('Y-m-d H:i:s'),
        'Action' =>$ev,
        'OldValue'=>$old,
        'NewValue'=>$new
    ]);
}
?>