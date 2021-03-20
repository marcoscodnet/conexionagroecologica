<?php
include_once('../bootstrap.php');
include_once('../clases/Archivo.php');

if (!$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo'])) {
	exit();
}

// Mostrar resultado
$html = Archivo::leer('../../tpl/formularios/formularioDatosPersonales.php');
include_once('../replacers/datosPersonales.replacer.php');
echo ($html);
?>