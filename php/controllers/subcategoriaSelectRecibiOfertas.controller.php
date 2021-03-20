<?php
include_once('../bootstrap.php');
if (!isset($_POST['cat']) || $_POST['cat'] == FALSE || $_POST['cat'] == -1) {
	echo ('<select disabled="disabled">');
	echo ('<option value="" selected="selected">subcategorias</option>');
	echo ('</select>');
	exit;
}
$categoria = Doctrine::getTable('categoria')->find($_POST['cat']);
$html = $categoria->subcategoriasToSelect();
/*$url = $_SERVER['HTTP_REFERER'];
$urlArray = explode("/", $url);
$archivo = $urlArray[count($urlArray)-1];
$archivoArray = explode("?", $archivo);
if ($archivoArray[0] == 'recibi-ofertas.php') {*/
	$html = str_replace('<!--{subcategoriaPrimerOption}-->', '<option value="" selected="selected">Todas</option>', $html);
//}
echo (utf8_encode($html));
?>