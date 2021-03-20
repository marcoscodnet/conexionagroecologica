<?php
$pagina = $_POST['pagina']-1;
$cuantos = 4;
$desde = $pagina * $cuantos;
$total = $usuario->contar('ventasRealizadas');

$ventas = $usuario->paginar('ventasRealizadas', $cuantos, $desde);
foreach ($ventas as $venta) {
	$html .= $template;
	$link = 'conexion.php?id='.$venta->publicacion->producto->id;
	$producto = $venta->publicacion->producto;
	$botones = '<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div> ';
	if (!$venta->aceptadaPorElVendedor) {
		$botones .= '<div class="calificarVenta" id="transaccion'.$venta->id.'"><a href="'.$link.'">CALIFICAR</a></div>';
	}
	$html = str_replace('<!--{productoUrl}-->', $link, $html);
	$html = str_replace('<!--{productoTitulo}-->', htmlentities(Texto::cortar($producto->titulo, 90)), $html);
	$html = str_replace('<!--{productoImagenCh}-->', 'images/productos/ch/'.$producto->imagenes[0]->ruta, $html);
	$html = str_replace('<!--{productoDescripcion}-->', htmlentities(Texto::cortar($producto->descripcion, 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, $_POST['accion'], $_POST['pagina']);
?>