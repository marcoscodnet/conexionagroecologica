<?php
include_once('../includes/definer.php');
include(INC.'../php/bootstrap.php');

$jornada = ($_POST['id'])?Doctrine::getTable('jornada')->find($_POST['id']):$jornada = new Jornada();

//INFO
if (isset($_POST['titulo'])) $jornada->titulo = $_POST['titulo'];
if (isset($_POST['descripcion'])) $jornada->descripcion = $_POST['descripcion'];
if (isset($_POST['blog'])) $jornada->blog = $_POST['blog'];

$jornada->save();

if (isset($_POST['imgprefix'])) {
    $folderName = 'jornadas-exitosas';
    $i=  Imagen::lastId();
    
     foreach (glob(INC.'../content/tmp/'.$folderName.'/thumb/'.$_POST['imgprefix'].'-*') as $img) {
        $imageName = str_replace(INC.'../content/tmp/'.$folderName.'/thumb/', '', $img);
        $ext = explode('.', $imageName);
        $ext = '.'.end($ext);
        $imageModel = Doctrine::getTable('imagen')->findOneByRuta($imageName);
        $imageModel->ruta = $jornada->slug.'.'.$i.$ext;
        $imageModel->jornada = $jornada;
        $imageModel->save();
        rename(INC.'../content/tmp/'.$folderName.'/'.$imageName, INC.'../content/'.$folderName.'/'.$jornada->slug.'.'.$i.$ext);
        rename(INC.'../content/tmp/'.$folderName.'/thumb/'.$imageName, INC.'../content/'.$folderName.'/thumb/'.$jornada->slug.'.'.$i.$ext);
        rename(INC.'../content/tmp/'.$folderName.'/home/'.$imageName, INC.'../content/'.$folderName.'/home/'.$jornada->slug.'.'.$i.$ext);
        $i++;
    }
    
}
if (isset($_POST['redirect'])) {
    $accion = ($_POST['id'])?'#edit':'#new';
    header('location: '.URL.'jornadas'.$accion);
}
?>