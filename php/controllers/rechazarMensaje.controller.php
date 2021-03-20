<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');
include_once('../clases/class.phpmailer.php');
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);

if (!$usuario || $usuario->id != Usuario::admin()->id) {
	echo ('error');
	exit();
}

if ($mensaje = Doctrine::getTable('mensaje')->find($_POST['id'])) {
	$mensaje->estado = Estado::rechazada();
	$mensaje->save();
	
	echo ('bien');
} else {
	echo ('error');
}
?>