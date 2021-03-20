<?php
if (isset($_SESSION['log'])) {
	if ($_SESSION['log'] == 'usuarioValido') {
		$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_SESSION['codigoUsuario']);
		if ($usuario->id == Usuario::admin()->id) {
			$html = Archivo::leer(RUTA_LOCAL.'tpl/encabezadoAdmin.html');
			$html = str_replace('<!--{usuario}-->', $usuario->toString(), $html);
			$html = str_replace('<!--{publicacionesPendientesCantidad}-->', Publicacion::contarPendientes(), $html);
			$html = str_replace('<!--{mensajesPendientesCantidad}-->', Mensaje::contarNoRevisados(), $html);
			$html = str_replace('<!--{conexionesPendientesCantidad}-->', Transaccion::contarPendientes(), $html);
		} else {
			$html = Archivo::leer(RUTA_LOCAL.'tpl/encabezadoLogin.html');
			$html = str_replace('<!--{usuario}-->', $usuario->toString(), $html);
			$html = str_replace('<!--{misPubliaciones}-->', $usuario->contar('misPublicaciones'), $html);
			$html = str_replace('<!--{ventasSinCalificar}-->', $usuario->ventasSinCalificar()->count(), $html);
			$html = str_replace('<!--{comprasSinCalificar}-->', $usuario->comprasSinCalificar()->count(), $html);
			$html = str_replace('<!--{mensajesNoLeidosCantidad}-->', $usuario->mensajesNoLeidos()->count(), $html);
		}
		echo ($html);
	} else {
		session_destroy();
		
		include_once(RUTA_LOCAL.'tpl/encabezado.html');
	}
} else {
	include_once(RUTA_LOCAL.'tpl/encabezado.html');
}
?>