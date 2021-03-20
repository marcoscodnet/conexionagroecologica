<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
$producto = Doctrine::getTable('producto')->find(1);
$mensaje = new Mensaje ();
$mensaje->avisoPublicacion($producto, 'alta');
$mensaje->save();
?>