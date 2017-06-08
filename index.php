<?php
session_start();

require_once("lib/config.php");

if(DEBUG){
    error_reporting(E_ALL);
}

require_once("vendor/medoo.php");
require_once("lib/db.php");
require_once("lib/log.php");
require_once('lib/log_events.php');
require_once("lib/utility.php");
require_once("lib/users.php");
require_once("lib/export_customers.php");
require_once("lib/packaging.php");
require_once("lib/wood.php");
require_once("lib/units.php");
require_once("lib/order.php");
require_once("lib/messages.php");
require_once("lib/prices.php");
require_once("lib/mail.php");
require_once("core/auth.php");

$_mode = $_GET['mode'];

$mode = '';

// is there a logout attempt?
// has the session timeout'ed?
$sessionTimeout = ((time()-$_SESSION['lastActivity']) > SESSION_TIMEOUT) ? 1 : 0;
if($_mode == 'logout' || (!empty($_SESSION['activeLogin']) && $sessionTimeout)){
    session_destroy();
    $loginUrl = SERVER_PROTOCOL . SERVER_URL . '?mode=login&redirect=' . $_GET['mode'].($sessionTimeout ? '&timeout=true':'');
    if($sessionTimeout){
      logEv(LOG_EVENT['timeout'].':',null,"User: ".$_SESSION['userName']);
    }
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
        if(isset($_GET['timeout'])){
          $loginTimeout = True;
        }
        if(!empty($_POST['user'])){
            // login with username and password

            if(authenticate($_POST['user'], $_POST['password'])){
                // TODO - do proper authentication
                $_SESSION['activeLogin'] = True;
                $_SESSION['lastActivity'] = time();
                $_SESSION['userName'] = $_POST['user']; // FIXME - protect, check, etc.
                // TODO - reject if incorrect credentials, set $loginError
                $_mode = empty($_GET['redirect']) ? 'main' : $_GET['redirect'];
                // log the login event
                logEv(LOG_EVENT['login'].':',null,"User: ".$_SESSION['userName']);
            }
            else {
                $loginError = True;
                $_SESSION['activeLogin'] = False;
                $_mode = 'login';
                logEv(LOG_EVENT['bad_password'].':',null,"User: ".$_POST['user']);

            }
        }
    }
}
// TODO if redirect=logout, error occures
if(!empty($_SESSION['activeLogin'])) {
    // get user data
    $_SESSION['realName'] = getUserFullName($_SESSION['userName']);
    $_SESSION['lastActivity'] = time();
    $_SESSION['userRights'] = getUserRights($_SESSION['userName']);
    $_SESSION['userID'] = getUserID($_SESSION['userName']);
    if(empty($_mode) || $_mode == 'login'){
        $_mode = 'main';
    }
    // if the user has only right for "lakossagi megrendelesek", redirect to the new order page
    if($_SESSION['userRights'] == [R_LAK_MEGRENDELES]){
        $_mode = 'lakossagi-uj-megrendeles';
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
        $errorMessage = 'a "'.$_mode.'" modul nem létezik!';
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
        <link rel="shortcut icon" type="image/png" href="/img/logo.png">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.min.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <link href="css/bootstrap-select.min.css" rel="stylesheet">
        <link href="css/bootstrap-slider.min.css" rel="stylesheet">
        <link href="css/bootstrap-toggle.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">


        <script src="js/jquery.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/messages_hu.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/datatables.min.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="js/bootstrap-datepicker.hu.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script src="js/i18n/defaults-hu_HU.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/bootstrap-toggle.min.js"></script>
        <script src="js/jquery.showandtell.js"></script>


        <script>
            $.validator.setDefaults({
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $.fn.datepicker.defaults.format = "yyyy-mm-dd";
            $.fn.datepicker.defaults.language = "hu";
            $.fn.datepicker.defaults.todayHighlight = true;
            $.fn.datepicker.defaults.autoclose = true;
        </script>
    </head>

    <body>

        <?php if($mode != 'login'){
            require('pages/nav.php');
        ?>
            <div style='height:6em;'>&nbsp;</div>
            <?php
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
                <?php
        if(DEBUG){
            require_once('debug.php');
        }

?>

    </body>

    </html>
