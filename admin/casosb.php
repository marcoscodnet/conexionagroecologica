<?php 
    include_once('php//includes/definer.php');
    include('php/checkers/login.checker.php');
    //include(INC.'php/bootstrap.php');
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
        <?php include('tpl/casos.tpl'); ?>
    </div>
    <!-- /MAIN PANEL -->

    <?php 
        include('tpl/footer.tpl');
        include('tpl/scripts.tpl');
        include('tpl/modal.tpl');
    ?>
    
    <script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="js/plugin/datatables/i18n/spanish.js"></script>
    
    <script src="js/boxMessage.js"></script>
    <script src="js/casos.js"></script>

</body>
</html>