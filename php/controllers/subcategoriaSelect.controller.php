<?php
include_once('../bootstrap.php');
$categoria = Doctrine::getTable('categoria')->find($_POST['cat']);
$html = $categoria->subcategoriasToSelect();
$url = $_SERVER['HTTP_REFERER'];
$urlArray = explode("/", $url);
$archivo = $urlArray[count($urlArray)-1];
$archivoArray = explode("?", $archivo);
if ($archivoArray[0] == 'buscar.php') {
	$html = str_replace('<!--{subcategoriaPrimerOption}-->', '<option value="" selected="selected">Cualquier Subcategor&iacute;a</option>', $html);
}
echo (utf8_encode($html));
?>