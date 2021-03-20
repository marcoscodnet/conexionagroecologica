<?php
if (!$propiedad->publicacion->mostrar($usuario)) {
	echo ($propiedad404);
	exit();
}

if (isset($_SESSION['codigoUsuario']) && $propiedad->publicacion->inSeguidores($usuario)) {
	$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnDejarDeSeguir" id="seguir<!--{propiedadId}-->">OLVIDAR</a></div>';
} else {
	$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnSeguir" id="seguir<!--{propiedadId}-->">SEGUIR</a></div>';
}

if ($propiedad->publicacion->estado->id != Estado::pendiente()->id) {
	$btnCompartir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnCompartir" id="compartir<!--{propiedadId}-->">COMPARTIR</a></div>';
	$btnCompartirNoLogin = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnCompartir noLogin" id="compartir<!--{propiedadId}-->">COMPARTIR</a></div>';
} else {
	$btnCompartir = '';
}

if ($comprada || $finalizada) {
	$tpl = ($comprada)?Archivo::leer('tpl/pieArticuloPendiente.html'):Archivo::leer('tpl/pieConexion.html');
	$btnComprar = '';
	$btnSeguir = '';
	$btnCompartir = '';
	$html = str_replace('<!--{botonesMensaje}-->', $tpl, $html);
	$html = str_replace('<!--{conexionComprador}-->', ($propiedad->publicacion->transaccion->comprador->toString()), $html);
$html = str_replace('<!--{conexionVendedor}-->', ($propiedad->publicacion->transaccion->vendedor->toString()), $html);
$html = str_replace('<!--{conexionFecha}-->', $propiedad->publicacion->transaccion->fecha, $html);
} else {
	$btnComprar = '<div class="botonesArticulo" style="float: left !important;"><span href="javascript:void(0);" id="comprar" class="btn celeste">Demandar</span></div>';
	$btnComprarNoLogin = '<div class="botonesArticulo" style="float: left !important;"><span class="login cboxElement btn celeste" href="tpl/formularios/login.php" id="comprar">Demandar</span></div>';
}

?>