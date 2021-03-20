<?php
$pagina = $_POST['pagina']-1;
$cuantos = 4;
$desde = $pagina * $cuantos;
$total = $usuario->contar('misPublicaciones');

$publicaciones = $usuario->paginar('misPublicaciones', $cuantos, $desde);
foreach ($publicaciones as $publicacion) {
	if ($publicacion->estado->id != Estado::borrada()->id) {
		$html .= $template;
		$link = 'articulo.php?id='.$publicacion->propiedad->id;
		$propiedad = $publicacion->propiedad;
		$pendiente = ($publicacion->estado->id == Estado::pendiente()->id)?' (aun no aprobada)':'';
		$botones = '
			<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div>
			<div><a href="publicar.php?id='.$propiedad->id.'" class="btnEditar">EDITAR</a></div>
			<div><a href="javascript:void(0)" class="btnBorrar" id="publicacion'.$propiedad->id.'">BORRAR </a></div>
		';
		$html = str_replace('<!--{propiedadUrl}-->', $link, $html);
		$html = str_replace('<!--{propiedadTitulo}-->', htmlentities(Texto::cortar($propiedad->titulo, 90)).$pendiente, $html);
		$html = str_replace('<!--{propiedadImagenCh}-->', 'images/propiedades/ch/'.$propiedad->imagenes[0]->ruta, $html);
		$html = str_replace('<!--{propiedadDescripcion}-->', htmlentities(Texto::cortar($propiedad->descripcion, 150)), $html);
		$html = str_replace('<!--{botones}-->', $botones, $html);
	}
}

$html .= Paginador::crearNumeritos ($cuantos, $total, $_POST['accion'], $_POST['pagina']);
?>