<?php
include_once('../bootstrap.php');
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['g']);
$mensaje = Doctrine::getTable('mensaje')->find($_POST['mensajeId']);

if ($usuario && $mensaje && $usuario->id == $mensaje->emisor->id) {
	$mensaje->emisor = NULL;
	$mensaje->save();
	echo ('borrarMensaje.exito.php');
} else {
	echo ('Error');
}
?>