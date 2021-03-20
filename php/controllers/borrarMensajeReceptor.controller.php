<?php
include_once('../bootstrap.php');
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['g']);
$mensaje = Doctrine::getTable('mensaje')->find($_POST['mensajeId']);

if ($usuario && $mensaje && $usuario->id == $mensaje->receptor->id) {
	$mensaje->receptor = NULL;
	$mensaje->save();
	echo ('borrarMensaje.exito.php');
} else {
	echo ('Error');
}
?>