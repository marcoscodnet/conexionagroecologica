<?php
include_once('php/clases/Archivo.php');
include(INC.'../php/bootstrap.php');
$html = Archivo::leer('tpl/listaPrecio.tpl');
if (isset($_GET['slug'])) {
    if ($listaPrecio = Doctrine::getTable('ListaPrecio')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        
        include('php/replacers/listaPrecio.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include('php/replacers/listaPrecio.void.replacer.php');
}
echo($html);
?>
