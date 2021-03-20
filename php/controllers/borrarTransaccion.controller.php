<?php
include_once('../bootstrap.php');
if (Usuario::admin()->codigo == $_POST['g']) {
	$producto = Doctrine::getTable('producto')->find($_POST['productoId']);
	$publicacion = $producto->publicacion;
	$transaccion = $producto->publicacion->transaccion;
	$transaccion->estado = Estado::borrada();
	$publicacion->estado = Estado::borrada();
	Doctrine_Manager::connection()->flush();
	echo ('borrarTransaccion.exito.php');
} else {
	echo ('Error');
}

?>