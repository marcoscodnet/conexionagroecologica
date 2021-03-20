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
</head>

<body class="">

    <?php 
        include('tpl/header.tpl') ;
        include('tpl/menu.tpl');
    ?>

    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php include('php/printers/evento.printer.php'); ?>
    </div>
    <!-- /MAIN PANEL -->

    <?php 
        include('tpl/footer.tpl');
        include('tpl/scripts.tpl');
        include('tpl/modal.tpl');
    ?>
    
    <script src="js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="js/Replacer.js"></script>
    <script src="js/evento.js"></script>
    

</body>
</html>