<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$popup = ($_POST['id'])?Doctrine::getTable('popup')->find($_POST['id']):$popup = new Popup();

//INFO
if (isset($_POST['titulo'])) $popup->titulo = $_POST['titulo'];
if (isset($_POST['ruta'])) $popup->ruta = $_POST['ruta'];
$popup->popup_activo = (isset($_POST['activo']) && ($_POST['activo'] == 1 || $_POST['activo'] == 'on'))?1:0;
$popup->save();

if (isset($_POST['imgprefix'])) {
    $folderName = 'popups-conexion';
    $i=  Imagen::lastId();
    
     foreach (glob(INC.'../content/tmp/'.$folderName.'/thumb/'.$_POST['imgprefix'].'-*') as $img) {
        $imageName = str_replace(INC.'../content/tmp/'.$folderName.'/thumb/', '', $img);
        $ext = explode('.', $imageName);
        $ext = '.'.end($ext);
        $imageModel = Doctrine::getTable('imagen')->findOneByRuta($imageName);
        $imageModel->ruta = $popup->slug.'.'.$i.$ext;
        $imageModel->popup = $popup;
        $imageModel->save();
        rename(INC.'../content/tmp/'.$folderName.'/'.$imageName, INC.'../content/'.$folderName.'/'.$popup->slug.'.'.$i.$ext);
        rename(INC.'../content/tmp/'.$folderName.'/thumb/'.$imageName, INC.'../content/'.$folderName.'/thumb/'.$popup->slug.'.'.$i.$ext);
        rename(INC.'../content/tmp/'.$folderName.'/home/'.$imageName, INC.'../content/'.$folderName.'/home/'.$popup->slug.'.'.$i.$ext);
        $i++;
    }
    
}
if (isset($_POST['redirect'])) {
    $accion = ($_POST['id'])?'#edit':'#new';
    header('location: '.URL.'popups'.$accion);
}
?>