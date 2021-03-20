<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$popup = Doctrine::getTable('popup')->find($_POST['id']);
$popup->delete();
?>
