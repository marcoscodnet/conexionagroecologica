<?php
if (!defined('BOOTSTRAP'))include(INC.'../php/bootstrap.php');
$html = file_get_contents(INC.'tpl/nos-apoyan.tpl');
$imagen = URL.'img/dropzone.gif';
if (isset($_GET['slug'])) {
    if ($sponsor = Doctrine::getTable('Sponsor')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        if ($sponsor->imagen->id) $imagen = URL.'../images/apoyan/'.$sponsor->imagen->ruta;
        include(INC.'php/replacers/nosApoyan.full.replacer.php');
    } else {
        $html = file_get_contents('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'php/replacers/nosApoyan.void.replacer.php');
}
echo($html);
?>