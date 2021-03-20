<?php
include_once(INC.'php/clases/Archivo.php');
include(INC.'../php/bootstrap.php');
$html = Archivo::leer(INC.'tpl/proveedor.tpl');
if (isset($_GET['slug'])) {
    if ($proveedor = Doctrine::getTable('proveedor')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        include(INC.'php/replacers/proveedor.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'php/replacers/proveedor.void.replacer.php');
}
echo($html);
?>
