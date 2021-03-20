<?php
$categorias = Doctrine::getTable('categoria')->findAll();
$content = '';
foreach ($categorias as $cat) {
	$content .= '<li><a href="buscar.php?categoria='.$cat->id.'">'.htmlentities($cat->contenido).'</a></li>';
}
$html = str_replace('<!--{productosCategorias}-->', $content, $html);
?>