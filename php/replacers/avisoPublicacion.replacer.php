<?php
$acciones = array(
	'alta'=>'<p><a href="articulo?id='.$producto->id.'">Ver publicaci�n</a></p>
			<p><a href="javascript:void(0)" class="aprobarPublicacion">Aprobar publicaci�n</a></p>',
	'baja'=>'<p><a href="articulo?id='.$producto->id.'">Ver el estado de la publicaci�n antes de la baja</a></p>',
	'modificacion'=>'<p><a href="articulo?id='.$producto->id.'">Ver publicaci�n</a></p>'
);

$notificaciones = array (
	'alta'=>'ha dadto de alta la publicaci�n',
	'baja'=>'ha dadto de baja la publicaci�n',
	'modificaion'=>'ha modificado la publicaci�n'
);

$contenido = str_replace('<!--{usuario}-->', $producto->publicacion->owner->toString(), $contenido);
$contenido = str_replace('<!--{notificacion}-->', $notificaciones[$accion], $contenido);
$contenido = str_replace('<!--{productoId}-->', $producto->id, $contenido);
$contenido = str_replace('<!--{productoTitulo}-->', $producto->titulo, $contenido);
$contenido = str_replace('<!--{acciones}-->', $acciones[$accion], $contenido);
$contenido = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $contenido);
?>