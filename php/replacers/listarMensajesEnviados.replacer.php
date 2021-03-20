<?php
$pagina = $_POST['pagina']-1;
$cuantos = 5;
$desde = $pagina * $cuantos;
$total = $usuario->contar('mensajesEnviados');

$mensajes = $usuario->paginar('mensajesEnviados', $cuantos, $desde);
foreach ($mensajes as $mensaje) {
	$html .= $template;
	$botones = '
		<div class="botonVerEditar"><a href="javascript:void(0);" class="btnMensajeSimple" id="mensaje'.$mensaje->id.'">VER +</a></div>
		<div><a href="javascript:void(0);" class="btnBorrar" id="mensaje'.$mensaje->id.'">BORRAR</a></div>
	';
	$html = str_replace('<!--{mensajeId}-->', $mensaje->id, $html);
	$html = str_replace('<!--{mensajeEmisor}-->', 'btnMensajeSimple', $html);
	$html = str_replace('<!--{mensajeEstado}-->', 'leido', $html);
	$html = str_replace('<!--{mensajeAsunto}-->', utf8_encode(Texto::cortar($mensaje->asunto, 90)), $html);
	$html = str_replace('<!--{mensajeFecha}-->', $mensaje->fecha, $html);
	$html = str_replace('<!--{mensajeContenido}-->', utf8_encode(Texto::cortar(truncarRespuesta($mensaje->contenido), 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
	$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, $_POST['accion'], $_POST['pagina']);

function truncarRespuesta ($cadena) {
	$cadena = explode('----------------------', $cadena);
	return $cadena[0];
}
?>