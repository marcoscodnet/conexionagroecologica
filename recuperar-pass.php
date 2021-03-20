<?php
session_start();
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido'){
	header('location: index.php');
}
include_once('php/clases/Archivo.php');
include_once('php/clases/Includer.php');
include_once('php/includes/defined.php');
include_once('php/bootstrap.php');
include_once('php/comprobadores/recuperarPass.comprobador.php');
$provincia = Doctrine::getTable('provincia')->find(1);
$categoria = Doctrine::getTable('categoria')->find(1);
$html = Archivo::leer('tpl/header.html');
$html = str_replace('<!--{recursoJs}-->', Includer::addJs('jquery-1.6.1.min', 'jquery.colorbox', 'cufon-yui', 'HelvLight_400.font', 'loginRegister',  'dropdown-menu', 'recuperarPass', 'validadores', 'newsletter'), $html);
$html = str_replace('<!--{recursoCss}-->', Includer::addCss('reset', 'vistas', 'colorbox','formularios'), $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo($html);
?>
<body>
	<!-- ENCABEZADO - LOGO - BOTONERA -->
    <div id="header-wrapper">
        <div class="contAnchoHeader">
        <?php
			include_once('php/comprobadores/encabezado.comprobador.php');
			$html = Archivo::leer('tpl/logoBotonera.html');
                        $class = (isset($_SESSION['log']))?'':'class="login"';
                        $vender = (isset($_SESSION['log']))?'publicar.php':'tpl/formularios/login.php';
                        $html = str_replace('<!--{comprobarVender}-->', $vender, $html);
                        $html = str_replace('<!--{class}-->', $class, $html);
                        echo($html);
		?>
        </div>
    </div>
    <!-- FIN ENCABEZADO - LOGO - BOTONERA -->
    
    <div class="clear"></div>

    <!-- CONTENIDO HOME -->
    <div id="content-wrapper">
    <?php 
		if (isset($_GET['r'])) {
			include_once('tpl/contenidoRecuperarPass.php');
		} else if (isset($_GET['iquest'])) {
			include_once('tpl/generarPass.php');
		} else {
			include_once('tpl/formularios/formularioRecuperarPass.php');
		}
	?>
    </div>
    <!-- FIN CONTENT WRAPPER -->

    <div class="clear"></div>
    
    <!-- FOOTER WRAPPER -->
    <div id="footer-wrapper">
    <?php
    	$html = Archivo::leer('tpl/pieDePagina.html');
		include_once('php/replacers/pieDePagina.replacer.php');
		echo ($html);
	?>
    </div>
    <!-- FIN FOOTER WRAPPER -->
</body>
</html>