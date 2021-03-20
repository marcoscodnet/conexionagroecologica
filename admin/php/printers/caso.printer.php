<?php
include_once(INC.'php/clases/Archivo.php');
include(INC.'../php/bootstrap.php');
$html = Archivo::leer(INC.'tpl/caso.tpl');
if (isset($_GET['slug'])) {
    if ($caso = Doctrine::getTable('caso')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        $imagesTpl = Archivo::leer(INC.'tpl/superbox-item.tpl');
        include(INC.'php/replacers/caso.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'php/replacers/caso.void.replacer.php');
}
echo($html);
?>
