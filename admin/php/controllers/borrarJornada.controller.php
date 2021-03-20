<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$jornada = Doctrine::getTable('jornada')->find($_POST['id']);
$jornada->delete();
?>
