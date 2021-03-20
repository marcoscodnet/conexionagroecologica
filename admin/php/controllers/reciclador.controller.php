<?php
include_once('../includes/definer.php');
include('../../../php/bootstrap.php');

if ($_POST['id']) {
    $reciclador = Doctrine::getTable('reciclador')->find($_POST['id']);
    Doctrine_Query::create()->delete('RelRecicladorSubcategoria')->where('id_reciclador = ?', $_POST['id'])->execute();
} else {
    $reciclador = new Reciclador();
}

//INFO
$reciclador->nombre = $_POST['nombre'];
$reciclador->tel = $_POST['telefono'];
$reciclador->email = $_POST['email'];
$reciclador->web = addhttp($_POST['web']);
$reciclador->id_localidad = $_POST['localidad'];
$reciclador->id_tipo = $_POST['tipo'];
$reciclador->direccion = $_POST['direccion'];
$reciclador->latitud = $_POST['latitud'];
$reciclador->longitud = $_POST['longitud'];

//subcategorias
if (isset($_POST['subcategorias'])) {
    $subcategorias = explode('|', $_POST['subcategorias']);
    foreach ($subcategorias as $value) {
        if (!$value) continue;
        if ($subcategoria = Doctrine::getTable('subcategoria')->findOneByContenido($value)) {
            $reciclador->subcategorias[] = $subcategoria;
        }
    }
}
$reciclador->save();

$accion = ($_POST['id'])?'#edit':'#new';
header('location: '.URL.'recicladores'.$accion);

function addhttp($url) {
    if ($url && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
?>