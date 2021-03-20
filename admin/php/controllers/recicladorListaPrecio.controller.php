<?php
include_once('../includes/definer.php');
include('../../../php/bootstrap.php');

$listaPrecio = ($_POST['id'])?Doctrine::getTable('ListaPrecio')->find($_POST['id']):$listaPrecio = new ListaPrecio();

//INFO
$listaPrecio->material = $_POST['material'];

$listaPrecio->precio_kg = $_POST['precio_kg'];
$listaPrecio->variacion_precio = $_POST['variacion_precio'];
$listaPrecio->variacion_porcentaje = $_POST['variacion_porcentaje'];
$listaPrecio->tipo = $_POST['tipo'];

$listaPrecio->save();

$accion = ($_POST['id'])?'#edit':'#new';
header('location: '.URL.'recicladores/listaPrecios'.$accion);

function addhttp($url) {
    if ($url && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}



?>