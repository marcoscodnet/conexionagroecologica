<?php
$pagina = $_POST['pagina']-1;
$propiedadId = $_POST['propiedadId'];
$cuantos = 10;
$desde = $pagina * $cuantos;
$total = Mensaje::contarfiltrarPropiedad($propiedadId);

$mensajes = Mensaje::filtrarPropiedad($cuantos, $desde, $propiedadId);


foreach ($mensajes as $mensaje) {
	$html .= $template;
	$estado = ($mensaje->revisadoPorAdmin)?'leido':'noLeido';
	$emisor = ($mensaje->emisor->id == Usuario::admin()->id ||$mensaje->emisor->id == Usuario::syst()->id)?'btnMensajeSimple':'btnMensaje';
	
		
	
	$html = str_replace('<!--{mensajeEstado}-->', $estado, $html);
	$html = str_replace('<!--{mensajeContenido}-->', nl2br(utf8_encode(($mensaje->contenido))), $html);
	$html = str_replace('<!--{mensajeFecha}-->', $mensaje->fecha, $html);
	
	$respuestas = Mensaje::filtrarRespuesta($mensaje->id);
	foreach ($respuestas as $respuesta) {
		$htmlRespuesta = '<div style="float:left; color:#000">'.nl2br(utf8_encode(($respuesta->contenido))).'</div> ';
	}
	$html = str_replace('<!--{respuestas}-->', $htmlRespuesta, $html);
	$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarMensajesPropiedad', $_POST['pagina']);


?>