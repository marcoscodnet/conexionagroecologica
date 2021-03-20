<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$reciclador = Doctrine::getTable('reciclador')->find($_POST['id']);
$reciclador->delete();
?>
