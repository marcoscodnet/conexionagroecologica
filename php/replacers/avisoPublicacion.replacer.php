<?php
$acciones = array(
	'alta'=>'<p><a href="articulo?id='.$producto->id.'">Ver publicación</a></p>
			<p><a href="javascript:void(0)" class="aprobarPublicacion">Aprobar publicación</a></p>',
	'baja'=>'<p><a href="articulo?id='.$producto->id.'">Ver el estado de la publicación antes de la baja</a></p>',
	'modificacion'=>'<p><a href="articulo?id='.$producto->id.'">Ver publicación</a></p>'
);

$notificaciones = array (
	'alta'=>'ha dadto de alta la publicación',
	'baja'=>'ha dadto de baja la publicación',
	'modificaion'=>'ha modificado la publicación'
);

$contenido = str_replace('<!--{usuario}-->', $producto->publicacion->owner->toString(), $contenido);
$contenido = str_replace('<!--{notificacion}-->', $notificaciones[$accion], $contenido);
$contenido = str_replace('<!--{productoId}-->', $producto->id, $contenido);
$contenido = str_replace('<!--{productoTitulo}-->', $producto->titulo, $contenido);
$contenido = str_replace('<!--{acciones}-->', $acciones[$accion], $contenido);
$contenido = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $contenido);
?>