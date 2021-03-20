<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$evento = Doctrine::getTable('evento')->find($_POST['id']);
$evento->delete();
?>
