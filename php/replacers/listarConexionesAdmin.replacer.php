<?php
$pagina = $_POST['pagina']-1;
$cuantos = 4;
$desde = $pagina * $cuantos;
$total = Doctrine::getTable('transaccion')->findByid_estado(1)->count();

$q = Doctrine_Query::create()
	->select('t.*')
	->from('Transaccion t')
	->innerJoin('t.estado e')
	->where('e.contenido = "aceptada"')
	->limit($cuantos) //cuantos trae
	->offset($desde); //a partir de donde empieza a traer
$transacciones = $q->execute();

foreach ($transacciones as $transaccion) {
	$html .= $template;
	$propiedad = $transaccion->publicacion->propiedad;
	$link = 'conexion.php?id='.$propiedad->id;
	$botones = '
		<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div>
	';
	$html = str_replace('<!--{propiedadUrl}-->', $link, $html);
	$html = str_replace('<!--{propiedadTitulo}-->', htmlentities(Texto::cortar($propiedad->titulo, 90)), $html);
	$html = str_replace('<!--{propiedadImagenCh}-->', 'images/propiedades/ch/'.$propiedad->imagenes[0]->ruta, $html);
	$html = str_replace('<!--{propiedadDescripcion}-->', htmlentities(Texto::cortar($propiedad->descripcion, 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarPublicacionesAdmin', $_POST['pagina']);
?>