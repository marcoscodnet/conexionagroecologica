<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$caso = Doctrine::getTable('caso')->find($_POST['id']);
$caso->delete();
?>
