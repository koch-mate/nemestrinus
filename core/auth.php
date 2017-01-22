<?php

// authentication
function authenticate($user, $pw){
    global $db;
    if($db->has('user', ['AND' => ['UserName' => $user, 'Password' => $pw, 'Aktiv' => 1]])) {
        $db->update('user', ['LastLogin' => date('Y-m-d H:i:s')], ['UserName' => $user]);
        return True;
    }
    else {
        return False;
    }
}

function getUserData($user, $data){
    global $db;
    return $db->get('user', $data, ['UserName'=>$user]);    
}

function getUserFullName($user){
    return getUserData($user, 'TeljesNev');
}

function getUserEmail($user){
    return getUserData($user, 'Email');
}

function getUserLastLogin($user){
    return getUserData($user, 'LastLogin');
}

function getUserRights($user){
    $r = getUserData($user, 'Jogok');
    return unserialize($r);
}

function userUpdatePassword($old, $new, $user = ''){
    if(empty($user)){
        $user = $_SESSION['userName'];
    }
    global $db;
    if( $db->has('user', ['AND' => ['UserName' => $user, 'Password' => $old, 'Aktiv' => 1]])){
        $db->update('user',['Password'=>$new],['UserName'=>$user]);
        return True;
    }
    return False;
}
?>