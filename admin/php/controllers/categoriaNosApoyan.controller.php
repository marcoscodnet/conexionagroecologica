<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$categoria = (isset($_POST['id']) && $_POST['id'])?Doctrine::getTable('CategoriaSponsor')->find($_POST['id']):new CategoriaSponsor();
if ($_POST['value']) {
    $categoria->value = $_POST['value'];
    $categoria->save();
}
echo($_POST['value']);
?>