<?php

// authentication


function getUserRights($user, $db = 0){
    // TODO - implement
    $r = [
        'alapanyag', 'gyartas', 'megrendeles', 'kimutatas', 'adminisztracio'
    ];
    return $r;
}
?>