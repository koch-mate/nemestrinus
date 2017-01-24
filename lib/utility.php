<?php

// collection of utility functions

function userExists($u){
    global $db;
    if($db->has('user', ['UserName' => $u])) {
        return True;
    }
    else {
        return False;
    }
}

function userAdd($user, $tn, $pass, $email, $r, $akt){
    global $db;
    $db->insert('user', [
        'UserName'  => $user,
        'TeljesNev' => $tn,
        'Password'  => $pass,
        'Email'     => $email,
        'Jogok'     => $r,
        'Aktiv'     => $akt
    ]);
    // TODO: send email notification about new passwd

    return True;
}
function userUpdate($user, $tn, $pass, $email, $r, $akt){
    global $db;
    if(!empty($pass)){
    $db->update('user', [
        'TeljesNev' => $tn,
        'Password'  => $pass,
        'Email'     => $email,
        'Jogok'     => $r,
        'Aktiv'     => $akt
    ], ['UserName' => $user]);
        // TODO: send email notification about new passwd
    }
    else {
    $db->update('user', [
        'TeljesNev' => $tn,
        'Email'     => $email,
        'Jogok'     => $r,
        'Aktiv'     => $akt
    ], ['UserName' => $user]);
    }
    return True;
}

function getUsersWithData() {
    global $db;
    return $db->select('user', ['ID', 'UserName', 'TeljesNev', 'Password', 'Email', 'LastLogin', 'Jogok', 'Aktiv'], ['Deleted'=> 0]);
}

function getUserDataById($uid){
    if(empty($uid)){
        return False;
    }
    global $db;
    return $db->select('user', ['ID', 'UserName', 'TeljesNev', 'Password', 'Email', 'LastLogin', 'Jogok', 'Aktiv'], ['AND' =>['ID'=>$uid, 'Deleted'=> 0]]);    
}


function userDelete($u){
    global $db;
    $db->update('user', ['Deleted'=>1], ['UserName'=>$u]);
}

function userStatusToggle($u){
    global $db;
    $s = intval($db->get('user', 'Aktiv', ['UserName'=>$u]));
    $db->update('user', ['Aktiv'=>(1-$s)], ['UserName'=>$u]);
}
?>