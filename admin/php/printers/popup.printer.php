<?php
include_once('php/clases/Archivo.php');
include(INC.'../php/bootstrap.php');
$html = Archivo::leer('tpl/popup.tpl');
if (isset($_GET['slug'])) {
    if ($popup = Doctrine::getTable('popup')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        $imagesTpl = Archivo::leer('tpl/superbox-item.tpl');
        include('php/replacers/popup.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include('php/replacers/popup.void.replacer.php');
}
echo($html);
?>
