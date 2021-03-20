<?php
    include_once('php/includes/definer.php');
    include('../php/bootstrap.php');
    include('php/checkers/login.checker.php');
?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
    <script><?php include('php/includes/definer.js'); ?></script>
    <title>Conexi&oacute;n Reciclador - Administrador</title>
    <?php include('tpl/head.tpl'); ?>
</head>

<body class="">

    <?php 
        include('tpl/header.tpl') ;
        include('tpl/menu.tpl');
    ?>

    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php include('php/printers/nosApoyan.printer.php'); ?>
    </div>
    <!-- /MAIN PANEL -->

    <?php 
        include('tpl/footer.tpl');
        include('tpl/scripts.tpl');
    ?>    

    <script src="js/plugin/jquery-form/jquery-form.min.js"></script>
    <script src="js/Replacer.js"></script>
    <script src="js/ajaxImagesUploader.js"></script>
    <script src="js/plugin/jquery-tagsinput/jquery.tagsinput.min.js"></script>
    <script src="js/nosApoyan.js"></script>

</body>
</html>