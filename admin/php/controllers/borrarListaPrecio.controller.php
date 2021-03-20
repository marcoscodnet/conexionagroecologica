<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$caso = Doctrine::getTable('ListaPrecio')->find($_POST['id']);
$caso->delete();
?>
