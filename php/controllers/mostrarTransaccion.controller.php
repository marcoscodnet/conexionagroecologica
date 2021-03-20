<?php
$html = Archivo::leer('tpl/transaccion.php');
$producto404 = Archivo::leer(RUTA_LOCAL.'tpl/producto404.php');
$producto = Doctrine::getTable('producto')->find($_GET['id']);
if (isset($_SESSION['codigoUsuario']) && $usuario = Doctrine::getTable('usuario')->findOneByCodigo($_SESSION['codigoUsuario'])) {
	if (!$producto->publicacion->transaccion->mostrar($usuario)) {
		echo ($producto404);
		exit();
	}
} else {
	echo ($producto404);
	exit();
}
$duracion = '<span>Duraci&oacute;n del contrato:</span> ';
$periodo = ($producto->periodo)?$duracion.htmlentities($producto->periodoToString()):'';

if ($producto->enContactoCon->id != 1) {
	$enContactoCon = '
		<p><span>Ha estado en contacto con: '.$producto->enContactoCon->contenido.'</span></p>
		<p>'.$producto->detalle.'</p>
	';
} else {
	$enContactoCon = '';
}

if ($producto->publicacion->transaccion->estado->id == Estado::pendiente()->id && $usario->id = Usuario::admin()->id) {
	$botonesAdmin = '
		<div class="botonesArticulo" style="float: left !important;"><a href="tpl/mensajes/borrar.confirm.php" class="btnBorrarAdmin">BORRAR</a></div>
		<div class="botonesArticulo botonAprobar" style="float: left !important;"><a href="javascript:void(0);" class="btnAceptarAdmin">ACEPTAR</a></div>
	';
} else {
	$botonesAdmin = '';
}

$html = str_replace('<!--{botonesAcciones}-->', $botonesAdmin, $html);
$html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieConexion.html'), $html);
$html = str_replace('<!--{compradorToString}-->', htmlentities($producto->publicacion->transaccion->comprador->toString()), $html);
$html = str_replace('<!--{compradorEmail}-->', htmlentities($producto->publicacion->transaccion->comprador->email), $html);
$html = str_replace('<!--{compradorTel}-->', htmlentities($producto->publicacion->transaccion->comprador->telefono->toString()), $html);
$html = str_replace('<!--{compradorCel}-->', htmlentities($producto->publicacion->transaccion->comprador->celular->toString()), $html);
$html = str_replace('<!--{vendedorToString}-->', htmlentities($producto->publicacion->transaccion->vendedor->toString()), $html);
$html = str_replace('<!--{vendedorEmail}-->', htmlentities($producto->publicacion->transaccion->vendedor->email), $html);
$html = str_replace('<!--{vendedorTel}-->', htmlentities($producto->publicacion->transaccion->vendedor->telefono->toString()), $html);
$html = str_replace('<!--{vendedorCel}-->', htmlentities($producto->publicacion->transaccion->vendedor->celular->toString()), $html);

$html = str_replace('<!--{conexionFecha}-->', $producto->publicacion->transaccion->fecha, $html);

/* Lineas comunes a todas las posibilidades */
$html = str_replace('<!--{productoTitulo}-->', htmlentities($producto->titulo), $html);
$html = str_replace('<!--{productoCategoria}-->', htmlentities($producto->subcategoria->categoria->contenido), $html);
$html = str_replace('<!--{productoSubcategoria}-->', htmlentities($producto->subcategoria->contenido), $html);
$html = str_replace('<!--{productoContenedor}-->', htmlentities($producto->contenedor->contenido), $html);
$html = str_replace('<!--{productoFuente}-->', htmlentities($producto->fuente->contenido), $html);
$html = str_replace('<!--{productoImagen}-->', 'images/productos/'.$producto->imagenes[0]->ruta, $html);
$html = str_replace('<!--{productoImagenGr}-->', $producto->imagenesToHTML('gr'), $html);
$html = str_replace('<!--{productoImagenCh}-->', $producto->imagenesToHTML(), $html);
$html = str_replace('<!--{productoUrl}-->', 'producto.php?id='.$producto->id, $html);
$html = str_replace('<!--{productoCantidad}-->', htmlentities($producto->cantidad->toString()), $html);
$html = str_replace('<!--{productoDireccion}-->', htmlentities($producto->direccion->toString()), $html);
$html = str_replace('<!--{productoSugerencia}-->', htmlentities($producto->sugerencia->toString()), $html);
$html = str_replace('<!--{productoDescripcion}-->', htmlentities($producto->descripcion), $html);
$html = str_replace('<!--{productoCondiciones}-->', htmlentities($producto->condiciones), $html);
$html = str_replace('<!--{productoRequerimentos}-->', htmlentities($producto->requerimentos), $html);
$html = str_replace('<!--{productoProcedencia}-->', htmlentities($producto->procedencia), $html);
$html = str_replace('<!--{enContactoCon}-->', $enContactoCon, $html);
//$html = str_replace('<!--{usuarioPuntos}-->', html_entity_decode($producto->publicacion->owner->reputacion), $html);
$html = str_replace('<!--{productoPeriodo}-->', $periodo, $html);
if (Usuario::admin()->codigo == $_SESSION['codigoUsuario']) { //si es el admin
	$html = str_replace('<!--{estado}-->', '<span>Estado:  </span>'.htmlentities($producto->publicacion->estado->contenido), $html);
}
$html = str_replace('<!--{productoId}-->', $_GET['id'], $html);
$html = str_replace('<!--{codigoUsuario}-->', $_SESSION['codigoUsuario'], $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo ($html);                        
                            



?>