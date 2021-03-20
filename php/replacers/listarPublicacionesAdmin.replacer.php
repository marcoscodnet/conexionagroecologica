<?php
session_start();
$pagina = $_POST['pagina']-1;
$estado = $_POST['estado'];
$cuantos = 20;
$desde = $pagina * $cuantos;
//$total = Publicacion::contarPendientes();
$total = Publicacion::contarFiltrarEstado($estado);
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_SESSION['codigoUsuario']);

//$publicaciones = Publicacion::listarPendientes($cuantos, $desde);
$publicaciones = Publicacion::filtrarEstado($cuantos, $desde, $estado);
$html = '<div class="cajaMensajesPerfil"><p style="color:#000;">Estados:'.Estado::toSelectPublicaciones($estado).'</p></div>';

foreach ($publicaciones as $publicacion) {
		$html .= $template;
	$link = 'articulo.php?id='.$publicacion->propiedad->id;
	$propiedad = $publicacion->propiedad;
	
	if ($publicacion->inSeguidores($usuario)) {
		$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnDejarDeSeguir" id="seguir'.$propiedad->id.'">OLVIDAR</a></div>';
	} else {
		$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnSeguir" id="seguir'.$propiedad->id.'">SEGUIR</a></div>';
	}
	
	$botones = '
		<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div>
		<div><a href="javascript:void(0)" class="botonAprobar" id="aprobar'.$propiedad->id.'">APROBAR </a></div>
		<div><a href="javascript:void(0)" class="btnBorrarAdmin" id="publicacion'.$propiedad->id.'">BORRAR </a></div>
	'.$btnSeguir
	;
	$titulo = 'ID='.$publicacion->propiedad->id.'<br />'.htmlentities(Texto::cortar($propiedad->titulo, 90));
	$html = str_replace('<!--{propiedadUrl}-->', $link, $html);
	$html = str_replace('<!--{propiedadTitulo}-->', $titulo, $html);
	$html = str_replace('<!--{propiedadImagenCh}-->', 'images/propiedades/ch/'.$propiedad->imagenes[0]->ruta, $html);
	$html = str_replace('<!--{propiedadDescripcion}-->', htmlentities(Texto::cortar($propiedad->descripcion, 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarPublicacionesAdmin', $_POST['pagina']);
?>