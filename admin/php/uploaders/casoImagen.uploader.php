<?php
if(!isset($_FILES) || !count($_FILES)) exit();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include_once('../includes/definer.php');
include_once(INC.'../php/bootstrap.php');
include_once(INC.'php/clases/FileImage.php');


$relativePath = '../content/tmp/casos-exitosos/';
$ruta = INC.$relativePath;
$response = array();



//validaciones
for ($i=0, $l=count($_FILES['files']['name']); $i<$l; $i++) {
    $nombre = $_POST['imgprefix'].'-'.(Imagen::lastId()+1);
    
    $ext = explode('.', $_FILES['files']['name'][$i]);
    $ext = '.'.$ext[count($ext)-1];
    $ext = strtolower($ext);
    $ext = ($ext == '.jpeg')?'.jpg':$ext;
    
    if ($ext == '.jpg' || $ext == '.jpeg' || $ext == '.gif' || $ext == '.png' ) {
	
        //dimensionamiento y creacion de las imagenes
        //ancho maximo 620
        $fileImage = new FileImage($_FILES['files']['tmp_name'][$i]);
        if ($fileImage->ancho > 620) $fileImage->ajustarAncho(620);
        $fileImage->save($ruta.$nombre);
        //recoratadas a 256 x 256
        $fileImage = new FileImage($_FILES['files']['tmp_name'][$i]);
        $fileImage->escalar(256, 256);
        $fileImage->recortarDesdeElCentro(256, 256);
        $fileImage->save($ruta.'thumb/'.$nombre);
        //para el detacado de la home
        $fileImage = new FileImage($_FILES['files']['tmp_name'][$i]);
        $fileImage->escalar(467, 250);
        $fileImage->recortarDesdeElCentro(467, 250);
        $fileImage->save($ruta.'home/'.$nombre);
        
        $image = new Imagen();
        $image->ruta = $nombre.'.'.$fileImage->extension;
        $image->save();

        //respuesta
        $response[] = array(
            'id'=>$image->id,
            'src'=>$relativePath.'thumb/'.$nombre.'.'.$fileImage->extension
        );
    }
}

header("Content-type: application/json");
echo(json_encode($response));
?>
