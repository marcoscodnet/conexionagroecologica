<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$subcategoria = (isset($_POST['id']))?Doctrine::getTable('subcategoria')->find($_POST['id']):new Subcategoria();
if ($_POST['value']) {
    $subcategoria->contenido = $_POST['value'];
    $subcategoria->id_categoria = $_POST['categoriaId'];
    $subcategoria->save();
}
echo($_POST['value']);
?>