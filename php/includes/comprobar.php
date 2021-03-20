<?php
if ($_SESSION['log'] != 'usuarioValido') {
	session_destroy();
	header('location:'.RUTA.'index.php?login=incorrecto');
	exit();
}
?>