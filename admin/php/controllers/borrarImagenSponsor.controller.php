<?php
include('../includes/definer.php');
include(INC.'php/bootstrap.php');
$relativePath = '../images/apoyan/';
$imagen = Doctrine::getTable('imagen')->find($_POST['id']);
unlink(INC.$relativePath.$imagen->src);
unlink(INC.$relativePath.'thumb/'.$imagen->src);
Doctrine_Query::create()->update('Sponsor')->set('id_imagen', 'NULL')->where('id_imagen = '.$_POST['id'])->execute();
$imagen->delete();
?>