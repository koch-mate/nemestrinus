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
    return True;
}

function getUsersWithData() {
    global $db;
    return $db->select('user', ['ID', 'UserName', 'TeljesNev', 'Password', 'Email', 'LastLogin', 'Jogok', 'Aktiv']);
}

function getUserDataById($uid){
    if(empty($uid)){
        return False;
    }
    global $db;
    return $db->select('user', ['ID', 'UserName', 'TeljesNev', 'Password', 'Email', 'LastLogin', 'Jogok', 'Aktiv'], ['ID'=>$uid]);    
}
?>