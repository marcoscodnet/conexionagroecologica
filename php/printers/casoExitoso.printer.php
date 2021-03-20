<?php
if (!isset($conn)) include('../bootstrap.php');
if (!defined('RUTA')) include('../includes/defined.php');
if ($caso = Doctrine::getTable('caso')->findOneBySlug($_GET['slug'])) {
    $html = file_get_contents(RUTA_LOCAL.'tpl/caso-exitoso.tpl');
    include(RUTA_LOCAL.'php/replacers/casoExitoso.replacer.php');
} else {
    $html = file_get_contents(RUTA_LOCAL.'tpl/producto404.php');
}
echo($html);
?>