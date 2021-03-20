<?php
$html = Archivo::leer('tpl/propiedad.php');
$propiedad404 = Archivo::leer(RUTA_LOCAL.'tpl/producto404.php');
if (!$propiedad = Doctrine::getTable('propiedad')->find($_GET['id'])) {
	echo ($propiedad404);
	exit();
}
$comprada = ($propiedad->publicacion->estado->id == Estado::comprada()->id);
$finalizada = ($propiedad->publicacion->estado->id == Estado::finalizada()->id);

if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
	$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_SESSION['codigoUsuario']);
} else {
	$usuario = false;
}

include_once(RUTA_LOCAL.'php/comprobadores/mostrarPropiedad.comprobador.php');

$botonBorrarAdmin = '<div class="botonesArticulo" style="float: left !important; margin-top:5px"><a href="tpl/mensajes/borrar.confirm.php" class="btnBorrarAdmin">BORRAR</a></div>';
$botonAprobarAdmin = '<div class="botonesArticulo botonAprobar" style="float: left !important;"><a href="javascript:void(0)" class="btnAceptarAdmin">APROBAR</a></div>';

/*$duracion = '<span>Duraci&oacute;n del contrato:</span> ';
$periodo = ($producto->periodo)?$duracion.($producto->periodoToString()):'';*/
$codigo = (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido')?$_SESSION['codigoUsuario']:'';

/*if ($producto->enContactoCon->id != 1) {
	$enContactoCon = '
		<p><span>Ha estado en contacto con: '.$producto->enContactoCon->contenido.'</span></p>
		<p>'.nl2br(($producto->detalle)).'</p>
	';
} else {
	$enContactoCon = '';
}

if ($producto->requerimentos) {
	$requerimentos = '
		<p><span>Requerimientos especiales para su transporte:</span></p>
		<p>'.nl2br(($producto->requerimentos)).'</p>
	';
} else {
	$requerimentos = '';
}

if ($producto->condiciones) {
	$condiciones = '
		<p><span>Condiciones especiales para su reutilizaci&oacute;n:</span></p>
		<p>'.nl2br(($producto->condiciones)).'</p>
	';
} else {
	$condiciones = '';
}

if ($producto->procedencia) {
	$procedencia = '
		<p><span>&iquest;De d&oacute;nde proviene? &iquest;Para qu&eacute; fue utilizado?</span></p>
		<p>'.nl2br(($producto->procedencia)).'</p>
	';
} else {
	$procedencia = '';
}*/
	
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
	if ($propiedad->publicacion->owner->codigo == $_SESSION['codigoUsuario'] && !$comprada) { //si es el dueño
		$html = str_replace('<!--{botonesAcciones}-->', $btnCompartir, $html);
		$html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloOwner.html'), $html);
	} else if (!$propiedad->isVencido()) {
		if (Usuario::admin()->codigo == $_SESSION['codigoUsuario']) { //si es el admin
			if ($propiedad->publicacion->estado->id == Estado::aceptada()->id) {
				$html = str_replace('<!--{botonesAcciones}-->', $botonBorrarAdmin, $html);
			}
                        $html = str_replace('<!--{usuarioToString}-->', '<p style="color: #464646; font-size: 18px">Usuario: '.($propiedad->publicacion->owner->toString()).'</p>', $html);
                        $html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloOwner.html').'<!--{botonesMensaje}-->', $html);
			$html = str_replace('<!--{botonesAcciones}-->', $botonAprobarAdmin.$botonBorrarAdmin, $html);
		} else { //si es un usuario logueado
			$propiedad->publicacion->visitas = $propiedad->publicacion->visitas + 1;
			$propiedad->publicacion->save();
			$html = str_replace('<!--{botonesAcciones}-->', $btnComprar.$btnCompartir.$btnSeguir, $html);
		}
		if (!$comprada) {
			$html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloLogin.html'), $html);
			$html = str_replace('<!--{mensajeAsunto}-->', 'Consulta por el art&iacute;culo '.$propiedad->titulo, $html);
			$html = str_replace('<!--{codigoUsuario}-->', $_SESSION['codigoUsuario'], $html);
		} 
	} else {
		echo ($propiedad404);
		exit();
	}
} else if (!$propiedad->isVencido()) { //si es un usuario no logueado
	$html = str_replace('<!--{botonesAcciones}-->', $btnCompartirNoLogin.$btnComprarNoLogin, $html);
	$html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloNoLogin.html'), $html);
	$propiedad->publicacion->visitas = $propiedad->publicacion->visitas + 1;
	$propiedad->publicacion->save();
} else {
	echo ($propiedad404);
	exit();
}

