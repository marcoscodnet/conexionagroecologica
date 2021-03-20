<?php
include('../includes/definer.php');
include(INC.'../php/bootstrap.php');
$imagen = Doctrine::getTable('imagen')->find($_POST['id']);
$imagen->delete();
$src = str_replace(URL, INC, $_POST['src']);
@unlink($src);
@unlink(str_replace('thumb/', '', $src));
?>
