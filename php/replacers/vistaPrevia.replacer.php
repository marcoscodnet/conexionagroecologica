<?php
if ($_POST['enContactoCon'] != 1) {
	$enContactoCon = '
		<p><span>Ha estado en contacto con: '.$_POST['enContactoCon'].'</span></p>
		<p>'.nl2br(htmlentities($_POST['detalle'])).'</p>
	';
} else {
	$enContactoCon = '';
}

if ($_POST['requerimentos']) {
	$requerimentos = '
		<p><span>Requerimientos especiales para su transporte:</span></p>
		<p>'.nl2br(htmlentities($_POST['requerimentos'])).'</p>
	';
} else {
	$requerimentos = '';
}

if ($_POST['condiciones']) {
	$condiciones = '
		<p><span>Condiciones especiales para su reutilizaci&oacute;n:</span></p>
		<p>'.nl2br(htmlentities($_POST['condiciones'])).'</p>
	';
} else {
	$condiciones = '';
}

if ($_POST['dondeProviene']) {
	$procedencia = '
		<p><span>&iquest;De d&oacute;nde proviene? &iquest;Para qu&eacute; fue utilizado?</span></p>
		<p>'.nl2br(htmlentities($_POST['dondeProviene'])).'</p>
	';
} else {
	$procedencia = '';
}

if ($_POST['periodo']) {
	$periodo = $_POST['periodo'].($_POST['periodo']>1)?' meses':' mes';
} else {
	$periodo = '';
}

$categoria = Doctrine::getTable('categoria')->find($_POST['categoria']);
$subcategoria = Doctrine::getTable('subcategoria')->find($_POST['subcategoria']);
$contenedor = Doctrine::getTable('contenedor')->find($_POST['contenedor']);
$fuente = Doctrine::getTable('fuente')->find($_POST['fuente']);
$cantidad = Doctrine::getTable('medida')->find($_POST['cantidadMedida']);
$localidad = Doctrine::getTable('localidad')->find($_POST['localidad']);


/* Lineas comunes a todas las posibilidades */
$html = str_replace('<!--{productoTitulo}-->', htmlentities($_POST['titulo']), $html);
$html = str_replace('<!--{productoCategoria}-->', htmlentities($categoria->contenido), $html);
$html = str_replace('<!--{productoSubcategoria}-->', htmlentities($subcategoria->contenido), $html);
$html = str_replace('<!--{productoContenedor}-->', htmlentities($contenedor->contenido), $html);
$html = str_replace('<!--{productoFuente}-->', htmlentities($fuente->contenido), $html);
$html = str_replace('<!--{productoImagen}-->', 'images/productos/'.$_POST['condiciones'], $html);
$html = str_replace('<!--{productoImagenGr}-->', $_POST['condiciones'], $html);
$html = str_replace('<!--{productoImagenCh}-->', $_POST['condiciones'], $html);
$html = str_replace('<!--{productoCantidad}-->', htmlentities($_POST['cantidadValor'].' '.$cantidad->contenido), $html);
$html = str_replace('<!--{publicacionTiempoRestante}-->', htmlentities($_POST['finalizacion'].' días'), $html);
$html = str_replace('<!--{productoDireccion}-->', htmlentities($localidad->contenido.', '.$localidad->provincia->contenido), $html);
$html = str_replace('<!--{productoDescripcion}-->', nl2br(htmlentities($_POST['descripcion'])), $html);
$html = str_replace('<!--{productoCondiciones}-->', $condiciones, $html);
$html = str_replace('<!--{productoRequerimentos}-->', $requerimentos, $html);
$html = str_replace('<!--{productoProcedencia}-->', $procedencia, $html);
$html = str_replace('<!--{enContactoCon}-->', $enContactoCon, $html);
$html = str_replace('<!--{productoPeriodo}-->', $$_POST['periodo'], $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo ($html);                        
                        


?>