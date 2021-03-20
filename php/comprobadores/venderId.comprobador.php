<?php
if (isset($_GET['id'])) {
	$propiedad = Doctrine::getTable('propiedad')->find($_GET['id']);
	if ($propiedad && $propiedad->publicacion->owner->codigo != $_SESSION['codigoUsuario'] && Usuario::admin()->codigo !=  $_SESSION['codigoUsuario']) {
		session_destroy();
		header('location: '.RUTA);
		exit();
	}
}
?>
