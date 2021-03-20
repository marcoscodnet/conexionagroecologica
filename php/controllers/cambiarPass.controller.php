<?php
include_once('../bootstrap.php');
include_once('../includes/defined.php');
include_once('../clases/Archivo.php');

$error = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/cambiarPass.error.php');
$exito = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/cambiarPass.exito.php');

if ($usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['n'])) {
	if ($_POST['passNueva'] == $_POST['passNueva2']) {
		if ($usuario->cambiarPass($_POST['passActual'], $_POST['passNueva'])) {
			$usuario->save();
			echo($exito);
		} else {
			echo($error);
		}
	} else {
		echo($error);
	}
} else {
	echo($error);
}

?>