/* Lineas comunes a todas las posibilidades */
$html = str_replace('<!--{propiedadTitulo}-->', ($propiedad->titulo), $html);
$usoSuelo = ($propiedad->usoSuelo->id==8)?$propiedad->usoSuelo->contenido.' ('.$propiedad->otro_uso_suelo.')':$propiedad->usoSuelo->contenido;
$html = str_replace('<!--{propiedadUsoSuelo}-->', ($usoSuelo), $html);
$tipoUsoSuelo = ($propiedad->tipoUsoSuelo->id==4)?$propiedad->tipoUsoSuelo->contenido.' ('.$propiedad->otro_tipo_uso_suelo.')':$propiedad->tipoUsoSuelo->contenido;
$html = str_replace('<!--{propiedadTipoUsoSuelo}-->', ($tipoUsoSuelo), $html);
$html = str_replace('<!--{propiedadHectareas}-->', ($propiedad->hectareas), $html);
$html = str_replace('<!--{propiedadTipoContrato}-->', ($propiedad->tipoContrato->contenido), $html);
$html = str_replace('<!--{propiedadPosibleUsoSuelo}-->', ($propiedad->posibleUsoSuelo->contenido), $html);
$html = str_replace('<!--{propiedadAccesoAgua}-->', ($propiedad->accesoAgua->contenido), $html);
$html = str_replace('<!--{propiedadImagen}-->', 'images/propiedades/'.$propiedad->imagenes[0]->ruta, $html);
$html = str_replace('<!--{propiedadImagenGr}-->', $propiedad->imagenesToHTML('gr'), $html);
$html = str_replace('<!--{propiedadImagenCh}-->', $propiedad->imagenesToHTML(), $html);
$html = str_replace('<!--{propiedadUrl}-->', 'propiedad.php?id='.$propiedad->id, $html);

$html = str_replace('<!--{propiedadDireccion}-->', ($propiedad->direccion->toStringLocalidad()), $html);
//$html = str_replace('<!--{propiedadDireccionMapa}-->', ($propiedad->direccion->toStringMapa()), $html);

$html = str_replace('<!--{propiedadLatitud}-->', ($propiedad->latitud), $html);
$html = str_replace('<!--{propiedadLongitud}-->', ($propiedad->longitud), $html);

$casaDisponible = ($propiedad->casa_disponible)?'Si':'No';
$html = str_replace('<!--{propiedadCasaDisponible}-->', $casaDisponible, $html);
$viveTerreno = ($propiedad->vive_terreno)?'Si':'No';
$html = str_replace('<!--{propiedadViveTerreno}-->', $viveTerreno, $html);

$html = str_replace('<!--{propiedadDescripcion}-->', nl2br(($propiedad->descripcion)), $html);

//$html = str_replace('<!--{usuarioPuntos}-->', html_entity_decode($propiedad->publicacion->owner->reputacion), $html);
//$html = str_replace('<!--{propiedadPeriodo}-->', $periodo, $html);
$html = str_replace('<!--{publicacionVisitas}-->', ($propiedad->publicacion->visitas), $html);
if (Usuario::admin()->codigo == $_SESSION['codigoUsuario']) { //si es el admin
	$html = str_replace('<!--{publicacionMail}-->', '<span>Mail: </span>'.($propiedad->publicacion->owner->email), $html);
}
$html = str_replace('<!--{propiedadId}-->', $_GET['id'], $html);
$html = str_replace('<!--{codigoUsuario}-->', $codigo, $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo ($html);                        
                            



?>