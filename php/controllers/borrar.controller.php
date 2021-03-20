<?php
include_once('../bootstrap.php');
if ($usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['g'])) {
	$propiedad = Doctrine::getTable('propiedad')->find($_POST['propiedadId']);
	if ($propiedad->publicacion->owner->id == $usuario->id) {
		$propiedad->publicacion->estado = Estado::borrada();
		$propiedad->imagenes->delete();
		$propiedad->publicacion->save();
		echo ('borrar.exito.php');
	} else {
		echo ('borrar.error.php');
	}
} else {
	echo ('borrar.error.php');
}
?>