<?php
if (isset($_GET['iquest']) && isset($_GET['n']) && isset($_GET['m'])) {
	$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_GET['m']);
	if (!$usuario) {
		header('location: '.RUTA);
	}
} else if (!isset($_GET['iquest']) && !isset($_GET['n']) && !isset($_GET['m'])){
	//pasa
} else {
	header('location: '.RUTA);
}
?>