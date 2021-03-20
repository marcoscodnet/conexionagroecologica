<?php
session_start();
include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');
$imagesTmpPath = 'content/tmp/apoyan/';
$imagesFinalPath = '../images/apoyan/';

if ($_POST['id']) {
    $sponsor = Doctrine::getTable('Sponsor')->find($_POST['id']);
} else {
    $sponsor = new Sponsor();
}

//INFO
if (isset($_POST['nombre'])) $sponsor->nombre = $_POST['nombre'];
if (isset($_POST['link'])) $sponsor->link = addhttp($_POST['link']);
if (isset($_POST['categoria'])) $sponsor->id_categoria = $_POST['categoria'];
if (isset($_POST['size'])) $sponsor->size = $_POST['size'];
$sponsor->save();

if (isset($_POST['imgprefix'])) {
    $i=  Imagen::lastId();   
    foreach (glob(INC.$imagesTmpPath.$_POST['imgprefix'].'-*') as $img) {
        $imageTmpName = str_replace(INC.$imagesTmpPath, '', $img);
        $ext = explode('.', $img);
        $imageFinalName = $sponsor->slug.'.'.$i.'.'.end($ext);
        
        $imageModel = Doctrine::getTable('imagen')->findOneByRuta($imageTmpName);
        $imageModel->ruta = $imageFinalName;
        $sponsor->imagen = $imageModel;
        rename(INC.$imagesTmpPath.$imageTmpName, INC.$imagesFinalPath.$imageFinalName);
        rename(INC.$imagesTmpPath.'thumb/'.$imageTmpName, INC.$imagesFinalPath.'thumb/'.$imageFinalName);
    }
}
$sponsor->save();

if (isset($_POST['redirect'])) {
    $accion = ($_POST['id'])?'#edit':'#new';
    header('location: '.URL.'nos-apoyan/listado'.$accion);
}

function addhttp($url) {
    if (!preg_match("#^https?://#i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
?>
