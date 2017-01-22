<?php
session_start();

require_once("lib/config.php");

if(DEBUG){
    error_reporting(E_ALL);
}

require_once("vendor/medoo.php");
require_once("lib/utility.php");
require_once("lib/db.php");
require_once("core/auth.php");

$_mode = $_GET['mode'];

$mode = '';

// is there a logout attempt?
// has the session timeout'ed?
if($_mode == 'logout' || (!empty($_SESSION['activeLogin']) && (time()-$_SESSION['lastActivity']) > SESSION_TIMEOUT)){
    session_destroy();
    $loginUrl = SERVER_PROTOCOL . SERVER_URL . '?mode=login';
    header('Location: ' . $loginUrl);
    die('logout redirecion failed');
}

// has the user logged in?
$mode = 'login';
if(empty($_SESSION['activeLogin'])){
    // not logged in, redirect to login
    if($_mode != 'login')
    {
        $loginUrl = SERVER_PROTOCOL . SERVER_URL . '?mode=' . $mode . '&redirect=' . $_GET['mode'];
        header('Location: ' . $loginUrl);
        die('login redirection failed');
    }
    else
    {
        if(!empty($_POST['user'])){
            // login with username and password
            
            if(authenticate($_POST['user'], $_POST['password'])){
                // TODO - do proper authentication
                $_SESSION['activeLogin'] = True;
                $_SESSION['lastActivity'] = time();
                $_SESSION['userName'] = $_POST['user']; // FIXME - protect, check, etc.
                // TODO - reject if incorrect credentials, set $loginError
                $_mode = empty($_GET['redirect']) ? 'main' : $_GET['redirect'];
            }
            else {
                $loginError = True;
                $_SESSION['activeLogin'] = False;
                $_mode = 'login';
            }
        }
    }
}
if(!empty($_SESSION['activeLogin'])) {
    // get user data
    $_SESSION['realName'] = getUserFullName($_SESSION['userName']); 
    $_SESSION['lastActivity'] = time();
    $_SESSION['userRights'] = getUserRights($_SESSION['userName']); 
    if(empty($_mode) || $_mode == 'login'){
        $_mode = 'main';
    }
    if(in_array($_mode, IMPLEMENTED_PAGES))
    {
        // find rootNode
        
        if(!in_array('', $_SESSION['userRights'])) {}  //TODO!!!!!
        $mode = $_mode;
        // TODO - check for privileges 
    }
    else {
        $mode = 'error';
        $errorMessage = '"'.$_mode.'" is not implemented';
    }
}
else {
    // back to login
    $mode = 'login';
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nemestrinus -
            <?=MENU_NAMES[$mode]  //FIXME ?>
        </title>
        <link rel="shortcut icon" type="image/png" href="/img/logo.png" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="css/datepicker.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <script src="js/jquery.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/messages_hu.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
    </head>

    <body>

        <?php if($mode != 'login'){ 
            require('pages/nav.php');
        ?>
            <div style='height:6em;'>&nbsp;</div>
            <?php 
        }
        if(DEBUG){ 
            require_once('debug.php');
        }

        ?>
                <div class="container">
                    <div class="bodyContainer">

                        <div class="starter-template">
                            <?php 
                            require('pages/'.$mode.'.php');
                            ?>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('.datepicker').datepicker({
                            format: "yyyy-mm-dd",
                        });
                    });
                </script>
    </body>

    </html>