<?php
$pagina = $_POST['pagina']-1;
$estado = $_POST['estado'];
$cuantos = 20;
$desde = $pagina * $cuantos;
$total = Mensaje::contarfiltrarEstado($estado);

$mensajes = Mensaje::filtrarEstado($cuantos, $desde, $estado);
$html = '<div class="cajaMensajesPerfil"><p style="color:#000;">Estados:'.Estado::toSelect($estado).'</p></div>';

foreach ($mensajes as $mensaje) {
	$html .= $template;
	$estado = ($mensaje->revisadoPorAdmin)?'leido':'noLeido';
	$emisor = ($mensaje->emisor->id == Usuario::admin()->id ||$mensaje->emisor->id == Usuario::syst()->id)?'btnMensajeSimple':'btnMensaje';
	$botones = '
		<div class="botonVerEditar"><a href="javascript:void(0);" class="btnMensajeAdmin" id="mensaje'.$mensaje->id.'">VER +</a></div> 
		<div><a href="javascript:void(0)" class="botonAprobar" id="aprobar'.$mensaje->id.'">APROBAR </a></div>
		<div><a href="javascript:void(0)" class="btnRechazarAdmin" id="rechazar'.$mensaje->id.'">RECHAZAR </a></div>
	';
		
	$html = str_replace('<!--{mensajeId}-->', $mensaje->id, $html);
	$html = str_replace('<!--{mensajeEmisor}-->', 'btnMensajeAdmin', $html);
	$html = str_replace('<!--{mensajeEstado}-->', $estado, $html);
	$html = str_replace('<!--{mensajeAsunto}-->', utf8_encode(Texto::cortar($mensaje->asunto, 90)), $html);
	$html = str_replace('<!--{mensajeFecha}-->', $mensaje->fecha, $html);
	$html = str_replace('<!--{mensajeContenido}-->', nl2br(utf8_encode(Texto::cortar(truncarRespuesta($mensaje->contenido), 150))), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
	$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarMensajesAdmin', $_POST['pagina']);

function truncarRespuesta ($cadena) {
	$cadena = explode('----------------------', $cadena);
	return $cadena[0];
}
?>