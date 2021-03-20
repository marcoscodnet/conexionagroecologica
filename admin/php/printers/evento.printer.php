<?php
include_once(INC.'php/clases/Archivo.php');
include(INC.'../php/bootstrap.php');
$html = Archivo::leer(INC.'tpl/evento.tpl');
if (isset($_GET['slug'])) {
    if ($evento = Doctrine::getTable('evento')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        include(INC.'php/replacers/evento.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'php/replacers/evento.void.replacer.php');
}
echo($html);
?>
