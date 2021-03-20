<?php
session_start();
include_once('php/clases/Archivo.php');
include_once('php/clases/Includer.php');
include_once('php/includes/defined.php');
include_once('php/bootstrap.php');
$html = Archivo::leer('tpl/header.html');
$html = str_replace('<!--{recursoJs}-->', Includer::addJs('jquery-1.6.1.min', 'jquery.colorbox', 'loginRegister',  'dropdown-menu', 'validadores', 'newsletter'), $html);
$html = str_replace('<!--{recursoCss}-->', Includer::addCss('reset', 'vistas', 'colorbox'), $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo($html);
?>
<body>
	
    
   

    <!-- CONTENIDO HOME -->
    
    <?php include_once('tpl/contenidoPopupConexion.php'); ?>
    
    <!-- FIN CONTENT WRAPPER -->

   
    
    
</body>
</html>