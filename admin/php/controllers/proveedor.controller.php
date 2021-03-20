<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$proveedor = ($_POST['id'])?Doctrine::getTable('proveedor')->find($_POST['id']):$proveedor = new Proveedor();

//INFO
$proveedor->nombre = $_POST['nombre'];
$proveedor->tel = $_POST['telefono'];
$proveedor->email = $_POST['email'];
$proveedor->web = addhttp($_POST['web']);
$proveedor->id_subcategoria = $_POST['subcategoria'];
$proveedor->id_localidad = $_POST['localidad'];
$proveedor->descripcion = $_POST['descripcion'];
$proveedor->save();

$accion = ($_POST['id'])?'#edit':'#new';
header('location: '.URL.'proveedores'.$accion);

function addhttp($url) {
    if ($url && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
?>