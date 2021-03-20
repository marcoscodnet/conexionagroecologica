<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$sponsor = Doctrine::getTable('Sponsor')->find($_POST['id']);
$sponsor->delete();
?>
