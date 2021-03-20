<?php
$validacionError = Archivo::leer('../../tpl/mensajes/validacion.error.php');
//validacion de los campos obligatorios
//if (!$_POST['titulo'] || !$_POST['cantidadValor'] || !$_POST['descripcion'] || $_POST['sugerenciaPrecio'] === '' || !$_POST['calle'] || !$_POST['numero']) {
//if (!$_POST['titulo'] || !$_POST['cantidadValor'] || !$_POST['descripcion'] || $_POST['sugerenciaPrecio'] === '') {
if (!$_POST['titulo'] || !$_POST['hectareas'] || !$_POST['descripcion'] === '') {
	echo ($validacionError);
	exit();
}

 /*if ($_POST['sugerenciaPrecio']=='' && (!$_POST['tipo_precio'] == 1)){
 	echo ($validacionError);
	exit();
}*/

//validacion de datos numericos
//if (!Validador::validarNumero($_POST['cantidadValor']) || !Validador::validarPrecio($_POST['sugerenciaPrecio']) || !Validador::validarNumero($_POST['numero'])) {
if (!Validador::validarNumero($_POST['hectareas']) ) {
	echo ($validacionError);
	exit();
}
/*if ($_POST['periodicidad'] == 2 && !Validador::validarNumero($_POST['duracion-contrato'])) {
	echo ($validacionError);
	exit();
}*/
?>