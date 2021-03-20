<?php
$pagina = $_POST['pagina']-1;
$cuantos = 4;
$desde = $pagina * $cuantos;
$total = $usuario->contar('favoritos');

$favoritos = $usuario->paginar('favoritos', $cuantos, $desde);
foreach ($favoritos as $favorito) {
	$html .= $template;
	$link = 'articulo.php?id='.$favorito->producto->id;
	$producto = $favorito->producto;
	$botones = '
		<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div> 
	';
	$html = str_replace('<!--{productoUrl}-->', $link, $html);
	$html = str_replace('<!--{productoTitulo}-->', htmlentities(Texto::cortar($producto->titulo, 90)), $html);
	$html = str_replace('<!--{productoImagenCh}-->', 'images/productos/ch/'.$producto->imagenes[0]->ruta, $html);
	$html = str_replace('<!--{productoDescripcion}-->', htmlentities(Texto::cortar($producto->descripcion, 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, $_POST['accion'], $_POST['pagina']);
?>