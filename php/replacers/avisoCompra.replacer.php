<?php
$acciones = '<p><a href="articulo?id='.$transaccion->publicacion->producto->id.'">Ver publicación</a></p>
<p><a href="javascript:void(0)" class="aprobarCompra">Aprobar conexión</a></p>';

$contenido = str_replace('<!--{comprador}-->', $transaccion->comprador->toString(), $contenido);
$contenido = str_replace('<!--{vendedor}-->', $transaccion->vendedor->toString(), $contenido);
$contenido = str_replace('<!--{produdtoTitulo}-->', $transaccion->publicacion->producto->titulo, $contenido);
$contenido = str_replace('<!--{produdtoPrecio}-->', $transaccion->publicacion->producto->sugerencia->toString(), $contenido);
$contenido = str_replace('<!--{fecha}-->', $transaccion->fecha, $contenido);
$contenido = str_replace('<!--{acciones}-->', $acciones, $contenido);
$contenido = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $contenido);
?>