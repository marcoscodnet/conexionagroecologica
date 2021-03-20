<?php
include_once('../bootstrap.php');
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['gt']);
$transaccion = Doctrine::getTable('transaccion')->find($_POST['id']);
$error = '<p>Ha ocurrido un error. Esto pudo suceder porque la conexi&oacute;n ya hab&iacute;a sido calificada por usted anteriormente. Si no es as&iacute; intentenlo nuevamente m&aacute;s tarde.</p>';
$exito = '<p>La calificaci&oacute;n se realiz&oacute; con &eacute;xito.</p>';

if ($usuario && $transaccion) {
	$comprador = $transaccion->comprador;
	if ($usuario->id == $transaccion->vendedor->id && !$transaccion->aceptadaPorElVendedor) {
		/*$punto = new Punto ();
		$punto->valor = $_POST['puntos'];
		$comprador->puntos[] = $punto;*/
		$transaccion->aceptadaPorElVendedor = true;
		Doctrine_Manager::connection()->flush();
		echo ($exito);
	} else {
		echo ($error);
	}
} else {
	echo ($error);
}
?>