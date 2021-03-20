<?php
include_once('../bootstrap.php');
if (!isset($_POST['prov']) || $_POST['prov'] == FALSE) {
	echo ('<select disabled="disabled" id="selectLocalidad" name="localidad">');
	echo ('<option value="" selected="selected">localidades</option>');
	echo ('</select>');
	exit;
}
$provincia = Doctrine::getTable('provincia')->find($_POST['prov']);
$html = $provincia->localidadesToSelect();
$url = $_SERVER['HTTP_REFERER'];
$urlArray = explode("/", $url);
$archivo = $urlArray[count($urlArray)-1];
$archivoArray = explode("?", $archivo);
if (($archivoArray[0] == 'buscar.php')||($archivoArray[0] == 'listado-usuarios.php')) {
	$html = str_replace('<!--{localidadPrimerOption}-->', '<option value="" selected="selected">Cualquier localidad</option>', $html);
}
echo (utf8_encode($html));
?>