<?php
error_reporting(E_ALL);

$_mode = $_GET['mode'];

$implemented_pages = array(
    'uj-lakossagi-megrendeles',
    'uj-export-megrendeles',
    'lakossagi-megrendeles-attekintes',
    'export-megrendeles-attekintes',
    'lakossagi-megrendeles-osszesites',
    'export-megrendeles-osszesites',
    'login',
    'felhasznalok',
    'gyartas',
    'szallitas',
    'fakitermeles',
    'szemelyes-beallitasok',
    'export-megrendelok',
    'naplo'
);

$mode = 'login';

if(in_array($_mode, $implemented_pages))
{
    $mode = $_mode;
}


?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nemestrinus</title>
        <link rel="shortcut icon" type="image/png" href="/img/logo.png" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="css/datepicker.css" rel="stylesheet">
        <style type="text/css">
            html,
            body {
                width: 100%;
                height: 100%;
                margin: 0px;
            }
            
            body {
                padding-top: 70px;
            }
            
            .btn {
                margin-bottom: 2px;
            }
        </style>
        <style>
            img:hover {
                z-index: 2;
                -webkit-transition: all 200ms ease-in;
                -webkit-transform: scale(4);
                -ms-transition: all 200ms ease-in;
                -ms-transform: scale(4);
                -moz-transition: all 200ms ease-in;
                -moz-transform: scale(4);
                transition: all 200ms ease-in;
                transform: scale(4);
            }
        </style>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
    </head>

    <body>
        <?php include('nav.php');?>
            <div class="container">

                <div class="starter-template">
                    <?php 
                include($mode.'.php');
                ?>
                </div>
            </div>
            <!-- /.container -->
            <script>
                $(document).ready(function () {
                    $('.datepicker').datepicker({
                        format: "yyyy-mm-dd",
                    });
                });
            </script>
    </body>


    </html>