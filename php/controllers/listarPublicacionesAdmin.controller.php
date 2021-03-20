<?php
include_once('../bootstrap.php');
include_once('../clases/Archivo.php');
include_once('../clases/Paginador.php');
include_once('../clases/Texto.php');

// Mostrar resultado
$template = Archivo::leer('../../tpl/listarMiConexion.php');
$html = '';
include_once('../replacers/listarPublicacionesAdmin.replacer.php');
echo ($html);
?>