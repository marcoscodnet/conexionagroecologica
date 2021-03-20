<?php
include_once('php/clases/Archivo.php');
include(INC.'../php/bootstrap.php');
$html = Archivo::leer('tpl/jornada.tpl');
if (isset($_GET['slug'])) {
    if ($jornada = Doctrine::getTable('jornada')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        $imagesTpl = Archivo::leer('tpl/superbox-item.tpl');
        include('php/replacers/jornada.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include('php/replacers/jornada.void.replacer.php');
}
echo($html);
?>
