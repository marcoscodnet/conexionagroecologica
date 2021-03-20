<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$proveedor = Doctrine::getTable('proveedor')->find($_POST['id']);
$proveedor->delete();
?>
