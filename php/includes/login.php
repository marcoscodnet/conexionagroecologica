<?php
session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] !== 'usuarioValido') {
	session_destroy();
	header('location: '.RUTA.'/admin/index.php');
	exit();
}
?>