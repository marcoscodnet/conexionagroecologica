<?php
include_once('php/includes/definer.php');
include('php/checkers/login.checker.php');
include('php/controllers/borrarImagenesHuerfanas.controller.php');
?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
    <script><?php include('php/includes/definer.js'); ?></script>
    <title>Conexi&oacute;n Agroecol&oacute;gica - Administrador</title>
    <?php include('tpl/head.tpl'); ?>
    <style>
        /*summer note*/
        .note-editor {
            font-size: 14px;
            font-family: 'Open Sans', 'Sans Serif';
        }
        /*fin summer note*/
        @media only screen and (min-width: 320px) {
            .superbox-list {
                width: 49%;
            }
        }
        @media only screen and (min-width: 486px) {
            .superbox-list {
                width: 24.2%;
            }
        }
        @media only screen and (min-width: 768px) {
            .superbox-list {
                width: 16.3%;
            }
        }
        @media only screen and (min-width: 1025px) {
            .superbox-list {
                width: 12.2%;
            }
        }
        @media only screen and (min-width: 1824px) {
            .superbox-list {
                width: 12.3%;
            }
        }
        .superbox-img:hover {
            opacity: 1;
        }
        .superbox-list a.btn-danger {position: absolute; right: 6px; bottom: 6px}
        .superbox-list a.btn-primary {position: absolute; right: 45px; bottom: 6px}
        .superbox-list a.hide {display: block !important}
        .superbox-list .btn:active {position: absolute; top: inherit !important; left: inherit !important}
        .superbox-img {cursor: move}
    </style>
</head>

<body class="">

    <?php 
        include('tpl/header.tpl') ;
        include('tpl/menu.tpl');
    ?>

    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php include('php/printers/caso.printer.php'); ?>
    </div>
    <!-- /MAIN PANEL -->

    <?php 
        include('tpl/footer.tpl');
        include('tpl/scripts.tpl');
        include('tpl/modal.tpl');
    ?>
    <textarea class="hidden" id="superboxItem"><?php include('tpl/superbox-item.tpl'); ?></textarea>
    
    <script src="js/plugin/jquery-form/jquery-form.min.js"></script>
    <script src="js/Replacer.js"></script>
    <script src="js/caso.js"></script>
    

</body>
</html>