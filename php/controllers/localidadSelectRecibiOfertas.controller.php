<?php
include_once('../bootstrap.php');
//echo $_POST['prov'];
if (!isset($_POST['prov']) || $_POST['prov'] == FALSE || $_POST['prov'] == -1) {
	echo ('<select disabled="disabled">');
	echo ('<option value="" selected="selected">localidades</option>');
	echo ('</select>');
	exit;
}
$provincia = Doctrine::getTable('provincia')->find($_POST['prov']);
$html = $provincia->localidadesToSelect();
/*$url = $_SERVER['HTTP_REFERER'];
$urlArray = explode("/", $url);
$archivo = $urlArray[count($urlArray)-1];
$archivoArray = explode("?", $archivo);
if ($archivoArray[0] == 'buscar.php') {*/
	$html = str_replace('<!--{localidadPrimerOption}-->', '<option value="" selected="selected">Todas</option>', $html);
//}
echo (utf8_encode($html));
?>