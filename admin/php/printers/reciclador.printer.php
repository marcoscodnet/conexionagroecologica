<?php
include_once(INC.'php/clases/Archivo.php');
include(INC.'../php/bootstrap.php');
$html = Archivo::leer(INC.'tpl/reciclador.tpl');
if (isset($_GET['slug'])) {
    if ($reciclador = Doctrine::getTable('reciclador')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        include(INC.'php/replacers/reciclador.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'php/replacers/reciclador.void.replacer.php');
}
echo($html);
?>
