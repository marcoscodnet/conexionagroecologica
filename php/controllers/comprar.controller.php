<?php
include_once('../includes/defined.php');
include_once('../bootstrap.php');
if ( !($usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigoUsuario']))) {
	echo ('usuarioInvalido.error.php');
	exit();
}
if ( !($producto = Doctrine::getTable('producto')->find($_POST['productoId']))) {
	echo ('productoInvalido.error.php');
	exit();
}

if ($usuario->inCompras($producto)) {
	echo ('comprarRepetido.error.php');
	exit();
} else if ($producto->publicacion->owner->id == $usuario->id){
	echo ('comprarProductoPropio.error.php');
	exit();
} else {
	$usuario->comprar($producto);
	echo ('comprar.exito.php');
	exit();
}


?>