<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$subcategoria = (isset($_POST['id']))?Doctrine::getTable('SubcategoriaProveedor')->find($_POST['id']):new SubcategoriaProveedor();
if ($_POST['value']) {
    $subcategoria->value = $_POST['value'];
    $subcategoria->id_categoria = $_POST['categoriaId'];
    $subcategoria->save();
}
echo($_POST['value']);
?>