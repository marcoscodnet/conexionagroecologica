<?php
/*$categorias = Doctrine::getTable('categoria')->findAll();
$content = '';
foreach ($categorias as $cat) {
	$content .= '<li><a href="buscar.php?categoria='.$cat->id.'">'.htmlentities($cat->contenido).'</a></li>';
}
$html = str_replace('<!--{productosCategorias}-->', $content, $html);*/

$q = Doctrine_Query::create()
	->select('p.*')
	->from('Popup p')
	->where('p.popup_activo = 1')
	->limit(1); //cuantos trae

	//echo ($q->getSqlQuery());
$popup = $q->execute();

if ($popup!=null)
	$html = str_replace('<!--{body}-->', '<body onload="Abrir_ventana(\'popup_conexion.php?id='.$popup[0]->id.'\', \'cookiePopup_'.$popup[0]->id.'\')" >', $html);
else 
	$html = str_replace('<!--{body}-->', '<body>', $html);
?>