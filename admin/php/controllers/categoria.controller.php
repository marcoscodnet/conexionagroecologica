<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$categoria = (isset($_POST['id']))?Doctrine::getTable('categoria')->find($_POST['id']):new Categoria();
if ($_POST['value']) {
    $categoria->contenido = $_POST['value'];
    $categoria->save();
}
echo($_POST['value']);
?>