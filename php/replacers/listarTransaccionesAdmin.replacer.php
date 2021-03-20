<?php
$pagina = $_POST['pagina']-1;
$cuantos = 4;
$desde = $pagina * $cuantos;
$total = Transaccion::contarPendientes();

$transacciones = Transaccion::pendientes($cuantos, $desde);

foreach ($transacciones as $transaccion) {
	$html .= $template;
	$link = 'conexion.php?id='.$transaccion->publicacion->producto->id;
	$producto = $transaccion->publicacion->producto;
	$botones = '
		<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div>
		<div><a href="javascript:void(0)" class="botonAprobar" id="aprobar'.$producto->id.'">APROBAR </a></div>
		<div><a href="javascript:void(0)" class="btnBorrarAdmin" id="publicacion'.$producto->id.'">BORRAR </a></div>
	';
	$html = str_replace('<!--{productoUrl}-->', $link, $html);
	$html = str_replace('<!--{productoTitulo}-->', htmlentities(Texto::cortar($producto->titulo, 90)), $html);
	$html = str_replace('<!--{productoImagenCh}-->', 'images/productos/ch/'.$producto->imagenes[0]->ruta, $html);
	$html = str_replace('<!--{productoDescripcion}-->', htmlentities(Texto::cortar($producto->descripcion, 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarTransaccionesAdmin', $_POST['pagina']);
?>