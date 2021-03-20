<?php
include_once('../bootstrap.php');
include_once('../clases/Archivo.php');
include_once('../clases/Texto.php');
include_once('../clases/Paginador.php');

$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);

// Mostrar resultado
$template = Archivo::leer('../../tpl/listarMiConexion.php');
$html = '';
include_once('../replacers/'.$_POST['accion'].'.replacer.php');
echo ($html);
?>