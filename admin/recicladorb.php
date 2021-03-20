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
        /*tags input*/
        div.tagsinput {
            border: 1px solid #CCC;
            background: #FFF;
            padding: 5px;
            width: 300px;
            height: 100px;
            overflow-y: auto;
        }

        div.tagsinput div {
            display: inline-block;
        }
            
        div.tagsinput input {
            width: 80px;
            margin: 0px;
            font-family: helvetica;
            font-size: 13px;
            border: 1px solid transparent !important;
            padding: 5px;
            background: transparent;
            color: #000;
            outline: 0px;
            margin-right: 5px;
            margin-bottom: 5px;
        }
            
        .tags_clear {
            clear: both;
            width: 100%;
            height: 0px;
        }
            
        .tagsinput .tag {
            color: #FFF;
            position: relative;
            margin: 3px 0 3px 2px;
            display: inline-block;
            line-height: 13px
        }
            
        .tagsinput>span {
            border-radius: 0!important;
            font-weight: 400;
            padding: 3px 28px 4px 8px;
            font-size: 13px;
            border: 1px solid #285E8E;
            background: #3276B1;
        }
            
        .tagsinput .tag-remove {
            display: block;
            top: -1px;
            right: 0;
            padding: 3px;
            width: 13px;
            height: 16px;
            position: absolute;
            cursor: pointer;
        }
            
        .tagsinput .tag-remove:after {
            content: "\f057";
            font-family: fontAwesome;
            padding: 2px 1px;
            line-height: 17px;
            font-size: 15px;
            text-align: center;
        }
            
        .tagsinput .tag-remove:hover {
            background: rgba(0,0,0,.3);
        }
        .ui-menu .ui-menu-item a.ui-state-active, .ui-menu .ui-menu-item a.ui-state-focus, .ui-menu .ui-menu-item a.ui-widget-content {
            font-weight: 700;
            margin: 0;
            background-color: #428BCA;
            border-color: #357EBD;
            color: #FFF;
            display: block;
            white-space: normal;
        }
    </style>
</head>

<body class="">

    <?php 
        include('tpl/header.tpl') ;
        include('tpl/menu.tpl');
    ?>

    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php include('php/printers/reciclador.printer.php'); ?>
    </div>
    <!-- /MAIN PANEL -->

    <?php 
        include('tpl/footer.tpl');
        include('tpl/scripts.tpl');
        include('tpl/modal.tpl');
    ?>
    
    
    <script src="js/plugin/summernote/summernote.full.min.js"></script>
    <script src="js/plugin/summernote/summernote-es-ES.js"></script>
    <script src="js/plugin/jquery-form/jquery-form.min.js"></script>
    <script src="js/plugin/jquery-tagsinput/jquery.tagsinput.min.js"></script>
    
    <script src="js/Replacer.js"></script>
    <script src="js/reciclador.js"></script>
    

</body>
</html>