<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$caso = ($_POST['id'])?Doctrine::getTable('caso')->find($_POST['id']):$caso = new Caso();

//INFO
if (isset($_POST['titulo'])) $caso->titulo = $_POST['titulo'];
if (isset($_POST['descripcion'])) $caso->descripcion = $_POST['descripcion'];
$caso->destacado = (isset($_POST['destacado']) && ($_POST['destacado'] == 1 || $_POST['destacado'] == 'on'))?1:0;
if (isset($_POST['subcategoria'])) $caso->id_subcategoria = $_POST['subcategoria'];
if (isset($_POST['ubicacion'])) $caso->id_ubicacion = $_POST['ubicacion'];
$caso->save();

if (isset($_POST['imgprefix'])) {
    $folderName = 'casos-exitosos';
    $i=  Imagen::lastId();
    
    foreach (glob(INC.'../content/tmp/'.$folderName.'/thumb/'.$_POST['imgprefix'].'-*') as $img) {
        $imageName = str_replace(INC.'../content/tmp/'.$folderName.'/thumb/', '', $img);
        $ext = explode('.', $imageName);
        $ext = '.'.end($ext);
        $imageModel = Doctrine::getTable('imagen')->findOneByRuta($imageName);
        $imageModel->ruta = $caso->slug.'.'.$i.$ext;
        $imageModel->caso = $caso;
        $imageModel->save();
        rename(INC.'../content/tmp/'.$folderName.'/'.$imageName, INC.'../content/'.$folderName.'/'.$caso->slug.'.'.$i.$ext);
        rename(INC.'../content/tmp/'.$folderName.'/thumb/'.$imageName, INC.'../content/'.$folderName.'/thumb/'.$caso->slug.'.'.$i.$ext);
        rename(INC.'../content/tmp/'.$folderName.'/home/'.$imageName, INC.'../content/'.$folderName.'/home/'.$caso->slug.'.'.$i.$ext);
        $i++;
    }
    
}
if (isset($_POST['redirect'])) {
    $accion = ($_POST['id'])?'#edit':'#new';
    header('location: '.URL.'casos'.$accion);
}
?>